<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The thai language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'สร้างบัญชีสำเร็จ',
     'accountCreationUnsuccesful'         => 'ไม่สามารถสร้างบัญชีได้',
     'accountCreationDuplicateEmail'      => 'อีเมล์นี้ถูกใช้ไปแล้วหรือรูปแบบไม่ถูกต้อง',
     'accountCreationDuplicateUsername'   => 'ชื่อผู้ใช้นี้ถูกใช้ไปแล้วหรือรูปแบบไม่ถูกต้อง',
     'accountCreationMissingDefaultGroup' => 'กลุ่มปริยายยังไม่ถูกตั้ง',
     'accountCreationInvalidDefaultGroup' => 'ชื่อกลุ่มปริยายตั้งไม่ถูกต้อง',

     // Password
     'passwordChangeSuccessful'           => 'เปลี่ยนรหัสผ่านสำเร็จ',
     'passwordChangeUnsuccessful'         => 'ไม่สามารถเปลี่ยนรหัสผ่านได้',
     'forgotPasswordSuccessful'           => 'อีเมล์ล้างรหัสผ่านถูกส่งไปแล้ว',
     'forgotPasswordUnsuccessful'         => 'ไม่สามารถล้างรหัสผ่านได้',

     // Activation
     'activateSuccessful'                 => 'บัญชีเปิดใช้แล้ว',
     'activateUnsuccessful'               => 'ไม่สามารถเปิดใช้บัญชีได้',
     'deactivateSuccessful'               => 'บัญชีถูกปิดการใช้งานแล้ว',
     'deactivateUnsuccessful'             => 'ไม่สามารถปิดการใช้งานบัญชี',
     'activationEmailSuccessful'          => 'ส่งอีเมล์เปิดใช้งานแล้ว',
     'activationEmailUnsuccessful'        => 'ไม่สามารถส่งอีเมล์เปิดใช้งานรหัสผ่านได้',

     // Login / Logout
     'loginSuccessful'                    => 'เข้าสู่ระบบสำเร็จ',
     'loginUnsuccessful'                  => 'เข้าสู่ระบบไม่ถูกต้อง',
     'loginUnsuccessfulNotActive'         => 'บัญชีนี้ยังไม่เปิดใช้งาน',
     'loginTimeout'                       => 'การเข้าสู่ระบบถูกระงับชั่วคราว กรุณาลองใหม่ในภายหลัง.',
     'logoutSuccessful'                   => 'ออกจากระบบสำเร็จ',

     // Account changes
     'updateSuccessful'                   => 'แก้ไขข้อมูลบัญชีสำเร็จ',
     'updateUnsuccessful'                 => 'ไม่สามารถแก้ไขข้อมูลบัญชี',
     'deleteSuccessful'                   => 'ผู้ใช้ถูกลบแล้ว',
     'deleteUnsuccessful'                 => 'ไม่สามารถลบผู้ใช้ได้',

     // Groups
     'groupCreationSuccessful'            => 'สร้างกลุ่มสำเร็จ',
     'groupAlreadyExists'                 => 'ชื่อกลุ่มถูกใช้ไปแล้ว',
     'groupUpdateSuccessful'              => 'แก้ไขรายละเอียดกลุ่มแล้ว',
     'groupDeleteSuccessful'              => 'กลุ่มถูกลบแล้ว',
     'groupDeleteUnsccessful'             => 'ไม่สามารถลบกลุ่มได้',
     'groupNameRequired'                  => 'ต้องใส่ชื่อกลุ่ม',

     // Activation Email
     'emailActivationSubject'             => 'การเปิดใช้บัญชี',
     'emailActivateHeading'               => 'เปิดใช้บัญชี %s',
     'emailActivateSubheading'            => 'กรุณาคลิกลิงค์นี้เพื่อ%s',
     'emailActivateLink'                  => 'เปิดใช้Your บัญชี',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'การยืนยันลืมรหัสผ่าน',
     'emailForgotPasswordHeading'         => 'ล้างรหัสผ่านสำหรับ%s',
     'emailForgotPasswordSubheading'      => 'กรุณาคลิกลิงค์นี้เพื่อ%s',
     'emailForgotPasswordLink'            => 'ล้างรหัสผ่าน',

     // New Password Email
     'emailNewPasswordSubject'            => 'รหัสผ่านใหม่',
     'emailNewPasswordHeading'            => 'รหัสผ่านใหม่สำหรับ %s',
     'emailNewPasswordSubheading'         => 'รหัสผ่านใหม่ถูกตั้งใหม่เป็น: %s',

   );
