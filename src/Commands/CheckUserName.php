<?php
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/19/15
 * Time: 11:46 PM
 */

namespace IonAuth\IonAuth\Commands;


class CheckUserName
{
    /**
     * Checks username
     *
     * @param $username, string
     * @return bool
     **/
    public function usernameCheck($username)
    {
        $this->triggerEvents('usernameCheck');

        $this->triggerEvents('extra_where');

        return $this->db->where('username', $username)
            ->count_all_results($this->tables['users']) > 0;
    }
}
