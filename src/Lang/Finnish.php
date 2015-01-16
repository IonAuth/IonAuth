<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The finnish language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Tili luotiin onnistuneesti!',
     'accountCreationUnsuccesful'         => 'Tilin luonti epäonnistui',
     'accountCreationDuplicateEmail'      => 'Sähköpostiosoite on virheellinen tai se on jo käytössä',
     'accountCreationDuplicateUsername'   => 'Tunnus on virheellinen tai se on jo käytössä',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Salasana vaihdettu!',
     'passwordChangeUnsuccessful'         => 'Salasanan vaihto epäonnistui',
     'forgotPasswordSuccessful'           => 'Salasanan resetointiohjeet lähetettiin sähköpostiin',
     'forgotPasswordUnsuccessful'         => 'Salasanan resetointi epäonnistui',

     // Activation
     'activateSuccessful'                 => 'Tili aktivoitu!',
     'activateUnsuccessful'               => 'Tilin aktivointi epäonnistui',
     'deactivateSuccessful'               => 'Tili suljettu',
     'deactivateUnsuccessful'             => 'Tilin sulkeminen epäonnistui',
     'activationEmailSuccessful'          => 'Aktivointiviesti lähetetty',
     'activationEmailUnsuccessful'        => 'Aktivointiviestiä ei voitu lähettää',

     // Login / Logout
     'loginSuccessful'                    => 'Olet nyt kirjautunut sisään!',
     'loginUnsuccessful'                  => 'Kirjautuminen epäonnistui',
     'loginUnsuccessfulNotActive'         => 'Tiliä ei aktivoitu',
     'loginTimeout'                       => 'Väliaikaisesti suljettu. Yritä uudelleen myöhemmin.',
     'logoutSuccessful'                   => 'Olet nyt kirjautunut ulos',

     // Account changes
     'updateSuccessful'                   => 'Tilin tiedot päivitetty!',
     'updateUnsuccessful'                 => 'Tietojen päivitys epäonnistui',
     'deleteSuccessful'                   => 'Tili poistettu',
     'deleteUnsuccessful'                 => 'Tilin poisto epäonnistui',

     // Groups
     'groupCreationSuccessful'            => 'Ryhmä luotiin onnistuneesti!',
     'groupAlreadyExists'                 => 'Ryhmän nimi jo käytössä',
     'groupUpdateSuccessful'              => 'Ryhmän tiedot päivitetty!',
     'groupDeleteSuccessful'              => 'Ryhmä poistettu',
     'groupDeleteUnsccessful'             => 'Ryhmän poisto epäonnistui',
     'groupNameRequired'                  => 'Ryhmän nimi tarvitaan',

     // Activation Email
     'emailActivationSubject'             => 'Tilin aktivointi',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Unohtuneen salasanan palautus',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Uusi salasana',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
