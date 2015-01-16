<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The slovak language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Účet bol úspešne vytvorený',
     'accountCreationUnsuccesful'         => 'Nie je možné vytvoriť účet',
     'accountCreationDuplicateEmail'      => 'E-mail už existuje alebo je neplatný',
     'accountCreationDuplicateUsername'   => 'Užívateľské meno už existuje alebo je neplatné',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Heslo bolo úspešne zmenené',
     'passwordChangeUnsuccessful'         => 'Nie je možné zmeniť heslo',
     'forgotPasswordSuccessful'           => 'Heslo bolo odoslané na e-mail',
     'forgotPasswordUnsuccessful'         => 'Nie je možné obnoviť heslo',

     // Activation
     'activateSuccessful'                 => 'Účet bol aktivovaný',
     'activateUnsuccessful'               => 'Nie je možné aktivovať účet',
     'deactivateSuccessful'               => 'Účet bol deaktivovaný',
     'deactivateUnsuccessful'             => 'Nie je možné deaktivovať účet',
     'activationEmailSuccessful'          => 'Aktivačný e-mail bol odoslaný',
     'activationEmailUnsuccessful'        => 'Nedá sa odoslať aktivačný e-mail',

     // Login / Logout
     'loginSuccessful'                    => 'Úspešne prihlásený',
     'loginUnsuccessful'                  => 'Nesprávny e-mail alebo heslo',
     'loginUnsuccessfulNotActive'         => 'Účet je neaktívny',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Úspešné odhlásenie',

     // Account changes
     'updateSuccessful'                   => 'Informácie o účte boli úspešne aktualizované',
     'updateUnsuccessful'                 => 'Informácie o účte sa nedájú aktualizovať',
     'deleteSuccessful'                   => 'Užívateľ bol zmazaný',
     'deleteUnsuccessful'                 => 'Užívateľ sa nedá zmazať',

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
