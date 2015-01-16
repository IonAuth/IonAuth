<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The lithuanian language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Vartotojas sėkmingai sukurtas',
     'accountCreationUnsuccesful'         => 'Neįmanoma sukurti vartotojo',
     'accountCreationDuplicateEmail'      => 'El, pašto adresas jau yra arba neteisingas',
     'accountCreationDuplicateUsername'   => 'Prisijungimo vardas jau yra arba nekorektiškas',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Slaptažodis sukurtas',
     'passwordChangeUnsuccessful'         => 'Negalima paeisti slaptažodžio',
     'forgotPasswordSuccessful'           => 'Slaptažodis keičiamas. Instrukcijos išsiųstos paštu.',
     'forgotPasswordUnsuccessful'         => 'Neįmanoma pakeisti slaptažodžio',

     // Activation
     'activateSuccessful'                 => 'Vartotojas aktyvuotas',
     'activateUnsuccessful'               => 'Nepavyko aktyvuoti',
     'deactivateSuccessful'               => 'Deaktyvuota',
     'deactivateUnsuccessful'             => 'Išsiųstas pranešimas į el. paštą',
     'activationEmailSuccessful'          => 'Activation email sent',
     'activationEmailUnsuccessful'        => 'Neįmanoma išsiųsti',

     // Login / Logout
     'loginSuccessful'                    => 'Sėkminga autorizacija',
     'loginUnsuccessful'                  => 'Klaidingas prisijungimas',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Atsijungta sėkminga',

     // Account changes
     'updateSuccessful'                   => 'Vartotojo duomenys sėkmingai pakeisti',
     'updateUnsuccessful'                 => 'Neįmanoma pakeisti vartotojo duoemnų',
     'deleteSuccessful'                   => 'Vartotojas pašalintas',
     'deleteUnsuccessful'                 => 'Neįmanoma pašalinti vartotojo',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Paskyros aktyvavimas',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Pamiršto slaptažodžio patvirtinimas',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Naujas slaptažodis',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
