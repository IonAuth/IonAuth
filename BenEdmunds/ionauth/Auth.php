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

class Auth
{

	/**
	 * ion auth model obj
	 *
	 * @var object
	 **/
	protected $ionAuthModel;

	/**
	 * account status ('not_activated', etc ...)
	 *
	 * @var string
	 **/
	protected $status;

	/**
	 * extra where
	 *
	 * @var array
	 **/
	public $_extraWhere = array();

	/**
	 * extra set
	 *
	 * @var array
	 **/
	public $_extraSet = array();

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cacheUserInGroup;

	/**
	 * __construct
	 *
	 * @return void
	 * @author Ben
	 **/
	public function __construct($config)
	{
		require('AuthModel.php');

		session_start();

		$this->config = $config;
		$this->ionAuthModel = new AuthModel($config);
		$this->ionAuthModel->initDb();

		$this->_cacheUserInGroup =& $this->ionAuthModel->_cacheUserInGroup;

		//auto-login the user if they are remembered
		if (!$this->loggedIn() && $this->ionAuthModel->getCookie('identity') && $this->ionAuthModel->getCookie('rememberCode'))
		{
			$this->ionAuthModel->loginRememberedUser();
		}

		$emailConfig = $this->config['emailConfig'];

		if ($this->config['useDefaultEmail'] && isset($emailConfig) && is_array($emailConfig))
		{
			$this->email->initialize($emailConfig);
		}

		$this->ionAuthModel->triggerEvents('libraryConstructor');
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 **/
	public function __call($method, $arguments)
	{
		if (!method_exists( $this->ionAuthModel, $method))
		{
			throw new Exception('Undefined method Ion_auth::' . $method . '() called');
		}

		return call_user_func_array(array($this->ionAuthModel, $method), $arguments);
	}


	/**
	 * forgotten password feature
	 *
	 * @return mixed  boolian / array
	 * @author Mathew
	 **/
	public function forgottenPassword($identity)    //changed $email to $identity
	{
		if ( $this->ionAuthModel->forgottenPassword($identity) )   //changed
		{
			// Get user information
			$user = $this->where($this->config['identity'], $identity)->users()->row();  //changed to get_user_by_identity from email

			if ($user) {
				$data = array(
					'identity'		          => $user->{$this->config['identity']},
					'forgotten_password_code' => $user->forgottenPasswordCode
				);

				if (!$this->config['useDefaultEmail']) {
					$this->setMessage('forgotPasswordSuccessful');
					return $data;
				}
				else {
					$message = $this->load->view($this->config['emailTemplates'].$this->config['emailForgotPassword'], $data, true);
					$this->email->clear();
					$this->email->from($this->config['adminEmail'], $this->config['siteTitle']);
					$this->email->to($user->email);
					$this->email->subject($this->config['siteTitle'] . ' - ' . $this->lang->line('emailForgottenPasswordSubject'));
					$this->email->message($message);

					if ($this->email->send()) {
						$this->setMessage('forgotPasswordSuccessful');
						return TRUE;
					}
					else {
						$this->setError('forgotPasswordUnsuccessful');
						return FALSE;
					}
				}
			}
			else {
				$this->setError('forgotPasswordUnsuccessful');
				return FALSE;
			}
		}
		else
		{
			$this->setError('forgotPasswordUnsuccessful');
			return FALSE;
		}
	}

	/**
	 * forgotten_password_complete
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function forgottenPasswordComplete($code)
	{
		$this->ionAuthModel->triggerEvents('prePasswordChange');

		$identity = $this->config['identity'];
		$profile  = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!$profile)
		{
			$this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
			$this->setError('passwordChangeUnsuccessful');
			return FALSE;
		}

		$newPassword = $this->ionAuthModel->forgottenPasswordComplete($code, $profile->salt);

		if ($newPassword) {
			$data = array(
				'identity'     => $profile->{$identity},
				'new_password' => $newPassword
			);

			if (!$this->config['useDefaultEmail']) {
				$this->setMessage('passwordChangeSuccessful');
				$this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeSuccessful'));
				return $data;
			}
			else {
				$message = $this->load->view($this->config['emailTemplates'].$this->config['emailForgotPasswordComplete'], $data, true);

				$this->email->clear();
				$this->email->from($this->config['adminEmail'], $this->config['siteTitle']);
				$this->email->to($profile->email);
				$this->email->subject($this->config['siteTitle'] . ' - ' . $this->lang->line('emailNewPasswordSubject'));
				$this->email->message($message);

				if ($this->email->send()) {
					$this->setMessage('passwordChangeSuccessful');
					$this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeSuccessful'));
					return TRUE;
				}
				else {
					$this->setError('passwordChangeUnsuccessful');
					$this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
					return FALSE;
				}

			}
		}

		$this->ionAuthModel->triggerEvents(array('postPasswordChange', 'passwordChangeUnsuccessful'));
		return FALSE;
	}

	/**
	 * forgotten_password_check
	 *
	 * @return void
	 * @author Michael
	 **/
	public function forgottenPasswordCheck($code)
	{
		$profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

		if (!is_object($profile)) {
			$this->setError('passwordChangeUnsuccessful');
			return FALSE;
		}
		else {
			if ($this->config['forgotPasswordExpiration'] > 0) {
				//Make sure it isn't expired
				$expiration = $this->config['forgotPasswordExpiration'];
				if (time() - $profile->forgotten_password_time > $expiration) {
					//it has expired
					$this->clearForgottenPasswordCode($code);
					$this->setError('passwordChangeUnsuccessful');
					return FALSE;
				}
			}

			return $profile;
		}
	}

	/**
	 * register
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function register($username, $password, $email, $additionalData = array(), $groupIds = array()) //need to test email activation
	{
		$this->ionAuthModel->triggerEvents('preAccountCreation');

		$emailActivation = $this->config['emailActivation'];

		if (!$emailActivation) {
			$id = $this->ionAuthModel->register($username, $password, $email, $additionalData, $groupIds);
			if ($id !== FALSE) {
				$this->setMessage('accountCreationSuccessful');
				$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationSuccessful'));
				return $id;
			}
			else {
				$this->setError('accountCreationUnsuccessful');
				$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
				return FALSE;
			}
		}
		else {
			$id = $this->ionAuthModel->register($username, $password, $email, $additionalData, $groupIds);

			if (!$id) {
				$this->setError('accountCreationUnsuccessful');
				return FALSE;
			}

			$deactivate = $this->ionAuthModel->deactivate($id);

			if (!$deactivate) {
				$this->setError('deactivateUnsuccessful');
				$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationUnsuccessful'));
				return FALSE;
			}

			$activationCode = $this->ionAuthModel->activation_code;
			$identity        = $this->config['identity'];
			$user            = $this->ionAuthModel->user($id)->row();

			$data = array(
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'activation' => $activationCode,
			);

			if(!$this->config['useDefaultEmail']) {
				$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful'));
				$this->setMessage('activationEmailSuccessful');
					return $data;
			}
			else {
				$message = $this->load->view($this->config['emailTemplates'].$this->config['emailActivate'], $data, true);

				$this->email->clear();
				$this->email->from($this->config['adminEmail'], $this->config['siteTitle']);
				$this->email->to($email);
				$this->email->subject($this->config['siteTitle'] . ' - ' . $this->lang->line('emailActivationSubject'));
				$this->email->message($message);

				if ($this->email->send() == TRUE) {
					$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationSuccessful', 'activationEmailSuccessful'));
					$this->setMessage('activationEmailSuccessful');
					return $id;
				}
			}

			$this->ionAuthModel->triggerEvents(array('postAccountCreation', 'postAccountCreationUnsuccessful', 'activationEmailUnsuccessful'));
			$this->setError('activationEmailUnsuccessful');
			return FALSE;
		}
	}

	/**
	 * logout
	 *
	 * @return void
	 * @author Mathew
	 **/
	public function logout()
	{
		$this->ionAuthModel->triggerEvents('logout');

		$identity = $this->config['identity'];
        $this->session->unset_userdata(array(
        	$identity => '',
        	'id'      => '',
        	'user_id' => ''
        ));

		//delete the remember me cookies if they exist
		if ($this->ionAuthModel->getCookie('identity')) {
			$this->ionAuthModel->deleteCookie('identity');
		}

		if ($this->ionAuthModel->getCookie('remember_code')) {
			$this->ionAuthModel->deleteCookie('remember_code');
		}

		//Destroy the session
		$this->session->sess_destroy();

		$this->setMessage('logoutSuccessful');

		return TRUE;
	}

	/**
	 * logged_in
	 *
	 * @return bool
	 * @author Mathew
	 **/
	public function loggedIn()
	{
		$this->ionAuthModel->triggerEvents('loggedIn');

		return (bool) isset($_SESSION['identity']) ? TRUE : FALSE;
	}

	/**
	 * logged in
	 *
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
	 *
	 * @return bool
	 * @author Ben Edmunds
	 **/
	public function isAdmin($id=FALSE)
	{
		$this->ionAuthModel->triggerEvents('isAdmin');

		$adminGroup = $this->config['adminGroup'];

		return $this->inGroup($adminGroup, $id);
	}

	/**
	 * in group
	 *
	 * @param mixed group(s) to check
	 * @param bool user id
	 * @param bool check if all groups is present, or any of the groups
	 *
	 * @return bool
	 * @author Phil Sturgeon
	 **/
	public function inGroup($checkGroup, $id=FALSE, $checkAll = FALSE)
	{
		$this->ionAuthModel->triggerEvents('inGroup');

		$id || $id = $_SESSION['userId'];

		if (!is_array($checkGroup)) {
			$checkGroup = array($checkGroup);
		}

		if (isset($this->_cacheUserInGroup[$id])) {
			$groups_array = $this->_cacheUserInGroup[$id];
		}
		else {
			$usersGroups = $this->ionAuthModel->getUsersGroups($id)->result();
			$groupsArray = array();
			foreach ($usersGroups as $group) {
				$groupsArray[$group->id] = $group->name;
			}
			$this->_cacheUserInGroup[$id] = $groupsArray;
		}

		foreach ($checkGroup as $key => $value)
		{
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



}