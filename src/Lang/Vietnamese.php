<?php

/**
* ----------------------------------------------------
* Info:
* ----------------------------------------------------
* @author Trung Dinh Quang
* @package Ion Auth 3
*
* Description, The vietnamese language file for Ion Auth 3
* ----------------------------------------------------
*/

return array(

  // Account creation
  'accountCreationSuccesful'           => 'Đã khởi tạo tài khoản thành công',
  'accountCreationUnsuccesful'         => 'Không thể tạo tài khoản vào lúc này',
  'accountCreationDuplicateEmail'      => 'Địa chỉ email không hợp lệ hoặc đã được sử dụng',
  'accountCreationDuplicateUsername'   => 'Tên tài khoản không hợp lệ hoặc đã được sử dụng',
  'accountCreationMissingDefaultGroup' => 'Default group is not set',
  'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

  // Password
  'passwordChangeSuccessful'           => 'Đã thay đổi mật khẩu thành công',
  'passwordChangeUnsuccessful'         => 'Không thể thay đổi mật khẩu vào lúc này',
  'forgotPasswordSuccessful'           => 'Email khôi phục mật khẩu đã được gửi đi',
  'forgotPasswordUnsuccessful'         => 'Không thể khôi phục mật khẩu vào lúc này',

  // Activation
  'activateSuccessful'                 => 'Tài khoản đã được kích hoạt',
  'activateUnsuccessful'               => 'Không thể kích hoạt tài khoản vào lúc này',
  'deactivateSuccessful'               => 'Đã khoá tài khoản thành công',
  'deactivateUnsuccessful'             => 'Không thể bất khoá tài khoản vào lúc này',
  'activationEmailSuccessful'          => 'Đã gửi mail kích hoạt thành công',
  'activationEmailUnsuccessful'        => 'Không thể gửi mail kích hoạt vào lúc này',

  // Login / Logout
  'loginSuccessful'                    => 'Đăng nhập thành công',
  'loginUnsuccessful'                  => 'Tài khoản hoặc mật khẩu không đúng',
  'loginUnsuccessfulNotActive'         => 'Tài khoản này đã bị khoá',
  'loginTimeout'                       => 'Tài khoản này đã tạm thời bị khoá, vui lòng thử lại sau',
  'logoutSuccessful'                   => 'Đăng xuất thành công',

  // Account changes
  'updateSuccessful'                   => 'Thông tin tài khoản đã được thay đổi thành công',
  'updateUnsuccessful'                 => 'Không thể thay đổi thông tin tài khoản vào lúc này',
  'deleteSuccessful'                   => 'Đã xoá tài khoản',
  'deleteUnsuccessful'                 => 'Không thể xoá tài khoản vào lúc này',

  // Groups
  'groupCreationSuccessful'            => 'Đã tạo nhóm mới thành công',
  'groupAlreadyExists'                 => 'Tên nhóm bị trùng',
  'groupUpdateSuccessful'              => 'Đã cập nhật thông tin nhóm thành công',
  'groupDeleteSuccessful'              => 'Đã xoá nhóm',
  'groupDeleteUnsccessful'             => 'Không thể xoá nhóm vào lúc này',
  'groupNameRequired'                  => 'Vui lòng nhập tên nhóm',

  // Activation Email
  'emailActivationSubject'             => 'Kích hoạt tài khoản',
  'emailActivateHeading'               => 'Kích hoạt tài khoản của %s',
  'emailActivateSubheading'            => 'Vui lòng click vào link này để %s.',
  'emailActivateLink'                  => 'Kích hoạt tài khoản',

  // Forgot Password Email
  'emailForgottenPasswordSubject'      => 'Xác nhận quên mật khẩu',
  'emailForgotPasswordHeading'         => 'Khôi phục mật khẩu cho %s',
  'emailForgotPasswordSubheading'      => 'Vui lòng click vào link này để %s.',
  'emailForgotPasswordLink'            => 'Khôi phục mật khẩu của bạn',

  // New Password Email
  'emailNewPasswordSubject'            => 'Mật khẩu mới',
  'emailNewPasswordHeading'            => 'Mật khẩu mới của %s',
  'emailNewPasswordSubheading'         => 'Mật khẩu của bạn đã được đổi thành: %s',

  );
