<?php
return array(

	/*
	| ----------
	| Database connection settings
	|
	|
	*/
	'database' => array(
	    'driver'    => 'mysql',
	    'host'      => 'localhost',
	    'database'  => 'ci_template',
	    'username'  => 'root',
	    'password'  => 'root',
	    'charset'   => 'utf8',
	    'collation' => 'utf8_unicode_ci',
	    'prefix'    => '',
	    'fetch'     => PDO::FETCH_CLASS,
	),


	/*
	| -------------------------------------------------------------------------
	| Tables.
	| -------------------------------------------------------------------------
	| Database table names.
	*/
	'tables' => array(
		'users'           => 'users',
		'groups'          => 'groups',
		'users_groups'    => 'users_groups',
		'login_attempts'  => 'login_attempts',
	),

	/*
	 | Users table column and Group table column you want to join WITH.
	 |
	 | Joins from users.id
	 | Joins from groups.id
	 */
	'join' => array(
		'users'  => 'user_id',
		'groups' => 'group_id',
	),

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
	'hashMethod'    => 'bcrypt',  // IMPORTANT: Make sure this is set to either sha1 or bcrypt (preferably bcrypt)
	'defaultRounds' => 8,         // This does not apply if random_rounds is set to true
	'randomRounds'  => false,
	'minRounds'     => 5,
	'maxRounds'     => 9,

	/*
	 | -------------------------------------------------------------------------
	 | Authentication options.
	 | -------------------------------------------------------------------------
	 | maximum_login_attempts: This maximum is not enforced by the library, but is
	 | used by $this->ion_auth->is_max_login_attempts_exceeded().
	 | The controller should check this function and act
	 | appropriately. If this variable set to 0, there is no maximum.
	 */
	'siteTitle'                => "Example.com",       // Site Title, example.com
	'adminEmail'               => "admin@example.com", // Admin Email, admin@example.com
	'defaultGroup'             => 'members',           // Default group, use name
	'adminGroup'               => 'admin',             // Default administrators group, use name
	'identity'                 => 'email',             // A database column which is used to login with
	'minPasswordLength'        => 8,                   // Minimum Required Length of Password
	'maxPasswordLength'        => 20,                  // Maximum Allowed Length of Password
	'emailActivation'          => false,               // Email Activation for registration
	'manualActivation'         => false,               // Manual Activation for registration
	'rememberUsers'            => true,                // Allow users to be remembered and enable auto-login
	'userExpire'               => 86500,               // How long to remember the user (seconds). Set to zero for no expiration
	'userExtendOnLogin'        => false,               // Extend the users cookies everytime they auto-login
	'trackLoginAttempts'       => false,               // Track the number of failed login attempts for each user or ip.
	'maximumLoginAttempts'     => 3,                   // The maximum number of failed login attempts.
	'lockoutTime'              => 600,                 // The number of seconds to lockout an account due to exceeded attempts
	'forgotPasswordExpiration' => 0,                   // The number of miliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.


	/*
	 | -------------------------------------------------------------------------
	 | Email options.
	 | -------------------------------------------------------------------------
	 | email_config:
	 | 	  'file' = Use the default CI config or use from a config file
	 | 	  array  = Manually set your email config settings
	 */
	'useDefaultEmail' => false, // Send Email using the builtin email functionality, if false it will return the code and the identity
	'emailConfig' => array(
		'mailtype' => 'html',
	),

	/*
	 | -------------------------------------------------------------------------
	 | Email templates.
	 | -------------------------------------------------------------------------
	 | Folder where email templates are stored.
	 | Default: auth/
	 */
	'emailTemplates' => 'auth/email/',

	/*
	 | -------------------------------------------------------------------------
	 | Activate Account Email Template
	 | -------------------------------------------------------------------------
	 | Default: activate.tpl.php
	 */
	'emailActivate' => 'activate.tpl.php',

	/*
	 | -------------------------------------------------------------------------
	 | Forgot Password Email Template
	 | -------------------------------------------------------------------------
	 | Default: forgotPassword.tpl.php
	 */
	'emailForgotPassword' => 'forgotPassword.tpl.php',

	/*
	 | -------------------------------------------------------------------------
	 | Forgot Password Complete Email Template
	 | -------------------------------------------------------------------------
	 | Default: newPassword.tpl.php
	 */
	'emailForgotPasswordComplete' => 'newPassword.tpl.php',

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
	'saltLength' => 10,
	'storeSalt'  => false,

	/*
	 | -------------------------------------------------------------------------
	 | Message Delimiters.
	 | -------------------------------------------------------------------------
	 */
	'messageStartDelimiter' => '<p>',   // Message start delimiter
	'messageEndDelimiter'   => '</p>',  // Message end delimiter
	'errorStartDelimiter'   => '<p>',   // Error mesage start delimiter
	'errorEndDelimiter'     => '</p>',  // Error mesage end delimiter

);