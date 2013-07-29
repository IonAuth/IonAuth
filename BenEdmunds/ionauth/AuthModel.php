<?php namespace BenEdmunds\IonAuth;
/**
  * Name:  IonAuth
  *
  * Author:  Ben Edmunds
  * 		   ben.edmunds@gmail.com
  *	  	   @benedmunds
  *
  * Location: http://github.com/benedmunds/PHP-Ion-Auth
  *
  * Created:  10.01.2009
  *
  *
  * Description:  A super simple authentication class compatible with all PHP applications.
  *               This is a port from CodeIgniter Ion Auth to be more generic.
  *
  * Requirements: PHP 5.3.7 or above
  *
  */

class AuthModel {

	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	protected $config = array();

	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	public $tables = array();

	/**
	 * activation code
	 *
	 * @var string
	 **/
	public $activationCode;

	/**
	 * forgotten password key
	 *
	 * @var string
	 **/
	public $forgottenPasswordCode;

	/**
	 * new password
	 *
	 * @var string
	 **/
	public $newPassword;

	/**
	 * Identity
	 *
	 * @var string
	 **/
	public $identity;

	/**
	 * Where
	 *
	 * @var array
	 **/
	public $_ionWhere = array();

	/**
	 * Select
	 *
	 * @var array
	 **/
	public $_ionSelect = array();

	/**
	 * Like
	 *
	 * @var array
	 **/
	public $_ionLike = array();

	/**
	 * Limit
	 *
	 * @var string
	 **/
	public $_ionLimit = NULL;

	/**
	 * Offset
	 *
	 * @var string
	 **/
	public $_ionOffset = NULL;

	/**
	 * Order By
	 *
	 * @var string
	 **/
	public $_ionOrderBy = NULL;

	/**
	 * Order
	 *
	 * @var string
	 **/
	public $_ionOrder = NULL;

	/**
	 * Hooks
	 *
	 * @var object
	 **/
	protected $_ionHooks;

	/**
	 * Response
	 *
	 * @var string
	 **/
	protected $response = NULL;

	/**
	 * message (uses lang file)
	 *
	 * @var string
	 **/
	protected $messages = array();

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors = array();

	/**
	 * error start delimiter
	 *
	 * @var string
	 **/
	protected $errorStartDelimiter;

	/**
	 * error end delimiter
	 *
	 * @var string
	 **/
	protected $errorEndDelimiter;

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cacheUserInGroup = array();

	/**
	 * caching of groups
	 *
	 * @var array
	 **/
	protected $_cacheGroups = array();

	/**
	 * cost of bcrypt hashing
	 *
	 * @var int
	 **/
	protected $_bcryptCost = 4;


	public function __construct($config)
	{
		$this->config = $config;
		$this->initDb();

		//initialize our hooks object
		$this->_ionHooks = new \stdClass;

		//load the bcrypt class if needed
		if ($this->config['hashMethod'] == 'bcrypt') {
			if ($this->config['randomRounds'])
			{
				$rand   = rand($this->minRounds, $this->maxRounds);
				$rounds = array('rounds' => $rand);
			}
			else
			{
				$rounds = array('rounds' => $this->config['defaultRounds']);
			}

		}

		$this->triggerEvents('constructor');
		$this->triggerEvents('modelConstructor');
	}

	public function initDb()
	{
		$this->db = new \Illuminate\Database\Capsule\Manager;

		$this->db->addConnection($this->config['database']);
		$this->db->setAsGlobal();
		$this->db->setFetchMode(\PDO::FETCH_CLASS);
	}

	/**
	 * Misc functions
	 *
	 * Hash password : Hashes the password to be stored in the database.
	 * Hash password db : This function takes a password and validates it
	 * against an entry in the users table.
	 * Salt : Generates a random salt value.
	 *
	 * @author Mathew
	 */

	/**
	 * Hashes the password to be stored in the database.
	 *
	 * @return void
	 * @author Matthew
	 **/
	public function hashPassword($password, $salt=FALSE, $useSha1Override=FALSE)
	{
		if (empty($password)) {
			return FALSE;
		}

		//bcrypt
		if ($this->config['hashMethod'] == 'sha1') {
			if ($this->config['storeSalt'] && $salt) {
				return sha1($password . $salt);
			}
			else {
				$salt = $this->salt();
				return  $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
			}
		}
		else if ($useSha1Override === FALSE && $this->config['hashMethod'] == 'oldBcrypt') {
			return $this->bcrypt->hash($password);
		}
		else {
			return password_hash($password, PASSWORD_BCRYPT, array("cost" => $this->_bcryptCost));
		}
	}

