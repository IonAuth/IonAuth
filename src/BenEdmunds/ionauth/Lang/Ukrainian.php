<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The ukrainian language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Обліковий запис успішно створено',
     'accountCreationUnsuccesful'         => 'Неможливо створити обліковий запис',
     'accountCreationDuplicateEmail'      => 'Електронна пошта використовується або некоректна',
     'accountCreationDuplicateUsername'   => 'Ім`я користувача існує або некоректне',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Пароль успішно змінено',
     'passwordChangeUnsuccessful'         => 'Пароль неможливо змінити',
     'forgotPasswordSuccessful'           => 'Пароль скинутий. На електронну пошту відправлено повідомлення',
     'forgotPasswordUnsuccessful'         => 'Неможливе скидання пароля',

     // Activation
     'activateSuccessful'                 => 'Обліковий запис активовано',
     'activateUnsuccessful'               => 'Не вдалося активувати обліковий запис',
     'deactivateSuccessful'               => 'Обліковий запис деактивовано',
     'deactivateUnsuccessful'             => 'Неможливо деактивувати обліковий запис',
     'activationEmailSuccessful'          => 'Повідомлення про активацію відправлено',
     'activationEmailUnsuccessful'        => 'Повідомлення про активацію неможливо відправити',

     // Login / Logout
     'loginSuccessful'                    => 'Авторизація пройшла успішно',
     'loginUnsuccessful'                  => 'Логін невірний',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Вихід успішний',

     // Account changes
     'updateSuccessful'                   => 'Обліковий запис успішно оновлено',
     'updateUnsuccessful'                 => 'Неможливо оновити обліковий запис',
     'deleteSuccessful'                   => 'Обліковий запис видалено',
     'deleteUnsuccessful'                 => 'Неможливо видалити обліковий запис',

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
