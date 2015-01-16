<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The Arabic language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'تم انشاء حسابك بنجاح',
     'accountCreationUnsuccesful'         => 'حدث خطأ اثناء انشاء حسابك لدينا',
     'accountCreationDuplicateEmail'      => 'هذا البريد الإلكترونى تم استخدامه من قبل او غير صحيح',
     'accountCreationDuplicateUsername'   => 'اسم المستخدم تم التسجيل به من قبل او غير صحيح',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'تم تغيير كلمة السر',
     'passwordChangeUnsuccessful'         => 'لا يمكن تغيير كلمة السر',
     'forgotPasswordSuccessful'           => 'تم ارسال بريد لإستعادة كلمة السر',
     'forgotPasswordUnsuccessful'         => 'لا يمكن استعادة كلمة السر',

     // Activation
     'activateSuccessful'                 => 'تم تفعيل حسابك',
     'activateUnsuccessful'               => 'لا يمكن تفعيل حسابك',
     'deactivateSuccessful'               => 'تم إيقاف حسابك',
     'deactivateUnsuccessful'             => 'لا يمكن إيقاف حسابك',
     'activationEmailSuccessful'          => 'تم إرسال بريد التفعيل',
     'activationEmailUnsuccessful'        => 'لا يمكن ارسال بريد التفعيل',

     // Login / Logout
     'loginSuccessful'                    => 'تم تسجيل الدخول بنجاح',
     'loginUnsuccessful'                  => 'معلومات الدخول غير صحيحة',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'تم تسجيل خروجك',

     // Account changes
     'updateSuccessful'                   => 'تم تعديل معلومات حسابك',
     'updateUnsuccessful'                 => 'لا يمكن تعديل معلومات الحساب',
     'deleteSuccessful'                   => 'تم إلغاء المستخدم',
     'deleteUnsuccessful'                 => 'لا يمكن إلغاء المستخدم',

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
