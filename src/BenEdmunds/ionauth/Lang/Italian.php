<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The italian language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Account creato con successo.',
     'accountCreationUnsuccesful'         => 'Impossibile creare l\'account.',
     'accountCreationDuplicateEmail'      => 'Email gi&agrave; in uso o non valida.',
     'accountCreationDuplicateUsername'   => 'Nome utente gi&agrave; in uso o non valido.',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Password modificata con successo.',
     'passwordChangeUnsuccessful'         => 'Impossibile modificare la password.',
     'forgotPasswordSuccessful'           => 'Email di reset della password inviata.',
     'forgotPasswordUnsuccessful'         => 'Impossibile resettare la password.',

     // Activation
     'activateSuccessful'                 => 'Account attivato.',
     'activateUnsuccessful'               => 'Impossibile attivare l\'account.',
     'deactivateSuccessful'               => 'Account disattivato.',
     'deactivateUnsuccessful'             => 'Impossibile disattivare l\'account.',
     'activationEmailSuccessful'          => 'Email di attivazione inviata.',
     'activationEmailUnsuccessful'        => 'Impossibile inviare l\'email di attivazione.',

     // Login / Logout
     'loginSuccessful'                    => 'Login effettuato con successo.',
     'loginUnsuccessful'                  => 'Login non corretto.',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Logout effettuato con successo.',

     // Account changes
     'updateSuccessful'                   => 'Informazioni dell\'account aggiornate con successo.',
     'updateUnsuccessful'                 => 'Impossibile aggiornare le informazioni dell\'account.',
     'deleteSuccessful'                   => 'Utente eliminato.',
     'deleteUnsuccessful'                 => 'Impossibile eliminare l\'utente.',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Attivazione Account',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Verifica il cambio password dimenticata',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nuova Password',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
