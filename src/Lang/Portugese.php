<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The portugese language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Conta criada com sucesso',
     'accountCreationUnsuccesful'         => 'Não foi possível criar a conta',
     'accountCreationDuplicateEmail'      => 'Email em uso ou inválido',
     'accountCreationDuplicateUsername'   => 'Nome de usuário em uso ou inválido',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Senha alterada com sucesso',
     'passwordChangeUnsuccessful'         => 'Não foi possível alterar a senha',
     'forgotPasswordSuccessful'           => 'Nova senha enviada por email',
     'forgotPasswordUnsuccessful'         => 'Não foi possível criar uma nova senha',

     // Activation
     'activateSuccessful'                 => 'Conta ativada',
     'activateUnsuccessful'               => 'Não foi possível ativar a conta',
     'deactivateSuccessful'               => 'Conta desativada',
     'deactivateUnsuccessful'             => 'Não foi possível desativar a conta',
     'activationEmailSuccessful'          => 'Email de ativação enviado com sucesso',
     'activationEmailUnsuccessful'        => 'Não foi possível enviar o email de ativação',

     // Login / Logout
     'loginSuccessful'                    => 'Sessão iniciada com sucesso',
     'loginUnsuccessful'                  => 'Usuário ou senha inválidos',
     'loginUnsuccessfulNotActive'         => 'A conta está desativada',
     'loginTimeout'                       => 'Conta temporariamente bloqueada. Tente novamente mais tarde',
     'logoutSuccessful'                   => 'Sessão encerrada com sucesso',

     // Account changes
     'updateSuccessful'                   => 'Informações da conta atualizadas com sucesso',
     'updateUnsuccessful'                 => 'Não foi possível atualizar as informações da conta',
     'deleteSuccessful'                   => 'Usuário excluído com sucesso',
     'deleteUnsuccessful'                 => 'Não foi possível excluir o usuário',

     // Groups
     'groupCreationSuccessful'            => 'Grupo criado com sucesso',
     'groupAlreadyExists'                 => 'Um grupo com este nome já existe',
     'groupUpdateSuccessful'              => 'Dados do grupo atualizados com sucesso',
     'groupDeleteSuccessful'              => 'Grupo excluído com sucesso',
     'groupDeleteUnsccessful'             => 'Unable to delete group',
     'groupNameRequired'                  => 'Não foi possível excluir o grupo',

     // Activation Email
     'emailActivationSubject'             => 'Ativação da conta',
     'emailActivateHeading'               => 'Activate account for %s',
     'emailActivateSubheading'            => 'Please click this link to %s.',
     'emailActivateLink'                  => 'Activate your account',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Esqueci a senha',
     'emailForgotPasswordHeading'         => 'Reset password for, %s',
     'emailForgotPasswordSubheading'      => 'Please click this link to %s',
     'emailForgotPasswordLink'            => 'Reset tour password',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nova senha',
     'emailNewPasswordHeading'            => 'New password for %s',
     'emailNewPasswordSubheading'         => 'Your password has been reset to, %s',

   );
