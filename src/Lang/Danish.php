<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The Danish language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Konto oprettet',
     'accountCreationUnsuccesful'         => 'Det var ikke muligt at oprette kontoen',
     'accountCreationDuplicateEmail'      => 'Email allerede i brug eller ugyldig',
     'accountCreationDuplicateUsername'   => 'Brugernavn allerede i brug eller ugyldigt',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Kodeordet er ændret',
     'passwordChangeUnsuccessful'         => 'Det var ikke muligt at ændre kodeordet',
     'forgotPasswordSuccessful'           => 'Email vedrørende nulstilling af kodeord er afsendt',
     'forgotPasswordUnsuccessful'         => 'Det var ikke muligt at nulstille kodeordet',

     // Activation
     'activateSuccessful'                 => 'Konto aktiveret',
     'activateUnsuccessful'               => 'Det var ikke muligt at aktivere kontoen',
     'deactivateSuccessful'               => 'Konto deaktiveret',
     'deactivateUnsuccessful'             => 'Det var ikke muligt at deaktivere kontoen',
     'activationEmailSuccessful'          => 'Email vedrørende aktivering af konto er afsendt',
     'activationEmailUnsuccessful'        => 'Det var ikke muligt at sende email vedrørende aktivering af konto',

     // Login / Logout
     'loginSuccessful'                    => 'Logged ind',
     'loginUnsuccessful'                  => 'Ugyldigt login',
     'loginUnsuccessfulNotActive'         => 'Kontoen er inaktiv',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Logged ud',

     // Account changes
     'updateSuccessful'                   => 'Kontoen er opdateret',
     'updateUnsuccessful'                 => 'Det var ikke muligt at opdatere kontoen',
     'deleteSuccessful'                   => 'Bruger slettet',
     'deleteUnsuccessful'                 => 'Det var ikke muligt at slette bruger',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Konto aktivering',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Verifikation af glemt adgangskode',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nyt kodeord',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
