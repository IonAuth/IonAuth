<?php

namespace IonAuth\IonAuth\Entities;

class User
{
    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     **/
    protected $status;

    /**
     * forgotten password feature
     *
     * @param $identity
     * @return mixed  boolean / array
     * @author Mathew
     */
    public function forgottenPassword($identity) // changed $email to $identity
    {
        if ($this->ionAuthModel->forgottenPassword($identity)) // changed
        {
            // Get user information
            $user = $this->where($this->config->get('identity'), $identity)->users()->row(
            ); //changed to get_user_by_identity from email

            if ($user) {
                $data = array(
                    'identity' => $user->{$this->config->get('identity')},
                    'forgotten_password_code' => $user->forgottenPasswordCode
                );

                if (!$this->config->get('useDefaultEmail')) {
                    $this->setMessage('forgotPasswordSuccessful');
                    return $data;
                } else {
                    $message = $this->load->view(
                        $this->config->get('emailTemplates') . $this->config->get('emailForgotPassword'),
                        $data,
                        true
                    );
                    $this->email->clear();
                    $this->email->from($this->config->get('adminEmail'), $this->config->get('siteTitle'));
                    $this->email->to($user->email);
                    $this->email->subject(
                        $this->config->get('siteTitle') . ' - ' . $this->lang->line('emailForgottenPasswordSubject')
                    );
                    $this->email->message($message);

                    if ($this->email->send()) {
                        $this->setMessage('forgotPasswordSuccessful');
                        return true;
                    } else {
                        $this->setError('forgotPasswordUnsuccessful');
                        return false;
                    }
                }
            } else {
                $this->setError('forgotPasswordUnsuccessful');
                return false;
            }
        } else {
            $this->setError('forgotPasswordUnsuccessful');
            return false;
        }
    }

    /**
     * forgotten_password_complete()
     * ------------------------------
     * @param $code
     * @return void
     * @author Mathew
     */
    public function forgottenPasswordComplete($code)
    {
        $this->ionAuthModel->triggerEvents('prePasswordChange');

        $identity = $this->config->get('identity');
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!$profile) {
            $this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
            $this->setError('passwordChangeUnsuccessful');
            return false;
        }

        $newPassword = $this->ionAuthModel->forgottenPasswordComplete($code, $profile->salt);

