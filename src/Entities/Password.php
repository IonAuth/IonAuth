<?php namespace IonAuth\IonAuth\Entities;
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/17/15
 * Time: 11:01 PM
 */

class Password
{
    private $password;
    private $salt;

    private $hash_method;

    private $hash;

    function __construct($password, $hash_method ='sha1')
    {
        $this->password = $password;
        $this->hash_method = $hash_method;
    }

    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Hashes the password to be stored in the database.
     *
     * @return void
     * @author Matthew
     **/
    public function hashPassword()
    {
        if ($this->config->get('hashMethod') == 'sha1')
        {
            if ($this->config->get('storeSalt') && $salt)
            {
                return sha1($this->password . $salt);
            }
            else
            {
                $salt = $this->salt();
                return $salt . substr(sha1($salt . $password), 0, -$this->config->get('saltLength'));
            }
        }
        else
        {
            return password_hash($password, PASSWORD_BCRYPT, array("cost" => $this->_bcryptCost));
        }
    }

    /**
     * Function: hashPasswordDb()
     * -----------------------------
     * This function takes a password and validates it
     * against an entry in the users table.
     *
     * @return void
     * @author Mathew
     **/
    public function hashPasswordDb($id, $password)
    {
        if (empty($id) || empty($password)) {
            return false;
        }

        $this->triggerEvents('extraWhere');

        $query = $this->db->table($this->config->get('tables')['users'])
            ->select(array('password', 'salt'))
            ->where('id', '=', $id)
            ->take(1);

        $hashPasswordDb = $query->first();


        if (isset($hashPasswordDb) === false) {
            return false;
        }


        if ($this->config->get('hashMethod') == 'sha1') {
            if ($this->config->get('storeSalt')) {
                $dbPassword = sha1($password . $hashPasswordDb->salt);
            } else {
                $salt = substr($hashPasswordDb->password, 0, $this->config->get('saltLength'));

                $dbPassword = $salt . substr(sha1($salt . $password), 0, -$this->config->get('saltLength'));
            }


            if ($dbPassword == $hashPasswordDb->password) {
                return true;
            } else {
                return false;
            }
        } else {

            if (password_verify($password, $hashPasswordDb->password) === true) {
                return true;
            } else {
                return false;
            }

            return false;
        }
    }

    /**
     * Generates a random salt value.
     *
     * Salt generation code taken from https://github.com/ircmaxell/password_compat/blob/master/lib/password.php
     *
     * @return void
     * @author Anthony Ferrera
     **/
    public function salt()
    {
        $raw_salt_len = 16;

        $buffer = '';
        $buffer_valid = false;

        if (function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
            $buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
            $buffer = openssl_random_pseudo_bytes($raw_salt_len);
            if ($buffer) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid && @is_readable('/dev/urandom')) {
            $f = fopen('/dev/urandom', 'r');
            $read = strlen($buffer);
            while ($read < $raw_salt_len) {
                $buffer .= fread($f, $raw_salt_len - $read);
                $read = strlen($buffer);
            }
            fclose($f);
            if ($read >= $raw_salt_len) {
                $buffer_valid = true;
            }
        }

        if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
            $bl = strlen($buffer);
            for ($i = 0; $i < $raw_salt_len; $i++) {
                if ($i < $bl) {
                    $buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
                } else {
                    $buffer .= chr(mt_rand(0, 255));
                }
            }
        }

        $salt = $buffer;

        // encode string with the Base64 variant used by crypt
        $base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
        $bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $base64_string = base64_encode($salt);
        $salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

        $salt = substr($salt, 0, $this->config->get('saltLength'));


        return $salt;

    }

}