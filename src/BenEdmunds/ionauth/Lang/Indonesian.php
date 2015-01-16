<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The indonesian language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Akun Berhasil Dibuat.',
     'accountCreationUnsuccesful'         => 'Tidak Dapat Membuat Akun',
     'accountCreationDuplicateEmail'      => 'Email Sudah Digunakan atau Tidak Valid',
     'accountCreationDuplicateUsername'   => 'Username Sudah Digunakan atau Tidak Valid',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Kata Sandi Berhasil Diubah',
     'passwordChangeUnsuccessful'         => 'Tidak Dapat Mengganti Kata Sandi',
     'forgotPasswordSuccessful'           => 'Email untuk Set Ulang Kata Sandi Telah Dikirim',
     'forgotPasswordUnsuccessful'         => 'Tidak Dapat Set Ulang Kata Sandi',

     // Activation
     'activateSuccessful'                 => 'Akun Telah Diaktifkan',
     'activateUnsuccessful'               => 'Tidak Dapat Mengaktifkan Akun',
     'deactivateSuccessful'               => 'Akun Telah Dinonaktifkan',
     'deactivateUnsuccessful'             => 'Tidak Dapat Menonaktifkan Akun',
     'activationEmailSuccessful'          => 'Email untuk Aktivasi Telah Dikirim',
     'activationEmailUnsuccessful'        => 'Tidak Dapat Mengirimkan Email Aktivasi',

     // Login / Logout
     'loginSuccessful'                    => 'Log In Berhasil',
     'loginUnsuccessful'                  => 'Log In Gagal',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Log Out Berhasil',

     // Account changes
     'updateSuccessful'                   => 'Informasi Akun Berhasil Diperbaharui',
     'updateUnsuccessful'                 => 'Tidak Dapat Memperbaharui Informasi Akun',
     'deleteSuccessful'                   => 'Pengguna Telah Dihapus',
     'deleteUnsuccessful'                 => 'Tidak Dapat Menghapus Pengguna',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Aktivasi Akun',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Lupa Verifikasi Password',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'New Password',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
