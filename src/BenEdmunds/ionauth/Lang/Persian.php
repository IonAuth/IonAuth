<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The persian language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'حساب کاربري با موفقیت ايجاد شد',
     'accountCreationUnsuccesful'         => 'ايجاد حساب کاربري با شكست مواجه شد',
     'accountCreationDuplicateEmail'      => 'ایمیل قبلا استفاده شده است',
     'accountCreationDuplicateUsername'   => 'نام کاربری قبلا استفاده شده است',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'رمز عبور عوض شد',
     'passwordChangeUnsuccessful'         => 'تعويض رمز عبور انجام نشد',
     'forgotPasswordSuccessful'           => 'ایمیل تعويض رمز عبور ارسال شد',
     'forgotPasswordUnsuccessful'         => 'امكان تعويض رمز عبور وجود ندارد',

     // Activation
     'activateSuccessful'                 => 'حساب کاربري فعال شد',
     'activateUnsuccessful'               => 'امكان فعال سازي حساب کاربري وجود ندارد',
     'deactivateSuccessful'               => 'حساب کاربري غيرفعال شد',
     'deactivateUnsuccessful'             => 'امكان غيرفعال كردن حساب کاربري وجود ندارد',
     'activationEmailSuccessful'          => 'ایمیل فعال سازی فرستاده شد',
     'activationEmailUnsuccessful'        => 'امكان ارسال ایمیل فعال سازی وجود ندارد',

     // Login / Logout
     'loginSuccessful'                    => 'ورود موفقیت آميز',
     'loginUnsuccessful'                  => 'ورود نا موفق',
     'loginUnsuccessfulNotActive'         => 'حساب کاربري غیر فعال است',
     'loginTimeout'                       => 'حساب کاربري موقتا قفل شده است، لطفا بعدا دوباره تلاش نماييد.',
     'logoutSuccessful'                   => 'خروج موفقیت آميز',

     // Account changes
     'updateSuccessful'                   => 'اطلاعات حساب کاربري به روز شد',
     'updateUnsuccessful'                 => 'اطلاعات حساب کاربري به روز نشد',
     'deleteSuccessful'                   => 'کاربر حذف شد',
     'deleteUnsuccessful'                 => 'امكان حذف کاربر وجود ندارد',

     // Groups
     'groupCreationSuccessful'            => 'گروه با موفقيت ايجاد شد',
     'groupAlreadyExists'                 => 'اين نام گروه قبلا استفاده شده است',
     'groupUpdateSuccessful'              => 'جزئيات گروه با موفقيت بروز رساني شد',
     'groupDeleteSuccessful'              => 'گروه حذف شد',
     'groupDeleteUnsccessful'             => 'امكان حذف گروه وجود ندارد',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'فعال سازی حساب کاربري',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'تایید رمز عبور جدید',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'رمز عبور جدید',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
