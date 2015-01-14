<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description: The French language file for Ion Auth 3
   * ----------------------------------------------------
   */

   $language = [

     // Account creation
     'accountCreationSuccesful'           => 'Compte créé avec succés',
     'accountCreationUnsuccesful'         => 'Impossible de créer le compte',
     'accountCreationDuplicateEmail'      => 'Email déjà utilisé ou invalide',
     'accountCreationDuplicateUsername'   => 'Nom d\'utilisateur déjà utilisé ou invalide',
     'accountCreationMissingDefaultGroup' => 'Le groupe par défaut n\'est pas configuré',
     'accountCreationInvalidDefaultGroup' => 'Le nom du groupe par défaut n\'est pas valide',

     // Password
     'passwordChangeSuccessful'           => 'Le mot de passe a été changé avec succès',
     'passwordChangeUnsuccessful'         => 'Impossible de changer le mot de passe',
     'forgotPasswordSuccessful'           => 'Mail de réinitialisation du mot de passe envoyé',
     'forgotPasswordUnsuccessful'         => 'Impossible de réinitialiser le mot de passe',

     // Activation
     'activateSuccessful'                 => 'Compte activé',
     'activateUnsuccessful'               => 'Impossible d\'activer le compte',
     'deactivateSuccessful'               => 'Compte désactivé',
     'deactivateUnsuccessful'             => 'Impossible de désactiver le compte',
     'activationEmailSuccessful'          => 'Email d\'activation envoyé avec succès',
     'activationEmailUnsuccessful'        => 'Impossible d\'envoyer l\'email d\'activation',

     // Login / Logout
     'loginSuccessful'                    => 'Connecté avec succès',
     'loginUnsuccessful'                  => 'Erreur lors de la connexion',
     'loginUnsuccessfulNotActive'         => 'Ce compte est inactif',
     'loginTimeout'                       => 'Compte temporairement verrouillé. Réessayez plus tard.',
     'logoutSuccessful'                   => 'Déconnexion effectuée avec succès',

     // Account changes
     'updateSuccessful'                   => 'Compte utilisateur mis à jour avec succès',
     'updateUnsuccessful'                 => 'Impossible de mettre à jour le compte utilisateur',
     'deleteSuccessful'                   => 'Utilisateur supprimé',
     'deleteUnsuccessful'                 => 'Impossible de supprimer l\'utilisateur',

     // Groups
     'groupCreationSuccessful'            => 'Groupe créé avec succès',
     'groupAlreadyExists'                 => 'Nom du groupe déjà pris',
     'groupUpdateSuccessful'              => 'Informations sur le groupe mis à jour',
     'groupDeleteSuccessful'              => 'Groupe supprimé',
     'groupDeleteUnsccessful'             => 'Impossible de supprimer le groupe',
     'groupNameRequired'                  => 'Le nom du groupe est un champ obligatoire',

     // Activation Email
     'emailActivationSubject'             => 'Activation du compte',
     'emailActivateHeading'               => 'Activer le compte pour %s',
     'emailActivateSubheading'            => 'S\'il vous plaît cliquer sur ce lien pour %s.',
     'emailActivateLink'                  => 'Activez votre compte',

     // Forgot Password Email
     'emailForgottenPasswordSubject'      => 'Mot de Passe Oublié - Vérification',
     'emailForgotPasswordHeading'         => 'Réinitialiser le mot de passe pour %s',
     'emailForgotPasswordSubheading'      => 'S\'il vous plaît cliquer sur ce lien pour %s.',
     'emailForgotPasswordLink'            => 'Réinitialiser votre mot de passe',

     // New Password Email
     'emailNewPasswordSubject'            => 'Nouveau Mot de Passe',
     'emailNewPasswordHeading'            => 'Nouveau Mot de Passe pour %s',
     'emailNewPasswordSubheading'         => 'Votre mot de passe a été réinitialisé à : %s',

   ];