        if ($newPassword) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $newPassword
            );

            if (!$this->config->get('useDefaultEmail')) {
                $this->setMessage('passwordChangeSuccessful');
                $this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeSuccessful'));
                return $data;
            } else {
                $message = $this->load->view(
                    $this->config->get('emailTemplates') . $this->config->get('emailForgotPasswordComplete'),
                    $data,
                    true
                );

                $this->email->clear();
                $this->email->from($this->config->get('adminEmail'), $this->config->get('siteTitle'));
                $this->email->to($profile->email);
                $this->email->subject(
                    $this->config->get('siteTitle') . ' - ' . $this->lang->line('emailNewPasswordSubject')
                );
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->setMessage('passwordChangeSuccessful');
                    $this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeSuccessful'));
                    return true;
                } else {
                    $this->setError('passwordChangeUnsuccessful');
                    $this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
                    return false;
                }

            }
        }

        $this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
        return false;
    }


    /**
     * forgotten_password_check()
     * --------------------------
     * @param $code
     * @return void
     * @author Michael
     */
    public function forgottenPasswordCheck($code)
    {
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->setError('passwordChangeUnsuccessful');
            return false;
        } else {
            if ($this->config->get('forgotPasswordExpiration') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->get('forgotPasswordExpiration');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->clearForgottenPasswordCode($code);
                    $this->setError('passwordChangeUnsuccessful');
                    return false;
                }
            }

            return $profile;
        }
    }


    /**
     * register()
     * -----------------------------
     * @param $username, string
     * @param $password, string
     * @param $email, string
     * @param array $additionalData
     * @param array $groupIds
     * @return void
     * @author Mathew
     */
    public function register(
        $username,
        $password,
        $email,
        $additionalData = array(),
        $groupIds = array()
    ) // need to test email activation
    {
        $this->ionAuthModel->triggerEvents('preAccountCreation');

        $emailActivation = $this->config->get('emailActivation');

        if (!$emailActivation) {
            $id = $this->ionAuthModel->register($username, $password, $email, $additionalData, $groupIds);
            if ($id !== false) {
                $this->setMessage('accountCreationSuccessful');
                $this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationSuccessful'));
                return $id;
            } else {
                $this->setError('accountCreationUnsuccessful');
                $this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
                return false;
            }
        } else {
            $id = $this->ionAuthModel->register($username, $password, $email, $additionalData, $groupIds);

            if (!$id) {
                $this->setError('accountCreationUnsuccessful');
                return false;
            }

            $deactivate = $this->ionAuthModel->deactivate($id);

            if (!$deactivate) {
                $this->setError('deactivateUnsuccessful');
                $this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
                return false;
            }

            $activationCode = $this->ionAuthModel->activation_code;
            $identity = $this->config->get('identity');
            $user = $this->ionAuthModel->user($id)->row();

            $data = array(
                'identity' => $user->{$identity},
                'id' => $user->id,
                'email' => $email,
                'activation' => $activationCode,
            );

            if (!$this->config->get('useDefaultEmail')) {
                $this->ionAuthModel->triggerEvents(
                    array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful')
                );
                $this->setMessage('activationEmailSuccessful');
                return $data;
            } else {
                $message = $this->load->view(
                    $this->config->get('emailTemplates') . $this->config->get('emailActivate'),
                    $data,
                    true
                );

                $this->email->clear();
                $this->email->from($this->config->get('adminEmail'), $this->config->get('siteTitle'));
                $this->email->to($email);
                $this->email->subject(
                    $this->config->get('siteTitle') . ' - ' . $this->lang->line('emailActivationSubject')
                );
                $this->email->message($message);

                if ($this->email->send() == true) {
                    $this->ionAuthModel->triggerEvents(
                        array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful')
                    );
                    $this->setMessage('activationEmailSuccessful');
                    return $id;
                }
            }

            $this->ionAuthModel->triggerEvents(
                array('postAccountCreation', 'postAccountCreationUnsuccessful', 'activationEmailUnsuccessful')
            );
            $this->setError('activationEmailUnsuccessful');
            return false;
        }
    }

    /**
     * logout()
     * --------------------
     * @return void
     * @author Mathew
     **/
    public function logout()
    {
        $this->ionAuthModel->triggerEvents('logout');

        $identity = $this->config->get('identity');
        $this->session->unset_userdata(
            array(
                $identity => '',
                'id' => '',
                'user_id' => ''
            )
        );

        // delete the remember me cookies if they exist
        if ($this->ionAuthModel->getCookie('identity')) {
            $this->ionAuthModel->deleteCookie('identity');
        }

        if ($this->ionAuthModel->getCookie('remember_code')) {
            $this->ionAuthModel->deleteCookie('remember_code');
        }

        // Destroy the session
        $this->session->sess_destroy();

        $this->setMessage('logoutSuccessful');

        return true;
    }

    /**
     * logged_in
     * -----------------
     * @return bool
     * @author Mathew
     **/
    public function loggedIn()
    {
        $this->ionAuthModel->triggerEvents('loggedIn');
        return (bool)isset($_SESSION['identity']) ? true : false;
    }

    /**
     * logged in
     * --------------------
     * @return integer
     * @author jrmadsen67
     **/
    public function getUserId()
    {
        $userId = $_SESSION['userId'];

        if (!empty($userId)) {
            return $userId;
        }

        return null;
    }


    /**
     * is admin
     * ---------------------
     * @param bool $id
     * @return bool
     * @author Ben Edmunds
     */
    public function isAdmin($id = false)
    {
        $this->ionAuthModel->triggerEvents('isAdmin');

        $adminGroup = $this->config->get('adminGroup');

        return $this->inGroup($adminGroup, $id);
    }


    /**
     * in group
     * --------------------------
     * @param mixed group(s) to check
     * @param bool user id
     * @param bool check if all groups is present, or any of the groups
     *
     * @return bool
     * @author Phil Sturgeon
     **/
    public function inGroup($checkGroup, $id = false, $checkAll = false)
    {
        $this->ionAuthModel->triggerEvents('inGroup');

        $id || $id = $_SESSION['user_id'];

        if (!is_array($checkGroup)) {
            $checkGroup = array($checkGroup);
        }

        if (isset($this->_cacheUserInGroup[$id])) {
            $groups_array = $this->_cacheUserInGroup[$id];
        } else {
            $usersGroups = $this->ionAuthModel->getUsersGroups($id);
            $groupsArray = array();
            foreach ($usersGroups as $group) {
                $groupsArray[$group->id] = $group->name;
            }
            $this->_cacheUserInGroup[$id] = $groupsArray;
        }

        foreach ($checkGroup as $key => $value) {
            $groups = (is_string($value)) ? $groupsArray : array_keys($groupsArray);

            /**
             * if !all (default), in_array
             * if all, !in_array
             */
            if (in_array($value, $groups) xor $checkAll) {
                /**
                 * if !all (default), true
                 * if all, false
                 */
                return !$checkAll;
            }
        }

        /**
         * if !all (default), false
         * if all, true
         */
        return $checkAll;
    }


    /**
     * Activation functions
     *
     * Activate : Validates and removes activation code.
     * Deactivae : Updates a users row with an activation code.
     *
     * @author Mathew
     */

    /**
     * activate
     *
     * @return void
     * @author Mathew
     **/
    public function activate($id, $code = false)
    {
        $this->triggerEvents('pre_activate');

        if ($code !== false) {
            $query = $this->db->select($this->identityColumn)
                ->where('activation_code', $code)
                ->take(1)
                ->get($this->tables['users']);

            $result = $query->first();

            if (count($query) !== 1) {
                $this->triggerEvents(array('postActivate', 'postActivateUnsuccessful'));
                $this->setError('activateUnsuccessful');
                return false;
            }

            $identity = $result->{$this->identityColumn};

            $data = array(
                'activationCode' => null,
                'active' => 1
            );

            $this->triggerEvents('extraWhere');
            $this->db->update($this->tables['users'], $data, array($this->identityColumn => $identity));
        } else {
            $data = array(
                'activation_code' => null,
                'active' => 1
            );


            $this->triggerEvents('extraWhere');
            $this->db->update($this->tables['users'], $data, array('id' => $id));
        }


        if ($this->db->affected_rows() == 1) {
            $this->triggerEvents(array('postActivate', 'postActivateSuccessful'));
            $this->setMessage('activateSuccessful');
        } else {
            $this->triggerEvents(array('postActivate', 'postActivateUnsuccessful'));
            $this->setError('activateUnsuccessful');
        }


//        return $return;
    }


    /**
     * Deactivate
     *
     * @return void
     * @author Mathew
     **/
    public function deactivate($id = null)
    {
        $this->triggerEvents('deactivate');

        if (!isset($id)) {
            $this->setError('deactivateUnsuccessful');
            return false;
        }

        $activationCode = $this->salt();
        $this->activationCode = $activationCode;

        $data = array(
            'activation_code' => $activationCode,
            'active' => 0
        );

        $this->triggerEvents('extraWhere');
        $this->db->update($this->tables['users'], $data, array('id' => $id));

        $return = $this->db->affected_rows() == 1;
        if ($return) {
            $this->setMessage('deactivateSuccessful');
        } else {
            $this->setError('deactivateUnsuccessful');
        }

        return $return;
    }


    public function clearForgottenPasswordCode($code)
    {

        if (empty($code)) {
            return false;
        }

        $this->db->where('forgottenPasswordCode', $code);

        if ($this->db->count_all_results($this->tables['users']) > 0) {
            $data = array(
                'forgottenPasswordCode' => null,
                'forgottenPasswordTime' => null
            );

            $this->db->update($this->tables['users'], $data, array('forgottenPasswordCode' => $code));

            return true;
        }

        return false;
    }

    /**
     * reset password
     *
     * @return bool
     * @author Mathew
     **/
    public function resetPassword($identity, $new)
    {

        $this->triggerEvents('preChangePassword');

        if (!$this->identityCheck($identity)) {
            $this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
            return false;
        }

        $this->triggerEvents('extraWhere');

        $query = $this->db->select('id, password, salt')
            ->where($this->identityColumn, $identity)
            ->take(1)
            ->get($this->tables['users']);

        if (count($query) !== 1) {
            $this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
            $this->setError('passwordChangeUnsuccessful');
            return false;
        }

        $result = $query->first();

        $new = $this->hashPassword($new, $result->salt);

        //store the new password and reset the remember code so all remembered instances have to re-login
        //also clear the forgotten password code
        $data = array(
            'password' => $new,
            'remember_code' => null,
            'forgotten_password_code' => null,
            'forgotten_password_time' => null,
        );

        $this->triggerEvents('extraWhere');
        $this->db->update($this->tables['users'], $data, array($this->identityColumn => $identity));

        $return = $this->db->affected_rows() == 1;
        if ($return) {
            $this->triggerEvents(array('postChangePassword', 'postChangePasswordSuccessful'));
            $this->setMessage('passwordChangeSuccessful');
        } else {
            $this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
            $this->setError('passwordChangeUnsuccessful');
        }


        return $return;

    }

    /**
     * change password
     *
     * @return bool
     * @author Mathew
     **/
    public function changePassword($identity, $old, $new)
    {
        $this->triggerEvents('preChangePassword');

        $this->triggerEvents('extraWhere');

        $query = $this->db->select('id, password, salt')
            ->where($this->identityColumn, $identity)
            ->take(1)
            ->get($this->tables['users']);

        if (count($query) !== 1) {
            $this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
            $this->setError('passwordChangeUnsuccessful');
            return false;
        }

        $user = $query->first();

        $oldPasswordMatches = $this->hashPasswordDb($user->id, $old);

        if ($oldPasswordMatches === true) {
            //store the new password and reset the remember code so all remembered instances have to re-login
            $hashedNewPassword = $this->hashPassword($new, $user->salt);
            $data = array(
                'password' => $hashedNewPassword,
                'remember_code' => null,
            );

            $this->triggerEvents('extra_where');

            $successfullyChangedPasswordInDb = $this->db->update(
                $this->tables['users'],
                $data,
                array($this->identityColumn => $identity)
            );
            if ($successfullyChangedPasswordInDb) {
                $this->triggerEvents(array('postChangePassword', 'postChangePassword_Successful'));
                $this->setMessage('passwordChangeSuccessful');
            } else {
                $this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
                $this->setError('passwordChangeUnsuccessful');
            }

            return $successfullyChangedPasswordInDb;
        }

        $this->setError('passwordChangeUnsuccessful');
        return false;
    }

    /**
     * Checks username
     *
     * @return bool
     * @author Mathew
     **/
    public function usernameCheck($username = '')
    {
        $this->triggerEvents('usernameCheck');

        if (empty($username)) {
            return false;
        }

        $this->triggerEvents('extra_where');

        return $this->db->where('username', $username)
            ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Checks email
     *
     * @return bool
     * @author Mathew
     **/
    public function emailCheck($email = '')
    {
        $this->triggerEvents('email_check');

        if (empty($email)) {
            return false;
        }

        $this->triggerEvents('extra_where');

        return $this->db->where('email', $email)
            ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Identity check
     *
     * @return bool
     * @author Mathew
     **/
    public function identityCheck($identity = '')
    {
        $this->triggerEvents('identity_check');

        if (empty($identity)) {
            return false;
        }

        return $this->db->where($this->identityColumn, $identity)
            ->count_all_results($this->tables['users']) > 0;
    }

    /**
     * Insert a forgotten password key.
     *
     * @return bool
     * @author Mathew
     * @updated Ryan
     * @updated 52aa456eef8b60ad6754b31fbdcc77bb
     **/
    public function _forgottenPassword($identity)
    {
        if (empty($identity)) {
            $this->triggerEvents(array('postForgottenPassword', 'postForgottenPasswordUnsuccessful'));
            return false;
        }

        //All some more randomness
        $activationCodePart = "";
        if (function_exists("openssl_random_pseudo_bytes")) {
            $activationCodePart = openssl_random_pseudo_bytes(128);
        }

        for ($i = 0; $i < 1024; $i++) {
            $activationCodePart = sha1($activationCodePart . mt_rand() . microtime());
        }

        $key = $this->hash_code($activationCodePart . $identity);

        $this->forgottenPasswordCode = $key;

        $this->triggerEvents('extraWhere');

        $update = array(
            'forgotten_password_code' => $key,
            'forgotten_password_time' => time()
        );

        $this->db->update($this->tables['users'], $update, array($this->identityColumn => $identity));

        $return = $this->db->affected_rows() == 1;

        if ($return) {
            $this->triggerEvents(array('postForgottenPassword', 'postForgottenPasswordSuccessful'));
        } else {
            $this->triggerEvents(array('postForgottenPassword', 'postForgottenPasswordUnsuccessful'));
        }

        return $return;
    }

    /**
     * Forgotten Password Complete
     *
     * @return string
     * @author Mathew
     **/
    public function _forgottenPasswordComplete($code, $salt = false)
    {
        $this->triggerEvents('preForgottenPasswordComplete');

        if (empty($code)) {
            $this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful'));
            return false;
        }

        $profile = $this->where('forgottenPasswordCode', $code)->users()->first(); //pass the code to profile

        if ($profile) {

            if ($this->config->get('forgotPasswordExpiration') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->get('forgotPasswordExpiration');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->setError('forgotPasswordExpired');
                    $this->triggerEvents(
                        array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful')
                    );
                    return false;
                }
            }

            $password = $this->salt();

            $data = array(
                'password' => $this->hashPassword($password, $salt),
                'forgotten_password_code' => null,
                'active' => 1,
            );

            $this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

            $this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteSuccessful'));
            return $password;
        }

        $this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful'));
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

        $manualActivation = $this->config->get('manual_activation');

        if ($this->identityColumn == 'email' && $this->emailCheck($email)) {
            $this->setError('accountCreationDuplicate_email');
            return false;
        } elseif ($this->identityColumn == 'username' && $this->usernameCheck($username)) {
            $this->setError('accountCreationDuplicateUsername');
            return false;
        }

        // If username is taken, use username1 or username2, etc.
        if ($this->identityColumn != 'username') {
            $originalUsername = $username;
            for ($i = 0; $this->usernameCheck($username); $i++) {
                if ($i > 0) {
                    $username = $originalUsername . $i;
                }
            }
        }

        // IP Address
        $ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);
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

        if ($this->store_salt) {
            $data['salt'] = $salt;
        }

        //filter out any data passed that doesnt have a matching column in the users table
        //and merge the set user data and the additional data
        $userData = array_merge($this->_filterData($this->tables['users'], $additionalData), $data);

        $this->triggerEvents('extraSet');

        $this->db->insert($this->tables['users'], $userData);

        $id = $this->db->insert_id();

        if (!empty($groups)) {
            //add to groups
            foreach ($groups as $group) {
                $this->addToGroup($group, $id);
            }
        }

        //add to default group if not already set
        $defaultGroup = $this->where('name', $this->config->get('defaultGroup'))->group()->first();
        if ((isset($defaultGroup->id) && !isset($groups)) || (empty($groups) && !in_array(
                    $defaultGroup->id,
                    $groups
                ))
        ) {
            $this->addToGroup($defaultGroup->id, $id);
        }

        $this->triggerEvents('postRegister');

        return (isset($id)) ? $id : false;
    }

    /**
     * login
     *
     * @return bool
     * @author Mathew
     **/
    public function login($identity, $password, $remember = false)
    {
        $this->triggerEvents('preLogin');

        if (empty($identity) || empty($password)) {
            $this->setError('loginUnsuccessful');
            return false;
        }

        $this->triggerEvents('extraWhere');

        $query = $this->db->table($this->config->get('tables')['users'])
            ->select(
                array(
                    'id',
                    $this->config->get('identity'),
                    'username',
                    'email',
                    'id',
                    'password',
                    'active',
                    'last_login'
                )
            )
            ->where($this->config->get('identity'), $identity)
            ->take(1);


        if ($this->isTimeLockedOut($identity)) {
            //Hash something anyway, just to take up time
            $this->hashPassword($password);

            $this->triggerEvents('postLoginUnsuccessful');
            $this->setError('loginTimeout');

            return false;
        }


        $user = $query->first();

        if (isset($user) === true) {

            echo 'here:';
            var_dump($user->id, $password);
            $password = $this->hashPasswordDb($user->id, $password);

            echo '------';
            if ($password === true) {
                if ($user->active == 0) {
                    $this->triggerEvents('post_login_unsuccessful');
                    $this->setError('login_unsuccessful_not_active');

                    return false;
                }

                $this->setSession($user);

                $this->updateLastLogin($user->id);

                $this->clearLoginAttempts($identity);

                if ($remember && $this->config->get('remember_users')) {
                    $this->rememberUser($user->id);
                }

                $this->triggerEvents(array('postLogin', 'postLoginSuccessful'));
                $this->setMessage('loginSuccessful');

                return true;
            }
        }

        //Hash something anyway, just to take up time
        $this->hashPassword($password);

        $this->increaseLoginAttempts($identity);

        $this->triggerEvents('postLoginUnsuccessful');
        $this->setError('loginUnsuccessful');

        return false;
    }

    /**
     * is_max_login_attempts_exceeded
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param string $identity
     * @return boolean
     **/
    public function isMaxLoginAttemptsExceeded($identity)
    {
        if ($this->config->get('trackLoginAttempts')) {
            $maxAttempts = $this->config->get('maximumLoginAttempts');
            if ($maxAttempts > 0) {
                $attempts = $this->getAttemptsNum($identity);
                return $attempts >= $maxAttempts;
            }
        }
        return false;
    }

    /**
     * Function: getAttemptsNum()
     * ------------------------------------------------------------------------------------
     * Get number of attempts to login occured from given IP-address or identity
     * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
     *
     * @param    string $identity
     * @return    int
     */
    function getAttemptsNum($identity)
    {
        if ($this->config->get('trackLoginAttempts')) {
            $ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);

            $this->db->select('1', false);
            $this->db->where('ip_address', $ipAddress);
            if (strlen($identity) > 0) {
                $this->db->or_where('login', $identity);
            }

            $qres = $this->db->get($this->tables['loginAttempts']);
            return count($qres);
        }
        return 0;
    }

    /**
     * Function is TimeLockedOut()
     * ---------------------------------------------------------------------
     * Get a boolean to determine if an account should be locked out due to
     * exceeded login attempts within a given period
     *
     * @param     string, $identity
     * @return    boolean
     */
    public function isTimeLockedOut($identity)
    {

        return $this->isMaxLoginAttemptsExceeded($identity) && $this->getLastAttemptTime($identity) > time(
        ) - $this->config->get('lockout_time');
    }

    /**
     * Function: getLastAttemptTime()
     * --------------------------------------
     * Get the time of the last time a login attempt occured from given IP-address or identity
     *
     * @param    string $identity
     * @return    int
     */
    public function getLastAttemptTime($identity)
    {
        if ($this->config->get('trackLoginAttempts')) {
            $ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);

            $this->db->select_max('time');
            $this->db->where('ip_address', $ipAddress);
            if (strlen($identity) > 0) {
                $this->db->or_where('login', $identity);
            }
            $qres = $this->db->get($this->tables['loginAttempts'], 1);

            if (count($qres) > 0) {
                return $qres->first()->time;
            }
        }

        return 0;
    }


    /**
     * users
     *
     * @return object Users
     * @author Ben Edmunds
     **/
    public function all($groups = null)
    {
        $this->triggerEvents('users');

        if (isset($this->_ionSelect) && !empty($this->_ionSelect)) {
            foreach ($this->_ionSelect as $select) {
                $this->db->select($select);
            }

            $this->_ionSelect = array();
        } else {
            //default selects
            $this->db->select(
                array(
                    $this->tables['users'] . '.*',
                    $this->tables['users'] . '.id as id',
                    $this->tables['users'] . '.id as user_id'
                )
            );
        }

        //filter by group id(s) if passed
        if (isset($groups)) {
            //build an array if only one group was passed
            if (is_numeric($groups)) {
                $groups = Array($groups);
            }

            //join and then run a where_in against the group ids
            if (isset($groups) && !empty($groups)) {
                $this->db->distinct();
                $this->db->join(
                    $this->tables['usersGroups'],
                    $this->tables['usersGroups'] . '.' . $this->join['users'] . '=' . $this->tables['users'] . '.id',
                    'inner'
                );

                $this->db->where_in($this->tables['usersGroups'] . '.' . $this->join['groups'], $groups);
            }
        }

        $this->triggerEvents('extraWhere');

        //run each where that was passed
        if (isset($this->_ionWhere) && !empty($this->_ionWhere)) {
            foreach ($this->_ionWhere as $where) {
                $this->db->where($where);
            }

            $this->_ionWhere = array();
        }

        if (isset($this->_ionLike) && !empty($this->_ionLike)) {
            foreach ($this->_ionLike as $like) {
                $this->db->orLike($like);
            }

            $this->_ionLike = array();
        }

        if (isset($this->_ionLimit) && isset($this->_ionOffset)) {
            $this->db->take($this->_ionLimit, $this->_ionOffset);

            $this->_ionLimit = null;
            $this->_ionOffset = null;
        } else {
            if (isset($this->_ionLimit)) {
                $this->db->take($this->_ionLimit);

                $this->_ionLimit = null;
            }
        }

        //set the order
        if (isset($this->_ionOrderBy) && isset($this->_ionOrder)) {
            $this->db->order_by($this->_ionOrderBy, $this->_ionOrder);

            $this->_ionOrder = null;
            $this->_ionOrderBy = null;
        }

        $this->response = $this->db->get($this->tables['users']);

        return $this;
    }

    /**
     * user
     *
     * @return object
     * @author Ben Edmunds
     **/
    public function find($id = null)
    {
        $this->triggerEvents('user');

        //if no id was passed use the current users id
        $id || $id = $this->session->userdata('userId');

        $this->take(1);
        $this->where($this->tables['users'] . '.id', $id);

        $this->users();

        return $this;
    }



    /**
     * update
     *
     * @return bool
     * @author Phil Sturgeon
     **/
    public function update($id, array $data)
    {
        $this->triggerEvents('preUpdateUser');

        $user = $this->user($id)->first();

        $this->db->trans_begin();

        if (array_key_exists($this->identityColumn, $data) && $this->identityCheck(
                $data[$this->identityColumn]
            ) && $user->{$this->identityColumn} !== $data[$this->identityColumn]
        ) {
            $this->db->trans_rollback();
            $this->setError('accountCreationDuplicate' . ucwords($this->identityColumn));

            $this->triggerEvents(array('postUpdateUser', 'postUpdateUserUnsuccessful'));
            $this->setError('updateUnsuccessful');

            return false;
        }

        // Filter the data passed
        $data = $this->_filterData($this->tables['users'], $data);

        if (array_key_exists('username', $data) || array_key_exists('password', $data) || array_key_exists(
                'email',
                $data
            )
        ) {
            if (array_key_exists('password', $data)) {
                if (!empty($data['password'])) {
                    $data['password'] = $this->hash_password($data['password'], $user->salt);
                } else {
                    // unset password so it doesn't effect database entry if no password passed
                    unset($data['password']);
                }
            }
        }

        $this->triggerEvents('extraWhere');
        $this->db->update($this->tables['users'], $data, array('id' => $user->id));

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();

            $this->triggerEvents(array('postUpdateUser', 'postUpdateUserUnsuccessful'));
            $this->setError('updateUnsuccessful');
            return false;
        }

        $this->db->trans_commit();

        $this->triggerEvents(array('postUpdateUser', 'postUpdateUserSuccessful'));
        $this->setMessage('updateSuccessful');
        return true;
    }

    /**
     * delete_user
     *
     * @return bool
     * @author Phil Sturgeon
     **/
    public function deleteUser($id)
    {
        $this->triggerEvents('preDeleteUser');

        //$this->db->trans_begin();

        // remove user from groups
        $this->removeFromGroup(null, $id);

        // delete user from users table should be placed after remove from group
        $affectedRows = $this->db->delete($this->tables['users'], array('id' => $id));

        // if user does not exist in database then it returns false else removes the user from groups
        if ($affectedRows == 0) {
            return false;
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            $this->triggerEvents(array('postDeleteUser', 'postDeleteUserUnsuccessful'));
            $this->setError('deleteUnsuccessful');
            return false;
        }

        $this->db->trans_commit();

        $this->triggerEvents(array('postDeleteUser', 'postDeleteUserSuccessful'));
        $this->setMessage('deleteSuccessful');
        return true;
    }

    /**
     * update_last_login
     *
     * @return bool
     * @author Ben Edmunds
     **/
    public function updateLastLogin($id)
    {
        $this->triggerEvents('updateLastLogin');

        $this->triggerEvents('extraWhere');

        $affectedRows = $this->db->table($this->config->get('tables')['users'])
            ->where('id', '=', $id)
            ->update(array('last_login' => time()));

        return $affectedRows == 1;
    }
}
