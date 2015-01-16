<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The Spanish language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Cuenta creada con éxito',
     'accountCreationUnsuccesful'         => 'No se ha podido crear la cuenta',
     'accountCreationDuplicateEmail'      => 'Email en uso o inválido',
     'accountCreationDuplicateUsername'   => 'Nombre de usuario en uso o inválido',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Contraseña renovada con éxito',
     'passwordChangeUnsuccessful'         => 'No se ha podido cambiar la contraseña',
     'forgotPasswordSuccessful'           => 'Nueva contraseña enviada por email',
     'forgotPasswordUnsuccessful'         => 'No se ha podido crear una nueva contraseña',

     // Activation
     'activateSuccessful'                 => 'Cuenta activada con éxito',
     'activateUnsuccessful'               => 'No se ha podido activar la cuenta',
     'deactivateSuccessful'               => 'Cuenta desactivada con éxito',
     'deactivateUnsuccessful'             => 'No se ha podido desactivar la cuenta',
     'activationEmailSuccessful'          => 'Email de activación enviado',
     'activationEmailUnsuccessful'        => 'No se ha podido enviar el email de activación',

     // Login / Logout
     'loginSuccessful'                    => 'Sesión iniciada con éxito',
     'loginUnsuccessful'                  => 'No se ha podido iniciar sesión',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Sesión finalizada con éxito',

     // Account changes
     'updateSuccessful'                   => 'Información de la cuenta actualizada con éxito',
     'updateUnsuccessful'                 => 'No se ha podido actualizar la información de la cuenta',
     'deleteSuccessful'                   => 'Usuario eliminado',
     'deleteUnsuccessful'                 => 'No se ha podido Eliminar el usuario',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Activación de la cuenta',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Verificación de contraseña olvidada',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nueva Contraseña',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
