<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The catalan language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Compte creat amb èxit',
     'accountCreationUnsuccesful'         => 'No ha estat possible crear al compte',
     'accountCreationDuplicateEmail'      => 'Email en ús o invàlid',
     'accountCreationDuplicateUsername'   => 'Nom d&#39;usuari en ús o invàlid',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Contrasenya canviada amb èxit',
     'passwordChangeUnsuccessful'         => 'No ha estat possible canviar la contrasenya',
     'forgotPasswordSuccessful'           => 'Nova contrasenya enviada per email',
     'forgotPasswordUnsuccessful'         => 'No ha estat possible crear una nova contrasenya',

     // Activation
     'activateSuccessful'                 => 'Compte activat',
     'activateUnsuccessful'               => 'No ha estat possible activar el compte',
     'deactivateSuccessful'               => 'Compte desactivat',
     'deactivateUnsuccessful'             => 'No ha estat possible desactivar el compte',
     'activationEmailSuccessful'          => 'Email d&#39;activació enviat',
     'activationEmailUnsuccessful'        => 'No ha estat possible enviar l&#39;email d&#39;activació',

     // Login / Logout
     'loginSuccessful'                    => 'Sessió iniciada amb èxit',
     'loginUnsuccessful'                  => 'No ha estat possible iniciar sessió',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Sessiò finalitzada amb èxit',

     // Account changes
     'updateSuccessful'                   => 'Informació del compte actualitzat amb èxit',
     'updateUnsuccessful'                 => 'No s&#39;ha pogut actualitzar la informació del compte',
     'deleteSuccessful'                   => 'Usuari eliminat',
     'deleteUnsuccessful'                 => 'No s&#39;ha pogut Eliminar l&#39;usuari',

     // Groups
     'groupCreationSuccessful'            => 'Group created successfully',
     'groupAlreadyExists'                 => 'Group name already taken',
     'groupUpdateSuccessful'              => 'Group details updated',
     'groupDeleteSuccessful'              => 'Group deleted',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Group name is a required field',

     // Activation Email
     'emailActivationSubject'             => 'Activació del compte',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Verificació de contrasenya oblidada',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nova contrasenya',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
