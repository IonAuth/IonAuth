<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The czech language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Účet byl úspěšně vytvořen',
     'accountCreationUnsuccesful'         => 'Nelze vytvořit účet',
     'accountCreationDuplicateEmail'      => 'E-mail již existuje nebo je neplatný',
     'accountCreationDuplicateUsername'   => 'Uživatelské jméno již existuje nebo je neplatný',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Heslo bylo úspěšně změněno',
     'passwordChangeUnsuccessful'         => 'Nelze změnit heslo',
     'forgotPasswordSuccessful'           => 'Heslo bylo odeslané na e-mail',
     'forgotPasswordUnsuccessful'         => 'Nelze obnovit heslo',

     // Activation
     'activateSuccessful'                 => 'Účet byl aktivován',
     'activateUnsuccessful'               => 'Nelze aktivovat účet',
     'deactivateSuccessful'               => 'Účet byl deaktivován',
     'deactivateUnsuccessful'             => 'Nelze deaktivován účet',
     'activationEmailSuccessful'          => 'Aktivační e-mail byl odeslán',
     'activationEmailUnsuccessful'        => 'Nelze odeslat aktivační e-mail',

     // Login / Logout
     'loginSuccessful'                    => 'Úspěšně přihlášen',
     'loginUnsuccessful'                  => 'Nesprávný e-mail nebo heslo',
     'loginUnsuccessfulNotActive'         => 'Účet je neaktivní',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Úspěšné odhlášení',

     // Account changes
     'updateSuccessful'                   => 'Informace o účtu byla úspěšně aktualizována',
     'updateUnsuccessful'                 => 'Nelze aktualizovat informace o účtu',
     'deleteSuccessful'                   => 'Uživatel byl smazán',
     'deleteUnsuccessful'                 => 'Nelze smazat uživatele',

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