	/**
	 * This function takes a password and validates it
	 * against an entry in the users table.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function hashPasswordDb($id, $password)
	{
		if (empty($id) || empty($password)) {
			return FALSE;
		}

		$this->triggerEvents('extraWhere');

		$query = $this->db->table($this->config['tables']['users'])
		                  ->select(array('password', 'salt'))
		                  ->where('id', '=', $id)
		                  ->take(1);

		$hashPasswordDb = $query->first();

		if (count($query) !== 1) {
			return FALSE;
		}


		if ($this->config['hashMethod'] == 'sha1') {
			if ($this->config['storeSalt']) {
				$dbPassword = sha1($password . $hashPasswordDb->salt);
			}
			else {
				$salt = substr($hashPasswordDb->password, 0, $this->config['saltLength']);

				$dbPassword =  $salt . substr(sha1($salt . $password), 0, -$this->config['saltLength']);
			}

			if ($dbPassword == $hashPasswordDb->password) {
				return TRUE;
			}
			else {
				return FALSE;
			}
		}
		else if ($this->config['hashMethod'] == 'oldBcrypt') {
			if ($this->bcrypt->verify($password, $hashPasswordDb->password)) {
				return TRUE;
			}

			return FALSE;
		}
		else {
			$dbPassword = $this->hashPassword($password);

			if ($password === $hashPasswordDb->password) {
				return TRUE;
			}

			return FALSE;
		}
	}

	/**
	 * Generates a random salt value for forgotten passwords or any other keys. Uses SHA1.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function hashCode($password)
	{
		return $this->hashPassword($password, FALSE, TRUE);
	}

	/**
	 * Generates a random salt value.
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function salt()
	{
		return substr(md5(uniqid(rand(), TRUE)), 0, $this->saltLength);
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
	public function activate($id, $code = FALSE)
	{
		$this->triggerEvents('pre_activate');

		if ($code !== FALSE) {
			$query = $this->db->select($this->identityColumn)
			                  ->where('activation_code', $code)
			                  ->take(1)
			                  ->get($this->tables['users']);

			$result = $query->first();

			if (count($query) !== 1) {
				$this->triggerEvents(array('postActivate', 'postActivateUnsuccessful'));
				$this->setError('activateUnsuccessful');
				return FALSE;
			}

			$identity = $result->{$this->identityColumn};

			$data = array(
			    'activationCode' => NULL,
			    'active'          => 1
			);

			$this->triggerEvents('extraWhere');
			$this->db->update($this->tables['users'], $data, array($this->identityColumn => $identity));
		}
		else {
			$data = array(
			    'activation_code' => NULL,
			    'active'          => 1
			);


			$this->triggerEvents('extraWhere');
			$this->db->update($this->tables['users'], $data, array('id' => $id));
		}


		if ($this->db->affected_rows() == 1) {
			$this->triggerEvents(array('postActivate', 'postActivateSuccessful'));
			$this->setMessage('activateSuccessful');
		}
		else {
			$this->triggerEvents(array('postActivate', 'postActivateUnsuccessful'));
			$this->setError('activateUnsuccessful');
		}


		return $return;
	}


	/**
	 * Deactivate
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function deactivate($id = NULL)
	{
		$this->triggerEvents('deactivate');

		if (!isset($id)) {
			$this->setError('deactivateUnsuccessful');
			return FALSE;
		}

		$activationCode       = sha1(md5(microtime()));
		$this->activationCode = $activationCode;

		$data = array(
		    'activation_code' => $activationCode,
		    'active'          => 0
		);

		$this->triggerEvents('extraWhere');
		$this->db->update($this->tables['users'], $data, array('id' => $id));

		$return = $this->db->affected_rows() == 1;
		if ($return) {
			$this->setMessage('deactivateSuccessful');
		}
		else {
			$this->setError('deactivateUnsuccessful');
		}

		return $return;
	}

	public function clearForgottenPasswordCode($code) {

		if (empty($code)) {
			return FALSE;
		}

		$this->db->where('forgottenPasswordCode', $code);

		if ($this->db->count_all_results($this->tables['users']) > 0) {
			$data = array(
			    'forgottenPasswordCode' => NULL,
			    'forgottenPasswordTime' => NULL
			);

			$this->db->update($this->tables['users'], $data, array('forgottenPasswordCode' => $code));

			return TRUE;
		}

		return FALSE;
	}

	/**
	 * reset password
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function resetPassword($identity, $new) {
		$this->triggerEvents('preChangePassword');

		if (!$this->identityCheck($identity)) {
			$this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
			return FALSE;
		}

		$this->triggerEvents('extraWhere');

		$query = $this->db->select('id, password, salt')
		                  ->where($this->identityColumn, $identity)
		                  ->take(1)
		                  ->get($this->tables['users']);

		if (count($query) !== 1)
		{
			$this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
			$this->setError('passwordChangeUnsuccessful');
			return FALSE;
		}

		$result = $query->first();

		$new = $this->hashPassword($new, $result->salt);

		//store the new password and reset the remember code so all remembered instances have to re-login
		//also clear the forgotten password code
		$data = array(
		    'password' => $new,
		    'remember_code' => NULL,
		    'forgotten_password_code' => NULL,
		    'forgotten_password_time' => NULL,
		);

		$this->triggerEvents('extraWhere');
		$this->db->update($this->tables['users'], $data, array($this->identityColumn => $identity));

		$return = $this->db->affected_rows() == 1;
		if ($return) {
			$this->triggerEvents(array('postChangePassword', 'postChangePasswordSuccessful'));
			$this->setMessage('passwordChangeSuccessful');
		}
		else {
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
			return FALSE;
		}

		$user = $query->first();

		$oldPasswordMatches = $this->hashPasswordDb($user->id, $old);

		if ($oldPasswordMatches === TRUE) {
			//store the new password and reset the remember code so all remembered instances have to re-login
			$hashedNewPassword  = $this->hashPassword($new, $user->salt);
			$data = array(
			    'password' => $hashedNewPassword,
			    'remember_code' => NULL,
			);

			$this->triggerEvents('extra_where');

			$successfullyChangedPasswordInDb = $this->db->update($this->tables['users'], $data, array($this->identityColumn => $identity));
			if ($successfullyChangedPasswordInDb) {
				$this->triggerEvents(array('postChangePassword', 'postChangePassword_Successful'));
				$this->setMessage('passwordChangeSuccessful');
			}
			else {
				$this->triggerEvents(array('postChangePassword', 'postChangePasswordUnsuccessful'));
				$this->setError('passwordChangeUnsuccessful');
			}

			return $successfullyChangedPasswordInDb;
		}

		$this->setError('passwordChangeUnsuccessful');
		return FALSE;
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
			return FALSE;
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

		if (empty($email))
		{
			return FALSE;
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
			return FALSE;
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
	public function forgottenPassword($identity)
	{
		if (empty($identity)) {
			$this->triggerEvents(array('postForgottenPassword', 'postForgottenPasswordUnsuccessful'));
			return FALSE;
		}

		//All some more randomness
		$activationCodePart = "";
		if (function_exists("openssl_random_pseudo_bytes")) {
			$activationCodePart = openssl_random_pseudo_bytes(128);
		}

		for ($i=0;$i<1024;$i++) {
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
		}
		else {
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
	public function forgottenPasswordComplete($code, $salt=FALSE)
	{
		$this->triggerEvents('preForgottenPasswordComplete');

		if (empty($code)) {
			$this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful'));
			return FALSE;
		}

		$profile = $this->where('forgottenPasswordCode', $code)->users()->first(); //pass the code to profile

		if ($profile) {

			if ($this->config['forgotPasswordExpiration'] > 0) {
				//Make sure it isn't expired
				$expiration = $this->config['forgotPasswordExpiration'];
				if (time() - $profile->forgotten_password_time > $expiration) {
					//it has expired
					$this->setError('forgotPasswordExpired');
					$this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful'));
					return FALSE;
				}
			}

			$password = $this->salt();

			$data = array(
			    'password'                => $this->hashPassword($password, $salt),
			    'forgotten_password_code' => NULL,
			    'active'                  => 1,
			 );

			$this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

			$this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteSuccessful'));
			return $password;
		}

		$this->triggerEvents(array('postForgottenPasswordComplete', 'postForgottenPasswordCompleteUnsuccessful'));
		return FALSE;
	}

	/**
	 * register
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function register($username, $password, $email, $additionalData = array(), $groups = array())
	{
		$this->triggerEvents('preRegister');

		$manualActivation = $this->config['manual_activation'];

		if ($this->identityColumn == 'email' && $this->emailCheck($email)) {
			$this->setError('accountCreationDuplicate_email');
			return FALSE;
		}
		elseif ($this->identityColumn == 'username' && $this->usernameCheck($username)) {
			$this->setError('accountCreationDuplicateUsername');
			return FALSE;
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
		$salt       = $this->storeSalt ? $this->salt() : FALSE;
		$password   = $this->hashPassword($password, $salt);

		// Users table.
		$data = array(
		    'username'   => $username,
		    'password'   => $password,
		    'email'      => $email,
		    'ip_address' => $ipAddress,
		    'created_on' => time(),
		    'last_login' => time(),
		    'active'     => ($manualActivation === false ? 1 : 0)
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

		if (!empty($groups)) {
			//add to groups
			foreach ($groups as $group)
			{
				$this->addToGroup($group, $id);
			}
		}

		//add to default group if not already set
		$defaultGroup = $this->where('name', $this->config['defaultGroup'])->group()->first();
		if ((isset($defaultGroup->id) && !isset($groups)) || (empty($groups) && !in_array($defaultGroup->id, $groups)))
		{
			$this->addToGroup($defaultGroup->id, $id);
		}

		$this->triggerEvents('postRegister');

		return (isset($id)) ? $id : FALSE;
	}

	/**
	 * login
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function login($identity, $password, $remember=FALSE)
	{
		$this->triggerEvents('preLogin');

		if (empty($identity) || empty($password)) {
			$this->setError('loginUnsuccessful');
			return FALSE;
		}

		$this->triggerEvents('extraWhere');

		$query = $this->db->table($this->config['tables']['users'])
		                  ->select(array('id', $this->config['identity'], 'username', 'email', 'id', 'password', 'active', 'last_login'))
		                  ->where($this->config['identity'], $identity)
		                  ->take(1);

		if($this->isTimeLockedOut($identity))
		{
			//Hash something anyway, just to take up time
			$this->hashPassword($password);

			$this->triggerEvents('postLoginUnsuccessful');
			$this->setError('loginTimeout');

			return FALSE;
		}

		if (count($query) === 1) {
			$user = $query->first();

			$password = $this->hashPasswordDb($user->id, $password);

			if ($password === TRUE) {
				if ($user->active == 0) {
					$this->triggerEvents('post_login_unsuccessful');
					$this->setError('login_unsuccessful_not_active');

					return FALSE;
				}

				$this->setSession($user);

				$this->updateLastLogin($user->id);

				$this->clearLoginAttempts($identity);

				if ($remember && $this->config['remember_users'])
				{
					$this->rememberUser($user->id);
				}

				$this->triggerEvents(array('postLogin', 'postLoginSuccessful'));
				$this->setMessage('loginSuccessful');

				return TRUE;
			}
		}

		//Hash something anyway, just to take up time
		$this->hashPassword($password);

		$this->increaseLoginAttempts($identity);

		$this->triggerEvents('postLoginUnsuccessful');
		$this->setError('loginUnsuccessful');

		return FALSE;
	}

	/**
	 * is_max_login_attempts_exceeded
	 * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
	 *
	 * @param string $identity
	 * @return boolean
	 **/
	public function isMaxLoginAttemptsExceeded($identity) {
		if ($this->config['trackLoginAttempts']) {
			$maxAttempts = $this->config['maximumLoginAttempts'];
			if ($max_attempts > 0) {
				$attempts = $this->getAttemptsNum($identity);
				return $attempts >= $maxAttempts;
			}
		}
		return FALSE;
	}

