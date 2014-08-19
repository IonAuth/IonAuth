<?php
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 8/18/14
 * Time: 5:23 PM
 */

namespace BenEdmunds\IonAuth\Config;


class Config
{


    private $database = array(
        'driver' => 'mysql',
        'host' => 'localhost',
        'database' => 'ion_auth',
        'username' => 'homestead',
        'password' => 'secret',
        'charset' => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix' => '',
        'fetch' => \PDO::FETCH_CLASS,
    );
    /*
	 | -------------------------------------------------------------------------
	 | Hash Method (sha1 or bcrypt or oldBcrypt)
	 | -------------------------------------------------------------------------
	 | Bcrypt is available in PHP 5.3.7+
	 |
	 | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
	 | bcrypt instead of sha1.
	 |
	 | NOTE: bcrypt is now the default encryption method
	 |
	 | If you need backwards compatibility set hashMethod to "oldBcrypt"
	 |
	 | Below there is "defaultRounds" (cost) setting.  This defines how strong the encryption will be,
	 | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
	 | this based on your server hardware.
	 |
	 | If you are using sha1 the Admin password field needs to be changed in order login as admin:
	 | 1283592850bc9a3e833d3f93ba181a1a8b3af67a
	 |
	 | If you are using bcrypt the Admin password field needs to be changed in order login as admin:
	 | $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
	 |
	 | Be careful how high you set max_rounds, I would do your own testing on how long it takes
	 | to encrypt with x rounds.
	 */
    private $hashMethod = 'bcrypt'; // IMPORTANT: Make sure this is set to either sha1 or bcrypt (preferably bcrypt)
    private $defaultRounds = 8; // This does not apply if random_rounds is set to true
    private $randomRounds = false;
    private $minRounds = 5;
    private $maxRounds = 9;

    /*
	| -------------------------------------------------------------------------
	| Tables.
	| -------------------------------------------------------------------------
	| Database table names.
	*/
    private $tables = array(
        'users' => 'users',
        'groups' => 'groups',
        'users_groups' => 'users_groups',
        'login_attempts' => 'login_attempts',
    );

    /*
     | Users table column and Group table column you want to join WITH.
     |
     | Joins from users.id
     | Joins from groups.id
     */
    private $join = array(
        'users' => 'user_id',
        'groups' => 'group_id',
    );


    /*
	 | -------------------------------------------------------------------------
	 | Authentication options.
	 | -------------------------------------------------------------------------
	 | maximum_login_attempts: This maximum is not enforced by the library, but is
	 | used by $this->ion_auth->is_max_login_attempts_exceeded().
	 | The controller should check this function and act
	 | appropriately. If this variable set to 0, there is no maximum.
	 */
    private $siteTitle = "Example.com"; // Site Title, example.com
    private $adminEmail = "admin@example.com"; // Admin Email, admin@example.com
    private $defaultGroup = 'members'; // Default group, use name
    private $adminGroup = 'admin'; // Default administrators group, use name
    private $identity = 'email'; // A database column which is used to login with
    private $minPasswordLength = 8; // Minimum Required Length of Password
    private $maxPasswordLength = 20; // Maximum Allowed Length of Password
    private $emailActivation = false; // Email Activation for registration
    private $manualActivation = false; // Manual Activation for registration
    private $rememberUsers = true; // Allow users to be remembered and enable auto-login
    private $userExpire = 86500; // How long to remember the user (seconds). Set to zero for no expiration
    private $userExtendOnLogin = false; // Extend the users cookies everytime they auto-login
    private $trackLoginAttempts = false; // Track the number of failed login attempts for each user or ip.
    private $maximumLoginAttempts = 3; // The maximum number of failed login attempts.
    private $lockoutTime = 600; // The number of seconds to lockout an account due to exceeded attempts
    private $forgotPasswordExpiration = 0; // The number of miliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.

