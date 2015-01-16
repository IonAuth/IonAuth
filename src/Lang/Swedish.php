<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The Swedish language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Kontot har nu skapats',
     'accountCreationUnsuccesful'         => 'Det gick inte att skapa kontot',
     'accountCreationDuplicateEmail'      => 'E-postadressen är ogiltig eller används redan',
     'accountCreationDuplicateUsername'   => 'Användarnamnet är ogiltigt eller används redan',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Lösenordet har nu ändrats',
     'passwordChangeUnsuccessful'         => 'Det gick inte att ändra lösenordet',
     'forgotPasswordSuccessful'           => 'E-postadressen för återställning av lösenord har nu skickats',
     'forgotPasswordUnsuccessful'         => 'Det gick inte att återställa lösenordet',

     // Activation
     'activateSuccessful'                 => 'Kontot aktiverades',
     'activateUnsuccessful'               => 'Det gick inte att aktivera kontot',
     'deactivateSuccessful'               => 'Kontot inaktiverades',
     'deactivateUnsuccessful'             => 'Det gick inte att inaktivera kontot',
     'activationEmailSuccessful'          => 'En aktveringslänk har skickats till din e-post',
     'activationEmailUnsuccessful'        => 'E-post med aktiveringslänk kunde inte skickas',

     // Login / Logout
     'loginSuccessful'                    => 'Du är nu inloggad',
     'loginUnsuccessful'                  => 'Inloggningen misslyckades',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Du är nu utloggad',

     // Account changes
     'updateSuccessful'                   => 'Kontouppgifterna uppdaterades',
     'updateUnsuccessful'                 => 'Det gick inte att uppdatera kontouppgifterna',
     'deleteSuccessful'                   => 'Användaren är borttagen',
     'deleteUnsuccessful'                 => 'Det gick inte att ta bort användaren',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Kontoaktivering',
     'emailActivateHeading'               => 'Kontoaktivering för %s',
     'emailActivateSubheading'            => 'Klicka denna länk för att %s.',
     'emailActivateLink'                  => 'aktivera ditt konto',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Glömt lösenordsverifikation',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nytt lösenord',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
