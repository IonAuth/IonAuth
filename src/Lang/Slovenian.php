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
     'accountCreationSuccesful'           => 'Račun je bil uspešno ustvarjen',
     'accountCreationUnsuccesful'         => 'Ni mogoče ustvariti računa',
     'accountCreationDuplicateEmail'      => 'Elektronski naslov je neveljaven ali pa že obstaja',
     'accountCreationDuplicateUsername'   => 'Uporabniško ime je neveljavno ali pa že obstaja',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Geslo je bilo uspešno spremenjeno',
     'passwordChangeUnsuccessful'         => 'Ni mogoče spremeniti gesla',
     'forgotPasswordSuccessful'           => 'Zahteva za ponastavitev gesla je bila uspešno poslana',
     'forgotPasswordUnsuccessful'         => 'Gesla ni mogoče ponastaviti',

     // Activation
     'activateSuccessful'                 => 'Račun aktiviran',
     'activateUnsuccessful'               => 'Ni mogoče aktivirati računa',
     'deactivateSuccessful'               => 'Račun deaktiviran',
     'deactivateUnsuccessful'             => 'Ni mogoče deaktivirati računa',
     'activationEmailSuccessful'          => 'Aktivacijska pošta uspešno poslana',
     'activationEmailUnsuccessful'        => 'Aktivacijske pošte ni možno poslati',

     // Login / Logout
     'loginSuccessful'                    => 'Uspešna prijava',
     'loginUnsuccessful'                  => 'Neuspešna prijava',
     'loginUnsuccessfulNotActive'         => 'Račun je neaktiven',
     'loginTimeout'                       => 'Začasno zaklenjen. Poskusite ponovno pozneje.',
     'logoutSuccessful'                   => 'Uspešna odjava',

     // Account changes
     'updateSuccessful'                   => 'Informacije računa so bile uspešno posodobljene',
     'updateUnsuccessful'                 => 'Informacije računa ni možno posodobljene',
     'deleteSuccessful'                   => 'Uporabnik izbrisan',
     'deleteUnsuccessful'                 => 'Ni možno izbrisati uporabnika',

     // Groups
     'groupCreationSuccessful'            => 'Skupina je bila uspešno ustvarjena',
     'groupAlreadyExists'                 => 'Ime skupine že obstaja',
     'groupUpdateSuccessful'              => 'Podatki o skupini so bili uspešno posodobljeni',
     'groupDeleteSuccessful'              => 'Skupina izbrisana',
     'groupDeleteUnsccessful'             => 'Ni možno izbrisati skupine',
     'groupNameRequired'                  => 'Ime skupine je obvezno polje',

     // Activation Email
     'emailActivationSubject'             => 'Aktivacija računa',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Pozabljeno geslo',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Novo geslo',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