    /*
     | -------------------------------------------------------------------------
     | Email options.
     | -------------------------------------------------------------------------
     | email_config:
     | 	  'file' = Use the default CI config or use from a config file
     | 	  array  = Manually set your email config settings
     */
    private $useDefaultEmail = false; // Send Email using the builtin email functionality, if false it will return the code and the identity
    private $emailConfig = array('mailtype' => 'html');

    /*
     | -------------------------------------------------------------------------
     | Email templates.
     | -------------------------------------------------------------------------
     | Folder where email templates are stored.
     | Default: auth/
     */
    private $emailTemplates = 'auth/email/';

    /*
	 | -------------------------------------------------------------------------
	 | Activate Account Email Template
	 | -------------------------------------------------------------------------
	 | Default: activate.tpl.php
	 */
    private $emailActivate = 'activate.tpl.php';

    /*
     | -------------------------------------------------------------------------
     | Forgot Password Email Template
     | -------------------------------------------------------------------------
     | Default: forgotPassword.tpl.php
     */
    private $emailForgotPassword = 'forgotPassword.tpl.php';

    /*
     | -------------------------------------------------------------------------
     | Forgot Password Complete Email Template
     | -------------------------------------------------------------------------
     | Default: newPassword.tpl.php
     */
    private $emailForgotPasswordComplete = 'newPassword.tpl.php';

    /*
	 | -------------------------------------------------------------------------
	 | Salt options
	 | -------------------------------------------------------------------------
	 | saltLength Default: 10
	 |
	 | storeSalt: Should the salt be stored in the database?
	 | This will change your password encryption algorithm,
	 | default password, 'password', changes to
	 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
	 */
    private $saltLength = 10;
    private $storeSalt = false;

    /*
     | -------------------------------------------------------------------------
     | Message Delimiters.
     | -------------------------------------------------------------------------
     */
    private $messageStartDelimiter = '<p>'; // Message start delimiter
    private $messageEndDelimiter = '</p>'; // Message end delimiter
    private $errorStartDelimiter = '<p>'; // Error message start delimiter
    private $errorEndDelimiter = '</p>'; // Error message end delimiter

    public function get($key)
    {
        return $this->$key;
    }

    /**
     * @param string $adminEmail
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * @param string $adminGroup
     */
    public function setAdminGroup($adminGroup)
    {
        $this->adminGroup = $adminGroup;
    }

    /**
     * @param string $defaultGroup
     */
    public function setDefaultGroup($defaultGroup)
    {
        $this->defaultGroup = $defaultGroup;
    }

    /**
     * @param int $defaultRounds
     */
    public function setDefaultRounds($defaultRounds)
    {
        $this->defaultRounds = $defaultRounds;
    }

    /**
     * @param string $emailActivate
     */
    public function setEmailActivate($emailActivate)
    {
        $this->emailActivate = $emailActivate;
    }

    /**
     * @param boolean $emailActivation
     */
    public function setEmailActivation($emailActivation)
    {
        $this->emailActivation = $emailActivation;
    }

    /**
     * @param array $emailConfig
     */
    public function setEmailConfig($emailConfig)
    {
        $this->emailConfig = $emailConfig;
    }

    /**
     * @param string $emailForgotPassword
     */
    public function setEmailForgotPassword($emailForgotPassword)
    {
        $this->emailForgotPassword = $emailForgotPassword;
    }

    /**
     * @param string $emailForgotPasswordComplete
     */
    public function setEmailForgotPasswordComplete($emailForgotPasswordComplete)
    {
        $this->emailForgotPasswordComplete = $emailForgotPasswordComplete;
    }

    /**
     * @param string $emailTemplates
     */
    public function setEmailTemplates($emailTemplates)
    {
        $this->emailTemplates = $emailTemplates;
    }

    /**
     * @param string $errorEndDelimiter
     */
    public function setErrorEndDelimiter($errorEndDelimiter)
    {
        $this->errorEndDelimiter = $errorEndDelimiter;
    }

    /**
     * @param string $errorStartDelimiter
     */
    public function setErrorStartDelimiter($errorStartDelimiter)
    {
        $this->errorStartDelimiter = $errorStartDelimiter;
    }