	/**
	 * Get number of attempts to login occured from given IP-address or identity
	 * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
	 *
	 * @param	string $identity
	 * @return	int
	 */
	function getAttemptsNum($identity)
	{
		if ($this->config['trackLoginAttempts']) {
			$ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);

			$this->db->select('1', FALSE);
			$this->db->where('ip_address', $ipAddress);
			if (strlen($identity) > 0) $this->db->or_where('login', $identity);

			$qres = $this->db->get($this->tables['loginAttempts']);
			return count($qres);
		}
		return 0;
	}

	/**
	 * Get a boolean to determine if an account should be locked out due to
	 * exceeded login attempts within a given period
	 *
	 * @return	boolean
	 */
	public function isTimeLockedOut($identity) {

		return $this->isMaxLoginAttemptsExceeded($identity) && $this->getLastAttemptTime($identity) > time() - $this->config['lockout_time'];
	}

	/**
	 * Get the time of the last time a login attempt occured from given IP-address or identity
	 *
	 * @param	string $identity
	 * @return	int
	 */
	public function getLastAttemptTime($identity) {
		if ($this->config['trackLoginAttempts']) {
			$ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);

			$this->db->select_max('time');
			$this->db->where('ip_address', $ipAddress);
			if (strlen($identity) > 0) $this->db->or_where('login', $identity);
			$qres = $this->db->get($this->tables['loginAttempts'], 1);

			if(count($qres) > 0) {
				return $qres->first()->time;
			}
		}

		return 0;
	}

	/**
	 * increase_login_attempts
	 * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
	 *
	 * @param string $identity
	 **/
	public function increaseLoginAttempts($identity) {
		if ($this->config['trackLoginAttempts']) {
			$ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);
			return $this->db->insert($this->tables['loginAttempts'], array('ip_address' => $ipAddress, 'login' => $identity, 'time' => time()));
		}
		return FALSE;
	}

	/**
	 * clear_login_attempts
	 * Based on code from Tank Auth, by Ilya Konyukhov (https://github.com/ilkon/Tank-Auth)
	 *
	 * @param string $identity
	 **/
	public function clearLoginAttempts($identity, $expire_period = 86400) {
		if ($this->config['trackLoginAttempts']) {
			$ipAddress = $this->_prepareIp($_SERVER['REMOTE_ADDR']);

			$this->db->where(array('ip_address' => $ipAddress, 'login' => $identity));
			// Purge obsolete login attempts
			$this->db->or_where('time <', time() - $expirePeriod, FALSE);

			return $this->db->delete($this->tables['loginAttempts']);
		}
		return FALSE;
	}

	public function limit($limit)
	{
		$this->triggerEvents('limit');
		$this->_ionLimit = $limit;

		return $this;
	}

	public function offset($offset)
	{
		$this->triggerEvents('offset');
		$this->_ionOffset = $offset;

		return $this;
	}

	public function where($where, $value = NULL)
	{
		$this->triggerEvents('where');

		if (!is_array($where)) {
			$where = array($where => $value);
		}

		array_push($this->_ionWhere, $where);

		return $this;
	}

	public function like($like, $value = NULL)
	{
		$this->triggerEvents('like');

		if (!is_array($like)) {
			$like = array($like => $value);
		}

		array_push($this->_ionLike, $like);

		return $this;
	}

	public function select($select)
	{
		$this->triggerEvents('select');

		$this->_ionSelect[] = $select;

		return $this;
	}

	public function order_by($by, $order='desc')
	{
		$this->triggerEvents('order_by');

		$this->_ionOrderBy = $by;
		$this->_ionOrder   = $order;

		return $this;
	}

	public function row()
	{
		$this->triggerEvents('row');

		$row = $this->response->first();
		//$this->response->free_result();

		return $row;
	}

	public function rowArray()
	{
		$this->triggerEvents(array('row', 'row_array'));

		$row = $this->response->row_array();
		//$this->response->free_result();

		return $row;
	}

	public function result()
	{
		$this->triggerEvents('result');

		$result = $this->response->get();
		//$this->response->free_result();

		return $result;
	}

	public function resultArray()
	{
		$this->triggerEvents(array('result', 'result_array'));

		$result = $this->response->result_array();
		//$this->response->free_result();

		return $result;
	}

	public function numRows()
	{
		$this->triggerEvents(array('numRows'));

		$result = count($this->response);
		//$this->response->free_result();

		return $result;
	}

	/**
	 * users
	 *
	 * @return object Users
	 * @author Ben Edmunds
	 **/
	public function users($groups = NULL)
	{
		$this->triggerEvents('users');

		if (isset($this->_ionSelect) && !empty($this->_ionSelect)) {
			foreach ($this->_ionSelect as $select) {
				$this->db->select($select);
			}

			$this->_ionSelect = array();
		}
		else {
			//default selects
			$this->db->select(array(
			    $this->tables['users'].'.*',
			    $this->tables['users'].'.id as id',
			    $this->tables['users'].'.id as user_id'
			));
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
				    $this->tables['usersGroups'].'.'.$this->join['users'].'='.$this->tables['users'].'.id',
				    'inner'
				);

				$this->db->where_in($this->tables['usersGroups'].'.'.$this->join['groups'], $groups);
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

			$this->_ionLimit  = NULL;
			$this->_ionOffset = NULL;
		}
		else if (isset($this->_ionLimit)) {
			$this->db->take($this->_ionLimit);

			$this->_ionLimit  = NULL;
		}

		//set the order
		if (isset($this->_ionOrderBy) && isset($this->_ionOrder)) {
			$this->db->order_by($this->_ionOrderBy, $this->_ionOrder);

			$this->_ionOrder    = NULL;
			$this->_ionOrderBy = NULL;
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
	public function user($id = NULL)
	{
		$this->triggerEvents('user');

		//if no id was passed use the current users id
		$id || $id = $this->session->userdata('userId');

		$this->take(1);
		$this->where($this->tables['users'].'.id', $id);

		$this->users();

		return $this;
	}

	/**
	 * get_users_groups
	 *
	 * @return array
	 * @author Ben Edmunds
	 **/
	public function getUsersGroups($id=FALSE)
	{
		$this->triggerEvents('getUsersGroup');

		//if no id was passed use the current users id
		$id || $id = $this->session->userdata('userId');

		return $this->db->select($this->tables['usersGroups'].'.'.$this->join['groups'].' as id, '.$this->tables['groups'].'.name, '.$this->tables['groups'].'.description')
		                ->where($this->tables['usersGroups'].'.'.$this->join['users'], $id)
		                ->join($this->tables['groups'], $this->tables['usersGroups'].'.'.$this->join['groups'].'='.$this->tables['groups'].'.id')
		                ->get($this->tables['usersGroups']);
	}

	/**
	 * add_to_group
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function addToGroup($groupId, $userId=false)
	{
		$this->triggerEvents('addToGroup');

		//if no id was passed use the current users id
		$user_id || $user_id = $this->session->userdata('userId');

		//check if unique - num_rows() > 0 means row found
		if (count($this->db->where(array( $this->join['groups'] => (int)$groupId, $this->join['users'] => (int)$userId))->get($this->tables['usersGroups']))) {
			return FALSE;
		}

		if ($return = $this->db->insert($this->tables['usersGroups'], array( $this->join['groups'] => (int)$groupId, $this->join['users'] => (int)$userId)))
		{
			if (isset($this->_cacheGroups[$groupId])) {
				$groupName = $this->_cacheGroups[$groupId];
			}
			else {
				$group = $this->group($groupId)->result();
				$groupName = $group[0]->name;
				$this->_cacheGroups[$groupId] = $groupName;
			}
			$this->_cacheUserInGroup[$userId][$groupId] = $groupName;
		}
		return $return;
	}

	/**
	 * remove_from_group
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function remove_from_group($group_ids=false, $user_id=false)
	{
		$this->triggerEvents('removeFromGroup');

		// user id is required
		if(empty($userId)) {
			return FALSE;
		}

		// if group id(s) are passed remove user from the group(s)
		if (!empty($groupIds)) {
			if (!is_array($groupIds)) {
				$groupIds = array($groupIds);
			}

			foreach($groupIds as $groupId)
			{
				$this->db->delete($this->tables['usersGroups'], array($this->join['groups'] => (int)$groupId, $this->join['users'] => (int)$user_id));
				if (isset($this->_cacheUserInGroup[$userId]) && isset($this->_cacheUserInGroup[$userId][$groupId]))
				{
					unset($this->_cacheUserInGroup[$userId][$groupId]);
				}
			}

			$return = TRUE;
		}
		// otherwise remove user from all groups
		else {
			if ($return = $this->db->delete($this->tables['usersGroups'], array($this->join['users'] => (int)$userId))) {
				$this->_cacheUserInGroup[$userId] = array();
			}
		}

		return $return;
	}

	/**
	 * groups
	 *
	 * @return object
	 * @author Ben Edmunds
	 **/
	public function groups()
	{
		$this->triggerEvents('groups');

		//run each where that was passed
		if (isset($this->_ionWhere) && !empty($this->_ionWhere)) {
			foreach ($this->_ionWhere as $where)
			{
				$this->db->where($where);
			}
			$this->_ionWhere = array();
		}

		if (isset($this->_ionLimit) && isset($this->_ionOffset)) {
			$this->db->take($this->_ionLimit, $this->_ionOffset);

			$this->_ionLimit  = NULL;
			$this->_ionOffset = NULL;
		}
		else if (isset($this->_ionLimit)) {
			$this->db->take($this->_ionLimit);

			$this->_ionLimit  = NULL;
		}

		//set the order
		if (isset($this->_ionOrderBy) && isset($this->_ionOrder)) {
			$this->db->order_by($this->_ionOrderBy, $this->_ionOrder);
		}

		$this->response = $this->db->get($this->tables['groups']);

		return $this;
	}

	/**
	 * group
	 *
	 * @return object
	 * @author Ben Edmunds
	 **/
	public function group($id = NULL)
	{
		$this->triggerEvents('group');

		if (isset($id)) {
			$this->db->where($this->tables['groups'].'.id', $id);
		}

		$this->take(1);

		return $this->groups();
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

		if (array_key_exists($this->identityColumn, $data) && $this->identityCheck($data[$this->identityColumn]) && $user->{$this->identityColumn} !== $data[$this->identityColumn]) {
			$this->db->trans_rollback();
			$this->setError('accountCreationDuplicate'.ucwords($this->identityColumn));

			$this->triggerEvents(array('postUpdateUser', 'postUpdateUserUnsuccessful'));
			$this->setError('updateUnsuccessful');

			return FALSE;
		}

		// Filter the data passed
		$data = $this->_filterData($this->tables['users'], $data);

		if (array_key_exists('username', $data) || array_key_exists('password', $data) || array_key_exists('email', $data)) {
			if (array_key_exists('password', $data)) {
				if( ! empty($data['password'])) {
					$data['password'] = $this->hash_password($data['password'], $user->salt);
				}
				else {
					// unset password so it doesn't effect database entry if no password passed
					unset($data['password']);
				}
			}
		}

		$this->triggerEvents('extraWhere');
		$this->db->update($this->tables['users'], $data, array('id' => $user->id));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			$this->triggerEvents(array('postUpdateUser', 'postUpdateUserUnsuccessful'));
			$this->setError('updateUnsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->triggerEvents(array('postUpdateUser', 'postUpdateUserSuccessful'));
		$this->setMessage('updateSuccessful');
		return TRUE;
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
		$this->removeFromGroup(NULL, $id);

		// delete user from users table should be placed after remove from group
		$affectedRows = $this->db->delete($this->tables['users'], array('id' => $id));

		// if user does not exist in database then it returns FALSE else removes the user from groups
		if ($affectedRows == 0) {
		    return FALSE;
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->triggerEvents(array('postDeleteUser', 'postDeleteUserUnsuccessful'));
			$this->setError('deleteUnsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->triggerEvents(array('postDeleteUser', 'postDeleteUserSuccessful'));
		$this->setMessage('deleteSuccessful');
		return TRUE;
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

		$affectedRows = $this->db->table($this->config['tables']['users'])
		                         ->where('id', '=', $id)
		                         ->update(array('last_login' => time()));

		return $affectedRows == 1;
	}

	/**
	 * set_lang
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function setLang($lang = 'en')
	{
		$this->triggerEvents('set_lang');

		// if the user_expire is set to zero we'll set the expiration two years from now.
		if($this->config['userExpire'] === 0)
		{
			$expire = (60*60*24*365*2);
		}
		// otherwise use what is set
		else
		{
			$expire = $this->config['userExpire'];
		}

		$this->setCookie(array(
			'name'   => 'langCode',
			'value'  => $lang,
			'expire' => $expire
		));

		return TRUE;
	}

	/**
	 * set session
	 *
	 * @return bool
	 * @author jrmadsen67
	 **/
	public function setSession($user)
	{

		$this->triggerEvents('preSetSession');

		$sessionData = array(
		    'identity'             => $user->{$this->config['identity']},
		    'username'             => $user->username,
		    'email'                => $user->email,
		    'user_id'              => $user->id, //everyone likes to overwrite id so we'll use user_id
		    'old_last_login'       => $user->last_login
		);

		$_SESSION = array_merge($_SESSION, $sessionData);

		$this->triggerEvents('postSetSession');

		return TRUE;
	}

	/**
	 * remember_user
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function rememberUser($id)
	{
		$this->triggerEvents('preRememberUser');

		if (!$id) {
			return FALSE;
		}

		$user = $this->user($id)->first();

		$salt = sha1($user->password);

		$this->db->update($this->tables['users'], array('remember_code' => $salt), array('id' => $id));

		if ($this->db->affected_rows() > -1) {

			if ($this->config['userExpire'] === 0) {
				// if the user_expire is set to zero we'll set the expiration two years from now.
				$expire = (60*60*24*365*2);
			}
			else {
				// otherwise use what is set
				$expire = $this->config['userExpire'];
			}

			$this->setCookie(array(
			    'name'   => 'identity',
			    'value'  => $user->{$this->identityColumn},
			    'expire' => $expire
			));

			$this->setCookie(array(
			    'name'   => 'rememberCode',
			    'value'  => $salt,
			    'expire' => $expire
			));

			$this->triggerEvents(array('postRememberUser', 'rememberUserSuccessful'));
			return TRUE;
		}

		$this->triggerEvents(array('postRememberUser', 'rememberUserUnsuccessful'));
		return FALSE;
	}

	/**
	 * login_remembed_user
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function loginRememberedUser()
	{
		$this->triggerEvents('pre_login_remembered_user');

		//check for valid data
		if (!$this->getCookie('identity') || !$this->getCookie('rememberCode') || !$this->identityCheck($this->getCookie('identity'))) {
			$this->triggerEvents(array('postLoginRememberedUser', 'postLoginRememberedUserUnsuccessful'));
			return FALSE;
		}

		//get the user
		$this->triggerEvents('extraWhere');
		$query = $this->db->select($this->identityColumn.', id, username, email, last_login')
		                  ->where($this->identityColumn, $this->getCookie('identity'))
		                  ->where('remember_code', $this->getCookie('remember_code'))
		                  ->take(1)
		                  ->get($this->tables['users']);

		//if the user was found, sign them in
		if (count($query) == 1) {
			$user = $query->first();

			$this->updateLastLogin($user->id);

			$this->setSession($user);

			//extend the users cookies if the option is enabled
			if ($this->config['userExtendOnLogin']) {
				$this->rememberUser($user->id);
			}

			$this->triggerEvents(array('postLoginRememberedUser', 'postLoginRememberedUserSuccessful'));
			return TRUE;
		}

		$this->triggerEvents(array('postLoginRememberedUser', 'postLoginRememberedUserUnsuccessful'));
		return FALSE;
	}


	/**
	 * create_group
	 *
	 * @author aditya menon
	*/
	public function createGroup($groupName = FALSE, $groupDescription = '', $additionalData = array())
	{
		// bail if the group name was not passed
		if (!$groupName) {
			$this->setError('groupNameRequired');
			return FALSE;
		}

		// bail if the group name already exists
		$existing_group = count($this->db->get_where($this->tables['groups'], array('name' => $groupName)));
		if ($existingGroup !== 0) {
			$this->setError('groupAlreadyExists');
			return FALSE;
		}

		$data = array(
			'name'        => $group_name,
			'description' => $groupDescription
		);

		//filter out any data passed that doesnt have a matching column in the groups table
		//and merge the set group data and the additional data
		if (!empty($additionalData)) {
			$data = array_merge($this->_filterData($this->tables['groups'], $additionalData), $data);
		}

		$this->triggerEvents('extraGroupSet');

		// insert the new group
		$this->db->insert($this->tables['groups'], $data);
		$groupId = $this->db->insert_id();

		// report success
		$this->setMessage('groupCreationSuccessful');

		// return the brand new group id
		return $groupId;
	}

	/**
	 * update_group
	 *
	 * @return bool
	 * @author aditya menon
	 **/
	public function updateGroup($groupId = FALSE, $groupName = FALSE, $additionalData = array())
	{
		if (empty($groupId)) return FALSE;

		$data = array();

		if (!empty($groupName))
		{
			// we are changing the name, so do some checks

			// bail if the group name already exists
			$existingGroup = $this->db->get_where($this->tables['groups'], array('name' => $groupName))->first();
			if(isset($existingGroup->id) && $existingGroup->id != $group_id)
			{
				$this->setError('groupAlreadyExists');
				return FALSE;
			}

			$data['name'] = $groupName;
		}


		// IMPORTANT!! Third parameter was string type $description; this following code is to maintain backward compatibility
		// New projects should work with 3rd param as array
		if (is_string($additionalData)) {
			$additionalData = array('description' => $additionalData);
		}


		//filter out any data passed that doesnt have a matching column in the groups table
		//and merge the set group data and the additional data
		if (!empty($additionalData)) {
			$data = array_merge($this->_filterData($this->tables['groups'], $additionalData), $data);
		}


		$this->db->update($this->tables['groups'], $data, array('id' => $groupId));

		$this->setMessage('groupUpdateSuccessful');

		return TRUE;
	}

	/**
	* delete group
	*
	* @return bool
	* @author aditya menon
	**/
	public function deleteGroup($groupId = FALSE)
	{
		// bail if mandatory param not set
		if (!$groupId || empty($groupId)) {
			return FALSE;
		}

		$this->triggerEvents('preDeleteGroup');

		$this->db->trans_begin();

		// remove all users from this group
		$this->db->delete($this->tables['usersGroups'], array($this->join['groups'] => $groupId));
		// remove the group itself
		$this->db->delete($this->tables['groups'], array('id' => $groupId));

		if ($this->db->trans_status() === FALSE)
		{
			$this->db->trans_rollback();
			$this->triggerEvents(array('postDeleteGroup', 'postDeleteGroupUnsuccessful'));
			$this->setError('groupDeleteUnsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->triggerEvents(array('postDeleteGroup', 'postDeleteGroupSuccessful'));
		$this->setMessage('groupDeleteSuccessful');
		return TRUE;
	}

	public function setHook($event, $name, $class, $method, $arguments)
	{
		$this->_ionHooks->{$event}[$name] = new stdClass;
		$this->_ionHooks->{$event}[$name]->class     = $class;
		$this->_ionHooks->{$event}[$name]->method    = $method;
		$this->_ionHooks->{$event}[$name]->arguments = $arguments;
	}

	public function removeHook($event, $name)
	{
		if (isset($this->_ionHooks->{$event}[$name])) {
			unset($this->_ionHooks->{$event}[$name]);
		}
	}

	public function removeHooks($event)
	{
		if (isset($this->_ionHooks->$event)) {
			unset($this->_ionHooks->$event);
		}
	}

	protected function _callHook($event, $name)
	{
		if (isset($this->_ionHooks->{$event}[$name]) && method_exists($this->_ionHooks->{$event}[$name]->class, $this->_ionHooks->{$event}[$name]->method)) {
			$hook = $this->_ionHooks->{$event}[$name];

			return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
		}

		return FALSE;
	}

	public function triggerEvents($events)
	{
		if (is_array($events) && !empty($events)) {
			foreach ($events as $event) {
				$this->triggerEvents($event);
			}
		}
		else {
			if (isset($this->_ionHooks->$events) && !empty($this->_ionHooks->$events)) {
				foreach ($this->_ionHooks->$events as $name => $hook) {
					$this->_callHook($events, $name);
				}
			}
		}
	}

	/**
	 * setMessage_delimiters
	 *
	 * Set the message delimiters
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function setMessageDelimiters($startDelimiter, $endDelimiter)
	{
		$this->messageStartDelimiter = $startDelimiter;
		$this->messageEndDelimiter   = $endDelimiter;

		return TRUE;
	}

	/**
	 * setError_delimiters
	 *
	 * Set the error delimiters
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function setErrorDelimiters($startDelimiter, $endDelimiter)
	{
		$this->errorStartDelimiter = $startDelimiter;
		$this->errorEndDelimiter   = $endDelimiter;

		return TRUE;
	}

	/**
	 * setMessage
	 *
	 * Set a message
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function setMessage($message)
	{
		$this->messages[] = $message;

		return $message;
	}

	/**
	 * messages
	 *
	 * Get the messages
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message) {
			$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';

			$_output .= $this->messageStartDelimiter . $messageLang . $this->messageEndDelimiter;
		}

		return $_output;
	}

	/**
	 * messages as array
	 *
	 * Get the messages as an array
	 *
	 * @return array
	 * @author Raul Baldner Junior
	 **/
	public function messagesArray($langify = TRUE)
	{
		if ($langify) {
			$_output = array();
			foreach ($this->messages as $message)
			{
				$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';

				$_output[] = $this->messageStartDelimiter . $messageLang . $this->messageEndDelimiter;
			}
			return $_output;
		}
		else {
			return $this->messages;
		}
	}

	/**
	 * setError
	 *
	 * Set an error message
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function setError($error)
	{
		$this->errors[] = $error;

		return $error;
	}

	/**
	 * errors
	 *
	 * Get the error message
	 *
	 * @return void
	 * @author Ben Edmunds
	 **/
	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error) {
			//TODO
			//$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
			$errorLang = $error;
			$_output .= $this->errorStartDelimiter . $errorLang . $this->errorEndDelimiter;
		}

		return $_output;
	}

	/**
	 * errors as array
	 *
	 * Get the error messages as an array
	 *
	 * @return array
	 * @author Raul Baldner Junior
	 **/
	public function errorsArray($langify = TRUE)
	{
		if ($langify) {
			$_output = array();
			foreach ($this->errors as $error) {
				$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';

				$_output[] = $this->errorStartDelimiter . $errorLang . $this->errorEndDelimiter;
			}

			return $_output;
		}
		else {
			return $this->errors;
		}
	}

	protected function _filterData($table, $data)
	{
		$filteredData = array();
		$columns = $this->db->list_fields($table);

		if (is_array($data)) {
			foreach ($columns as $column) {
				if (array_key_exists($column, $data)) {
					$filteredData[$column] = $data[$column];
				}
			}
		}

		return $filteredData;
	}

	protected function _prepareIp($ipAddress)
	{
		if ($this->config['database']['driver'] === 'postgre' || $this->config['database']['driver'] === 'sqlsrv' || $this->config['database']['driver'] === 'mssql') {
			return $ipAddress;
		}
		else {
			return inet_pton($ipAddress);
		}
	}

	public function getCookie($name)
	{
		if (isset($_COOKIE[$name])) {
			return $_COOKIE[$name];
		}
		else {
			return FALSE;
		}
	}

	public function setCookie($name, $value=NULL)
	{
		if (is_array($name) && !empty($name)) {
			foreach ($name as $n => $v) {
				setcookie($n, $v, $this->config['userExpire']);
			}
		}
		else {
			setcookie($name, $value, $this->config['userExpire']);
		}
	}

	public function deleteCookie($name)
	{
		if (isset($_COOKIE[$name])) {
			return setcookie($name, '', time() - 3600);
		}
		else {
			return FALSE;
		}
	}


	/**
	 * __get
	 *
	 * Tries to load variables from the config array if it exists
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	/*
	public function __get($var)
	{
		return $this->config[$var];
	}
	*/
}