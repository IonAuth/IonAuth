<?php

/**
* ----------------------------------------------------
* Info:
* ----------------------------------------------------
* @author Tim Joosten
* @package Ion Auth 3
*
* Description, The Turkish language file for Ion Auth 3
* ----------------------------------------------------
*/

return array(

  // Account creation
  'accountCreationSuccesful'           => 'Üyelik Kaydınız Başarıyla Tamamlandı',
  'accountCreationUnsuccesful'         => 'Üyelik Kaydınız Yapılamadı',
  'accountCreationDuplicateEmail'      => 'Eposta Adresi Geçersiz ya da Daha Önceden Alınmış',
  'accountCreationDuplicateUsername'   => 'Kullanıcı Adı Geçersiz ya da Daha Önceden Alınmış',
  'accountCreationMissingDefaultGroup' => 'Default group is not set',
  'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

  // Password
  'passwordChangeSuccessful'           => 'Şifreniz Değiştirildi',
  'passwordChangeUnsuccessful'         => 'Şifreniz Değiştirile Başarısız',
  'forgotPasswordSuccessful'           => 'Yeni Şifreniz Eposta Adresinize Gönderildi',
  'forgotPasswordUnsuccessful'         => 'Şifreniz Değiştirileme Başarısız',

  // Activation
  'activateSuccessful'                 => 'Hesap Başarıyla Etkinleştirildi',
  'activateUnsuccessful'               => 'Hesap Etkinleştirme Başarısız',
  'deactivateSuccessful'               => 'Hesap Devre Dışı Bırakıldı',
  'deactivateUnsuccessful'             => 'Hesap Devre Dışı Bırakılama Başarısız',
  'activationEmailSuccessful'          => 'Etkinleştirme Epostası Gönderildi',
  'activationEmailUnsuccessful'        => 'Etkinleştirme Epostası Gönderme Başarısız',

  // Login / Logout
  'loginSuccessful'                    => 'Giriş Başarılı',
  'loginUnsuccessful'                  => 'Giriş Başarısız',
  'loginUnsuccessfulNotActive'         => 'Giriş Başarısız ,Hesabınız Etkin Değil',
  'loginTimeout'                       => 'Temporarily locked out. Try again later',
  'logoutSuccessful'                   => 'Çıkış Başarılı',

  // Account changes
  'updateSuccessful'                   => 'Üyelik Bilgileri Güncellendi',
  'updateUnsuccessful'                 => 'Üyelik Bilgileri Güncelleme Başarısız',
  'deleteSuccessful'                   => 'Kullanıcı Silindi',
  'deleteUnsuccessful'                 => 'Kullanıcı Silme Başarısız',

  // Groups
  'groupCreationSuccessful'            => 'Group created successfully',
  'groupAlreadyExists'                 => 'Group name already taken',
  'groupUpdateSuccessful'              => 'Group details updated',
  'groupDeleteSuccessful'              => 'Group deleted',
  'groupDeleteUnsccessful'             => 'Unable to delete group',
  'groupNameRequired'                  => 'Group name is a required field',

  // Activation Email
  'emailActivationSubject'             => 'Üyelik Etkinleştirme',
  'emailActivateHeading'               => 'Activate account for %s',
  'emailActivateSubheading'            => 'Please click this link to %s.',
  'emailActivateLink'                  => 'Activate your account',

  // Forgot Password Email
  'emailForgottenPasswordSubject'      => 'Şifremi Unuttum',
  'emailForgotPasswordHeading'         => 'Reset password for, %s',
  'emailForgotPasswordSubheading'      => 'Please click this link to %s',
  'emailForgotPasswordLink'            => 'Reset tour password',

  // New Password Email
  'emailNewPasswordSubject'            => 'Yeni Şifre',
  'emailNewPasswordHeading'            => 'New password for %s',
  'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

  );
