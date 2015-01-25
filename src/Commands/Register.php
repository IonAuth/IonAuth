<?php namespace IonAuth\IonAuth\Commands;

use IonAuth\IonAuth\Entities\User;

/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/18/15
 * Time: 7:26 PM
 */

class Register
{
    protected $events;

    public function register(\IonAuth\IonAuth\Config\Config $config, IonAuth\IonAuth\Event $events, User $user)
    {

        //TODO - implement triggers
        $events->trigger('preAccountCreation');

        $emailActivation = $config->get('emailActivation');

        $id = $this->_register($user->username, $user->password, $user->email, $user->additionalData, $user->groupIds);
        if (!$emailActivation)
        {
            if ($id !== false)
            {
                $this->setMessage('accountCreationSuccessful');
                $events->trigger(array('postAccountCreation', 'postAccountCreationSuccessful'));
                return $id;
            }
            else
            {
                return $this->postAccountCreationUnsuccessful();
            }
        }
        else
        {
            if (!$id) return $this->postAccountCreationUnsuccessful();

            $deactivate = $this->ionAuthModel->deactivate($id);

            if (!$deactivate)
            {
                $this->setError('deactivateUnsuccessful');
                $events->trigger(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
                return false;
            }

            $activationCode = $this->ionAuthModel->activation_code;
            $identity = $config->get('identity');
            $user = $this->ionAuthModel->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activationCode,
            );

            if (!$config->get('useDefaultEmail'))
            {
                $events->trigger(
                    array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful')
                );
                $this->setMessage('activationEmailSuccessful');
                return $data;
            }
            else
            {
                $message = $this->load->view(
                    $config->get('emailTemplates') . $config->get('emailActivate'),
                    $data,
                    true
                );

                $this->email->clear();
                $this->email->from($config->get('adminEmail'), $config->get('siteTitle'));
                $this->email->to($email);
                $this->email->subject(
                    $config->get('siteTitle') . ' - ' . $this->lang->line('emailActivationSubject')
                );
                $this->email->message($message);

                if ($this->email->send() == true)
                {
                    $events->trigger(
                        array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful')
                    );
                    $this->setMessage('activationEmailSuccessful');
                    return $id;
                }
            }

            $events->trigger(
                array('postAccountCreation', 'postAccountCreationUnsuccessful', 'activationEmailUnsuccessful')
            );
            $this->setError('activationEmailUnsuccessful');
            return false;
        }

    }

    Private function postAccountCreationUnsuccessful()
    {
        $this->setError('accountCreationUnsuccessful');
        $events->trigger(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
        return false;
    }


    /**
     * register
     *
     * @return bool
     * @author Mathew
     **/
    public function _register($username, $password, $email, $additionalData = array(), $groups = array())
    {
        $this->triggerEvents('preRegister');

        $manualActivation = $config->get('manual_activation');

        if ($this->identityColumn == 'email' && $this->emailCheck($email))
        {
            $this->setError('accountCreationDuplicate_email');
            return false;
        }
        elseif ($this->identityColumn == 'username' && $this->usernameCheck($username))
        {
            $this->setError('accountCreationDuplicateUsername');
            return false;
        }

        // If username is taken, use username1 or username2, etc.
        if ($this->identityColumn != 'username')
        {
            $originalUsername = $username;
            for ($i = 0; $this->usernameCheck($username); $i++)
            {
                if ($i > 0)
                {
                    $username = $originalUsername . $i;
                }
            }
        }

        // IP Address
        $ipAddress = prepareIp($_SERVER['REMOTE_ADDR']);
        $salt = $this->storeSalt ? $this->salt() : false;
        $password = $this->hashPassword($password, $salt);

        // Users table.
        $data = array(
            'username' => $username,
            'password' => $password,
            'email' => $email,
            'ip_address' => $ipAddress,
            'created_on' => time(),
            'last_login' => time(),
            'active' => ($manualActivation === false ? 1 : 0)
        );

        if ($this->store_salt)
        {
            $data['salt'] = $salt;
        }

        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $userData = array_merge($this->_filterData($this->tables['users'], $additionalData), $data);

        $this->triggerEvents('extraSet');

        $this->db->insert($this->tables['users'], $userData);

        $id = $this->db->insert_id();

        if (!empty($groups))
        {
            //add to groups
            foreach ($groups as $group)
            {
                $this->addToGroup($group, $id);
            }
        }

        //add to default group if not already set
        $defaultGroup = $this->where('name', $config->get('defaultGroup'))->group()->first();
        if ((isset($defaultGroup->id) && !isset($groups)) || (empty($groups) && !in_array(
                    $defaultGroup->id,
                    $groups
                ))
        )
        {
            $this->addToGroup($defaultGroup->id, $id);
        }

        $this->triggerEvents('postRegister');

        return (isset($id)) ? $id : false;
    }
}
