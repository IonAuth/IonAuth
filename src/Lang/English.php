<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The english language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Account successfully created.',
     'accountCreationUnsuccesful'         => 'Unable to create account',
     'accountCreationDuplicateEmail'      => 'Email already used of invalid',
     'accountCreationDuplicateUsername'   => 'Username already used or invalid',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Password successfully changed',
     'passwordChangeUnsuccessful'         => 'Unable to change password',
     'forgotPasswordSuccessful'           => 'Password reset email sent',
     'forgotPasswordUnsuccessful'         => 'Unable to reset password',

     // Activation
     'activateSuccessful'                 => 'Account activated',
     'activateUnsuccessful'               => 'Unable to activate account',
     'deactivateSuccessful'               => 'Account de-activated',
     'deactivateUnsuccessful'             => 'Unable to de-activate account',
     'activationEmailSuccessful'          => 'Activation email sent',
     'activationEmailUnsuccessful'        => 'Unable to send activation email',

     // Login / Logout
     'loginSuccessful'                    => 'Logged in successfully',
     'loginUnsuccessful'                  => 'Incorrect login',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Logged out successfully',

     // Account changes
     'updateSuccessful'                   => 'Account information successfully updated',
     'updateUnsuccessful'                 => 'Unable to update account information',
     'deleteSuccessful'                   => 'User deleted',
     'deleteUnsuccessful'                 => 'Unable to delete user',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Account activation',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Forgotten password verification',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'New password',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
