<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The polish language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Konto zostało pomyślnie założone.',
     'accountCreationUnsuccesful'         => 'Nie można utworzyć konta',
     'accountCreationDuplicateEmail'      => 'Podany adres Email jest nieprawidłowy lub został już użyty',
     'accountCreationDuplicateUsername'   => 'Podana nazwa użytkownika jest nieprawidłowa lub została już użyta',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Hasło zostało pomyślnie zmienione',
     'passwordChangeUnsuccessful'         => 'Nie można zmienić hasła',
     'forgotPasswordSuccessful'           => 'Nowe hasło zostało wysłane',
     'forgotPasswordUnsuccessful'         => 'Nie można zresetować hasła',

     // Activation
     'activateSuccessful'                 => 'Konto zostało aktywowane',
     'activateUnsuccessful'               => 'Nie można aktywować konta',
     'deactivateSuccessful'               => 'Konto zostało deaktywowane',
     'deactivateUnsuccessful'             => 'Nie można deaktywować konta',
     'activationEmailSuccessful'          => 'Na twój adres E-mail został wysłany link aktywacyjny',
     'activationEmailUnsuccessful'        => 'Nie można wysłać linku aktywacyjnego',

     // Login / Logout
     'loginSuccessful'                    => 'Użytkownik został pomyślnie zalogowany',
     'loginUnsuccessful'                  => 'Nieprawidłowy login',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Użytkownik został pomyślnie wylogowany',

     // Account changes
     'updateSuccessful'                   => 'Konto zostało pomyślnie uaktualnione',
     'updateUnsuccessful'                 => 'Nie można uaktualnić konta',
     'deleteSuccessful'                   => 'Użytkownik został skasowany',
     'deleteUnsuccessful'                 => 'Nie można skasować użytkownika',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Aktywacja Konta',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Weryfikacja Zapomnianengo Hasła',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nowe Hasło',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
