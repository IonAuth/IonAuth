<?php
/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 8/18/14
 * Time: 5:23 PM
 */

namespace IonAuth\IonAuth\Config;

class Config
{

  /**
   * -------------------------------------------------------------------------
   * Database configuration
   * -------------------------------------------------------------------------
   * The configuration options of the database connection.
   *
   * -------------------------------------------------------------------------
   * Explanation of the variables.
   * -------------------------------------------------------------------------
   *
   * $database['driver']      = The driver of the database.
   * $database['host']        = The host of the database.
   * $database['database']    = The database name.
   * $database['username']    = The database user.
   * $database['password']    = The database users password.
   * $database['charset']     = The character set used in communicating with the database.
   * $database['collation']   = The character collation used in communicating with the database.
   * $database['prefix']      = The table prefix; e.g MY_table.
   * $database['fetch']       = The fetch driver of the database.
   */

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
	 * -------------------------------------------------------------------------
	 * Hash Method (sha1 or bcrypt or oldBcrypt)
	 * -------------------------------------------------------------------------
	 * Bcrypt is available in PHP 5.3.7+
	 *
	 * IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
	 * bcrypt instead of sha1.
	 *
	 * NOTE: bcrypt is now the default encryption method
	 *
	 * If you need backwards compatibility set hashMethod to "oldBcrypt"
	 *
	 * Below there is "defaultRounds" (cost) setting.  This defines how strong the encryption will be,
	 * but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
	 * this based on your server hardware.
	 *
	 * If you are using sha1 the Admin password field needs to be changed in order login as admin:
	 * 1283592850bc9a3e833d3f93ba181a1a8b3af67a
	 *
	 * If you are using bcrypt the Admin password field needs to be changed in order login as admin:
	 * $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
	 *
	 * Be careful how high you set max_rounds, I would do your own testing on how long it takes
	 * to encrypt with x rounds.
	 */

    private $hashMethod = 'bcrypt'; // IMPORTANT: Make sure this is set to either sha1 or bcrypt (preferably bcrypt)
    private $defaultRounds = 8; // This does not apply if random_rounds is set to true
    private $randomRounds = false;
    private $minRounds = 5;
    private $maxRounds = 9;

  /*
	 * -------------------------------------------------------------------------
	 * Tables.
	 * -------------------------------------------------------------------------
	 * Database table names.
   *
   * -------------------------------------------------------------------------
   * Explanation of the variables.
   * -------------------------------------------------------------------------
   * $tables['users']          = The table where the users are stored.
   * $tables['groups']         = The table where the group names are stored.
   * $tables['users_groups']   = The tables where the users groups are stored.
   * $tables['login_attempts'] = The tables where the login attempts will be stored.
   *
   * Users table column and Group table column you want to join WITH.
   * -------------------------------------------------------------------------
   * $join['users']  = Joins from user.id
   * $join['groups'] = Joins fromm groups.id
   *
	 */

    private $tables = array(
        'users' => 'users',
        'groups' => 'groups',
        'users_groups' => 'users_groups',
        'login_attempts' => 'login_attempts',
    );

    private $join = array(
        'users' => 'user_id',
        'groups' => 'group_id',
    );


   /*
	  * -------------------------------------------------------------------------
	  * Authentication options.
	  * -------------------------------------------------------------------------
	  * maximum_login_attempts: This maximum is not enforced by the library, but is
	  * used by $this->ion_auth->is_max_login_attempts_exceeded().
	  * The controller should check this function and act
	  * appropriately. If this variable set to 0, there is no maximum.
    *
    * -------------------------------------------------------------------------
    * Explanation of the variables.
    * -------------------------------------------------------------------------
    *
    * $siteTitle:                      Site Tutke, example.com
    * $adminMail:                      Admin email, admin@example.com
    * $defaultGroup:                   Default group, use name.
    * $dminGroup:                      Default administrators group, use name.
    * $identity:                       A database column which is used to login with.
    * $minPasswordLength:              Minimum required length of password.
    * $maxPasswordLength:              Maximum allowed length of password.
    * $emailActivation:                Email activation for registration.
    * $manualActivation:               Manual activation for registration.
    * $rememberusers:                  Allow users to be remembered and enable auto-login.
    * $userExpire:                     How long to remember the user (seconds). Set to zero for no expiration.
    * $userExtendOnLogin:              Extends the users cookies everytime they auto-login.
    * $trackLoginAttempts:             Track the number of failed login attempts for each user or ip.
    * $maximumLoginAttempts:           The maximum of failed login attempts.
    * $lockoutTime:                    The number of seconds to lockout an account due to exceeded attampts.
    * $forgotPasswordExpiration:       The number of miliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.
    */

    private $siteTitle = "Example.com";
    private $adminEmail = "admin@example.com";
    private $defaultGroup = 'members';
    private $adminGroup = 'admin';
    private $identity = 'email';
    private $minPasswordLength = 8;
    private $maxPasswordLength = 20;
    private $emailActivation = false;
    private $manualActivation = false;
    private $rememberUsers = true;
    private $userExpire = 86500;
    private $userExtendOnLogin = false;
    private $trackLoginAttempts = false;
    private $maximumLoginAttempts = 3;
    private $lockoutTime = 600;
    private $forgotPasswordExpiration = 0;

