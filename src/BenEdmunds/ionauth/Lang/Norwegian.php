<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The norwegain language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Konto opprettet',
     'accountCreationUnsuccesful'         => 'Klarte ikke å opprette konto',
     'accountCreationDuplicateEmail'      => 'Emailen er allerede i bruk eller ugyldig',
     'accountCreationDuplicateUsername'   => 'Brukernavnet er allerede i bruk eller ugyldig',
     'accountCreationMissingDefaultGroup' => 'Standardgruppe er ikke valgt',
     'accountCreationInvalidDefaultGroup' => 'Ugyldig gruppenavn',

     // Password
     'passwordChangeSuccessful'           => 'Passordet har blitt endret',
     'passwordChangeUnsuccessful'         => 'Klarte ikke å endre passord',
     'forgotPasswordSuccessful'           => 'Email for tilbakestilling av passord har blitt sendt',
     'forgotPasswordUnsuccessful'         => 'Klarte ikke å tilbakestille passord',

     // Activation
     'activateSuccessful'                 => 'Kontoen har blitt aktivert',
     'activateUnsuccessful'               => 'Klarte ikke å aktivere konto',
     'deactivateSuccessful'               => 'Kontoen har blitt deaktivert',
     'deactivateUnsuccessful'             => 'Klarte ikke å deaktivere konto',
     'activationEmailSuccessful'          => 'Email for aktivering av konto har blitt sendt',
     'activationEmailUnsuccessful'        => 'Klarte ikke å sende email for aktivering av konto',

     // Login / Logout
     'loginSuccessful'                    => 'Logget inn',
     'loginUnsuccessful'                  => 'Feil email/brukernavn eller passord',
     'loginUnsuccessfulNotActive'         => 'Kontoen er inaktiv',
     'loginTimeout'                       => 'Midlertidig sperret. Logg inn senere.',
     'logoutSuccessful'                   => 'Logget ut',

     // Account changes
     'updateSuccessful'                   => 'Kontoinformasjon oppdatert',
     'updateUnsuccessful'                 => 'Klarte ikke å oppdatere kontoinformasjon',
     'deleteSuccessful'                   => 'Konto slettet',
     'deleteUnsuccessful'                 => 'Klarte ikke å slette konto',

     // Groups
     'groupCreationSuccessful'            => 'Gruppe opprettet',
     'groupAlreadyExists'                 => 'Gruppenavnet finnes allerede',
     'groupUpdateSuccessful'              => 'Gruppeinformasjon oppdatert',
     'groupDeleteSuccessful'              => 'Gruppe slettet',
     'groupDeleteUnsccessful'             => 'Klarte ikke å slette gruppe',
     'groupNameRequired'                  => 'Gruppenavn må fylles inn',

     // Activation Email
     'emailActivationSubject'             => 'Aktivering av konto',
     'emailActivateHeading'               => 'Aktivér konto for %s',
     'emailActivateSubheading'            => 'Klikk på denne linken for å %s.',
     'emailActivateLink'                  => 'Aktivér konto',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Glemt passord: bekreftelse',
     'emailForgotPasswordHeading'         => 'Tilbakestill passord for %s',
     'emailForgotPasswordSubheading'      => 'Klikk på denne linken for å %s.',
     'emailForgotPasswordLink'            => 'Tilbakestill passord',

     // New Password Email
     'emailNewPasswordSubject'            => 'New password',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
