<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The german language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Das Benutzerkonto wurde erfolgreich erstellt',
     'accountCreationUnsuccesful'         => 'Das Benutzerkonto konnte nicht erstellt werden',
     'accountCreationDuplicateEmail'      => 'Die E-Mail-Adresse ist ungültig oder wird bereits verwendet',
     'accountCreationDuplicateUsername'   => 'Der Benutzername ist ungültig oder wird bereits verwendet',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Das Passwort wurde erfolgreich geändert',
     'passwordChangeUnsuccessful'         => 'Das Passwort konnte nicht geändert werden',
     'forgotPasswordSuccessful'           => 'Es wurde eine E-Mail zum Zurücksetzen des Passwortes versandt',
     'forgotPasswordUnsuccessful'         => 'Das Passwort konnte nicht zurückgesetzt werden',

     // Activation
     'activateSuccessful'                 => 'Das Benutzerkonto wurde aktiviert',
     'activateUnsuccessful'               => 'Das Benutzerkonto konnte nicht aktiviert werden',
     'deactivateSuccessful'               => 'Das Benutzerkonto wurde deaktiviert',
     'deactivateUnsuccessful'             => 'Das Benutzerkonto konnte nicht deaktiviert werden',
     'activationEmailSuccessful'          => 'Es wurde eine E-Mail zum Aktivieren des Benutzerkontos versandt',
     'activationEmailUnsuccessful'        => 'Die Aktivierungs-E-Mail konnte nicht versandt werden',

     // Login / Logout
     'loginSuccessful'                    => 'Login erfolgreich',
     'loginUnsuccessful'                  => 'Login fehlgeschlagen',
     'loginUnsuccessfulNotActive'         => 'Der Account ist deaktiviert',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Logout erfolgreich',

     // Account changes
     'updateSuccessful'                   => 'Die Konto-Informationen wurden erfolgreich geändert',
     'updateUnsuccessful'                 => 'Die Konto-Informationen konnten nicht geändert werden',
     'deleteSuccessful'                   => 'Das Benutzerkonto wurde gelöscht',
     'deleteUnsuccessful'                 => 'Das Benutzerkonto konnte nicht gelöscht werden',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Aktivierung des Kontos',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Vergessenes Kennwort Verifikation',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Neues Password',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