    /*
     * -------------------------------------------------------------------------
     * Email options.
     * -------------------------------------------------------------------------
     * email_config:
     * 	  'file' = Use the default CI config or use from a config file
     * 	  array  = Manually set your email config settings
     */
    private $useDefaultEmail = false; // Send Email using the builtin email functionality, if false it will return the code and the identity
    private $emailConfig = array('mailtype' => 'html');

    /*
     * -------------------------------------------------------------------------
     * Email templates.
     * -------------------------------------------------------------------------
     * Folder where email templates are stored.
     * Default: auth/
     */

    private $emailTemplates = 'auth/email/';

   /*
	  * -------------------------------------------------------------------------
	  * Activate Account Email Template
	  * -------------------------------------------------------------------------
	  * Default: activate.tpl.php
	  */

    private $emailActivate = 'activate.tpl.php';

   /*
    * -------------------------------------------------------------------------
    * Forgot Password Email Template
    * -------------------------------------------------------------------------
    * Default: forgotPassword.tpl.php
    */

    private $emailForgotPassword = 'forgotPassword.tpl.php';

    /*
     * -------------------------------------------------------------------------
     * Forgot Password Complete Email Template
     * -------------------------------------------------------------------------
     * Default: newPassword.tpl.php
     */

    private $emailForgotPasswordComplete = 'newPassword.tpl.php';

   /*
	  * -------------------------------------------------------------------------
	  * Salt options
	  * -------------------------------------------------------------------------
	  * saltLength Default: 10
	  *
	  * storeSalt: Should the salt be stored in the database?
	  * This will change your password encryption algorithm,
	  * default password, 'password', changes to
	  * fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
	  */

    private $saltLength = 10;
    private $storeSalt = false;

    /*
     * -------------------------------------------------------------------------
     * Message Delimiters.
     * -------------------------------------------------------------------------
     * Message delimiters of ion auth.
     *
     * -------------------------------------------------------------------------
     * Eplanation of the variables
     * -------------------------------------------------------------------------
     * $messageStartDelimiter  = Message start delimiter
     * $messageEndDelimiter    = Message end delimiter
     * $errorStartDelimiter    = Error message start delimiter
     * $errorEndDelimitter     = Error message end delimiter
     *
     */
    private $messageStartDelimiter = '<p>';
    private $messageEndDelimiter = '</p>';
    private $errorStartDelimiter = '<p>';
    private $errorEndDelimiter = '</p>';

    public function __set($method, $var)
    {
        throw new ConfigurationException('You cannot change Config variables once set');
    }

    /**
     * get
     *
     * @param $key
     * @return
     **/
    public function get($key)
    {
        return $this->$key;
    }

    /**
     * set admin email
     *
     * @param string $adminEmail
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * set admin group
     *
     * @param string $adminGroup
     */
    public function setAdminGroup($adminGroup)
    {
        $this->adminGroup = $adminGroup;
    }

    /**
     * set default group
     *
     * @param string $defaultGroup
     */
    public function setDefaultGroup($defaultGroup)
    {
        $this->defaultGroup = $defaultGroup;
    }

    /**
     * set default rounds
     *
     * @param int $defaultRounds
     */
    public function setDefaultRounds($defaultRounds)
    {
        $this->defaultRounds = $defaultRounds;
    }

    /**
     * set email active
     *
     * @param string $emailActivate
     */
    public function setEmailActivate($emailActivate)
    {
        $this->emailActivate = $emailActivate;
    }

    /**
     * set email activatioon
     *
     * @param boolean $emailActivation
     */
    public function setEmailActivation($emailActivation)
    {
        $this->emailActivation = $emailActivation;
    }

    /**
     * set email config
     *
     * @param array $emailConfig
     */
    public function setEmailConfig($emailConfig)
    {
        $this->emailConfig = $emailConfig;
    }

    /**
     * set email forgot password
     *
     * @param string $emailForgotPassword
     */
    public function setEmailForgotPassword($emailForgotPassword)
    {
        $this->emailForgotPassword = $emailForgotPassword;
    }

    /**
     * set email forgot password complete
     *
     * @param string $emailForgotPasswordComplete
     */
    public function setEmailForgotPasswordComplete($emailForgotPasswordComplete)
    {
        $this->emailForgotPasswordComplete = $emailForgotPasswordComplete;
    }

    /**
     * set email templates
     *
     * @param string $emailTemplates
     */
    public function setEmailTemplates($emailTemplates)
    {
        $this->emailTemplates = $emailTemplates;
    }

    /**
     * set error end delimiter
     *
     * @param string $errorEndDelimiter
     */
    public function setErrorEndDelimiter($errorEndDelimiter)
    {
        $this->errorEndDelimiter = $errorEndDelimiter;
    }

    /**
     * set error start delimiter
     *
     * @param string $errorStartDelimiter
     */
    public function setErrorStartDelimiter($errorStartDelimiter)
    {
        $this->errorStartDelimiter = $errorStartDelimiter;
    }

    /**
     * set forgot password expriration
     *
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
     * Set use default email
     *
     * @param boolean $useDefaultEmail
     */
    public function setUseDefaultEmail($useDefaultEmail)
    {
        $this->useDefaultEmail = $useDefaultEmail;
    }

    /**
     * Set user expire
     *
     * @param int $userExpire
     */
    public function setUserExpire($userExpire)
    {
        $this->userExpire = $userExpire;
    }

    /**
     * Set user e xtend on login
     *
     * @param boolean $userExtendOnLogin
     */
    public function setUserExtendOnLogin($userExtendOnLogin)
    {
        $this->userExtendOnLogin = $userExtendOnLogin;
    }

}
