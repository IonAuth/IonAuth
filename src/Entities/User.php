<?php

namespace IonAuth\IonAuth\Entities;

use IonAuth\IonAuth\Helper;
use IonAuth\IonAuth\Utilities\Collection\CollectionItem;
use IonAuth\IonAuth\Utilities\Collection\GroupCollection;

class User implements CollectionItem
{
    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     **/
    protected $status;

    private $email;
    private $groups;
    private $id;
    private $last_name;
    private $last_login;

    function __construct()
    {
        $this->groups = GroupCollection::create([]);
    }

    public function getId()
    {
        return $this->id;
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
     *
     * @return bool
     * @author Phil Sturgeon
     **/
    public function inGroup(Group $group)
    {
        return in_array($group->getID(), $this->groups->getKeys());
    }

    /**
     * Function is TimeLockedOut()
     * ---------------------------------------------------------------------
     * Get a boolean to determine if an account should be locked out due to
     * exceeded login attempts within a given period
     *
     * @param     string , $identity
     * @return    boolean
     */
    public function isTimeLockedOut()
    {
        return $this->isMaxLoginAttemptsExceeded() && $this->getLastAttemptTime() > time(
        ) - $this->config->get('lockout_time');
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

        if (isset($this->_ionSelect) && !empty($this->_ionSelect))
        {
            foreach ($this->_ionSelect as $select)
            {
                $this->db->select($select);
            }

            $this->_ionSelect = array();
        }
        else
        {
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
        if (isset($groups))
        {
            //build an array if only one group was passed
            if (is_numeric($groups))
            {
                $groups = Array($groups);
            }

            //join and then run a where_in against the group ids
            if (isset($groups) && !empty($groups))
            {
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
        if (isset($this->_ionWhere) && !empty($this->_ionWhere))
        {
            foreach ($this->_ionWhere as $where)
            {
                $this->db->where($where);
            }

            $this->_ionWhere = array();
        }

        if (isset($this->_ionLike) && !empty($this->_ionLike))
        {
            foreach ($this->_ionLike as $like)
            {
                $this->db->orLike($like);
            }

            $this->_ionLike = array();
        }

        if (isset($this->_ionLimit) && isset($this->_ionOffset))
        {
            $this->db->take($this->_ionLimit, $this->_ionOffset);

            $this->_ionLimit = null;
            $this->_ionOffset = null;
        }
        else
        {
            if (isset($this->_ionLimit))
            {
                $this->db->take($this->_ionLimit);

                $this->_ionLimit = null;
            }
        }

        //set the order
        if (isset($this->_ionOrderBy) && isset($this->_ionOrder))
        {
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
     * @return IonAuth\IonAuth\Entities\User
     * @author Ben Edmunds
     **/
    public function find($id)
    {
        $this->triggerEvents('user');

        $this->triggerEvents('getUsersGroup');

        //if no id was passed use the current users id
        $id || $id = $_SESSION['user_id'];

        return $this->db->select(
            'select ' . $this->tables['users_groups'] . '.' . $this->join['groups'] . ' as id, ' . $this->tables['groups'] . '.name, ' . $this->tables['groups'] . '.description
		     FROM ' . $this->tables['users_groups']
            . " LEFT JOIN " . $this->tables['groups'] . " ON " . $this->tables['users_groups'] . '.' . $this->join['groups'] . ' = ' . $this->tables['groups'] . '.id'
            . ' WHERE ' . $this->tables['users_groups'] . '.' . $this->join['users'] . " = " . $id
        );

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
    public function update()
    {
//        $this->triggerEvents('preUpdateUser');

//        $this->db->trans_begin();

        if (array_key_exists($this->identityColumn, $data) && $this->identityCheck(
                $data[$this->identityColumn]
            ) && $user->{$this->identityColumn} !== $data[$this->identityColumn]
        )
        {
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
        )
        {
            if (array_key_exists('password', $data))
            {
                if (!empty($data['password']))
                {
                    $data['password'] = $this->hash_password($data['password'], $user->salt);
                }
                else
                {
                    // unset password so it doesn't effect database entry if no password passed
                    unset($data['password']);
                }
            }
        }

        $this->triggerEvents('extraWhere');
        $this->db->update($this->tables['users'], $data, array('id' => $user->id));

        if ($this->db->trans_status() === false)
        {
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
    public function delete()
    {
        $this->triggerEvents('preDeleteUser');

        // remove user from groups
        $this->groups->clear();

        // delete user from users table should be placed after remove from group
        $affectedRows = $this->db->delete($this->tables['users'], array('id' => $id));

        if ($affectedRows == 0) return false;


        if ($this->db->trans_status() === false)
        {
            $this->db->trans_rollback();
            $this->triggerEvents(array('postDeleteUser', 'postDeleteUserUnsuccessful'));
            $this->setError('deleteUnsuccessful');
            return false;
        }

//        $this->triggerEvents(array('postDeleteUser', 'postDeleteUserSuccessful'));
//        $this->setMessage('deleteSuccessful');
        return true;
    }

    /**
     * update_last_login
     *
     * @author Ben Edmunds
     **/
    public function updateLastLogin()
    {
//        $this->triggerEvents('updateLastLogin');
//        $this->triggerEvents('extraWhere');

        $this->last_login = time();
    }

    public function setEmail($email)
    {
        if (\IonAuth\IonAuth\Helper\validateEmail($email)) $this->email = $email;
        else throw new \Exception('InvalidEmail');
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getGroups()
    {
        return $this->groups;
    }

    public function addGroup(Group $group)
    {
        $this->groups->add($group);
    }

    public function removeGroup(Group $group)
    {
        $this->groups->remove($group);
    }

    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFullName()
    {
        return $this->first_name . " " . $this->last_name;
    }

    public function getLastLogin()
    {
        return $this->last_login;
    }
}
