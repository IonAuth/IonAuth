<?php

/**
* ----------------------------------------------------
* Info:
* ----------------------------------------------------
* @author Tim Joosten
* @package Ion Auth 3
*
* Description, The estonian language file for Ion Auth 3
* ----------------------------------------------------
*/

return array(

  // Account creation
  'accountCreationSuccesful'           => 'Konto on loodud',
  'accountCreationUnsuccesful'         => 'Konto loomine ebaõnnestus',
  'accountCreationDuplicateEmail'      => 'E-posti aadress on juba kasutusel või vigane.',
  'accountCreationDuplicateUsername'   => 'Kasutajanimi on juba kasutusel või vigane.',
  'accountCreationMissingDefaultGroup' => 'Default group is not set',
  'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

  // Password
  'passwordChangeSuccessful'           => 'Salasõna on muudetud.',
  'passwordChangeUnsuccessful'         => 'Salasõna muutmine ebaõnnestus.',
  'forgotPasswordSuccessful'           => 'Sinu e-postile saadeti kiri edasise juhendiga.',
  'forgotPasswordUnsuccessful'         => 'Salasõna muutmine ebaõnnestus.',

  // Activation
  'activateSuccessful'                 => 'Konto on aktiveeritud',
  'activateUnsuccessful'               => 'Konto aktiveerimine ebaõnnestus.',
  'deactivateSuccessful'               => 'Konto on taas aktiivne',
  'deactivateUnsuccessful'             => 'Konto aktiveerimine ebaõnnestus.',
  'activationEmailSuccessful'          => 'Sinu e-postile saadeti kiri edasise juhendiga.',
  'activationEmailUnsuccessful'        => 'Aktiveerimiskirja saatmine ebaõnnestus.',

  // Login / Logout
  'loginSuccessful'                    => 'Oled sisse logitud',
  'loginUnsuccessful'                  => 'Sisenemine ebaõnnestus.',
  'loginUnsuccessfulNotActive'         => 'Account is inactive',
  'loginTimeout'                       => 'Temporarily locked out. Try again later',
  'logoutSuccessful'                   => 'Oled välja logitud',

  // Account changes
  'updateSuccessful'                   => 'Sinu andmed on muudetud',
  'updateUnsuccessful'                 => 'Andmete muutmine ebaõnnestus.',
  'deleteSuccessful'                   => 'Kasutaja on eemaldatud',
  'deleteUnsuccessful'                 => 'Kasutajat eemaldamine ebaõnnestus.',

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