    /**
     * @param int $forgotPasswordExpiration
     */
    public function setForgotPasswordExpiration($forgotPasswordExpiration)
    {
        $this->forgotPasswordExpiration = $forgotPasswordExpiration;
    }

    /**
     * @param string $hashMethod
     * @throws ConfigurationException
     */
    public function setHashMethod($hashMethod)
    {
        if (!in_array($hashMethod, array('bcrypt', 'sha1'))) {
            throw new ConfigurationException();
        }
        $this->hashMethod = $hashMethod;
    }

    /**
     * @param string $identity
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;
    }

    /**
     * @param array $join
     */
    public function setJoin($join)
    {
        $this->join = $join;
    }

    /**
     * @param int $lockoutTime
     */
    public function setLockoutTime($lockoutTime)
    {
        $this->lockoutTime = $lockoutTime;
    }

    /**
     * @param boolean $manualActivation
     */
    public function setManualActivation($manualActivation)
    {
        $this->manualActivation = $manualActivation;
    }

    /**
     * @param int $maxPasswordLength
     */
    public function setMaxPasswordLength($maxPasswordLength)
    {
        $this->maxPasswordLength = $maxPasswordLength;
    }

    /**
     * @param int $maxRounds
     */
    public function setMaxRounds($maxRounds)
    {
        $this->maxRounds = $maxRounds;
    }

    /**
     * @param int $maximumLoginAttempts
     */
    public function setMaximumLoginAttempts($maximumLoginAttempts)
    {
        $this->maximumLoginAttempts = $maximumLoginAttempts;
    }

    /**
     * @param string $messageEndDelimiter
     */
    public function setMessageEndDelimiter($messageEndDelimiter)
    {
        $this->messageEndDelimiter = $messageEndDelimiter;
    }

    /**
     * @param string $messageStartDelimiter
     */
    public function setMessageStartDelimiter($messageStartDelimiter)
    {
        $this->messageStartDelimiter = $messageStartDelimiter;
    }

    /**
     * @param int $minPasswordLength
     */
    public function setMinPasswordLength($minPasswordLength)
    {
        $this->minPasswordLength = $minPasswordLength;
    }

    /**
     * @param int $minRounds
     */
    public function setMinRounds($minRounds)
    {
        $this->minRounds = $minRounds;
    }

    /**
     * @param boolean $randomRounds
     */
    public function setRandomRounds($randomRounds)
    {
        $this->randomRounds = $randomRounds;
    }

    /**
     * @param boolean $rememberUsers
     */
    public function setRememberUsers($rememberUsers)
    {
        $this->rememberUsers = $rememberUsers;
    }

    /**
     * @param int $saltLength
     */
    public function setSaltLength($saltLength)
    {
        $this->saltLength = $saltLength;
    }

    /**
     * @param string $siteTitle
     */
    public function setSiteTitle($siteTitle)
    {
        $this->siteTitle = $siteTitle;
    }

    /**
     * @param boolean $storeSalt
     */
    public function setStoreSalt($storeSalt)
    {
        $this->storeSalt = $storeSalt;
    }

    /**
     * @param array $tables
     */
    public function setTables($tables)
    {
        $this->tables = $tables;
    }

    /**
     * @param boolean $trackLoginAttempts
     */
    public function setTrackLoginAttempts($trackLoginAttempts)
    {
        $this->trackLoginAttempts = $trackLoginAttempts;
    }

    /**
     * @param boolean $useDefaultEmail
     */
    public function setUseDefaultEmail($useDefaultEmail)
    {
        $this->useDefaultEmail = $useDefaultEmail;
    }

    /**
     * @param int $userExpire
     */
    public function setUserExpire($userExpire)
    {
        $this->userExpire = $userExpire;
    }

    /**
     * @param boolean $userExtendOnLogin
     */
    public function setUserExtendOnLogin($userExtendOnLogin)
    {
        $this->userExtendOnLogin = $userExtendOnLogin;
    }


} 