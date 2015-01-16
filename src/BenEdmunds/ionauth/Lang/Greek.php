<?php

  /**
   * ----------------------------------------------------
   * Info:
   * ----------------------------------------------------
   * @author Tim Joosten
   * @package Ion Auth 3
   *
   * Description, The greek language file for Ion Auth 3
   * ----------------------------------------------------
   */

   return array(

     // Account creation
     'accountCreationSuccesful'           => 'Ο Λογαριασμός Δημιουργήθηκε Επιτυχώς',
     'accountCreationUnsuccesful'         => 'Αποτυχία Δημιουργίας Λογαριασμού',
     'accountCreationDuplicateEmail'      => 'Το Email χρησιμποιείται ήδη ή είναι λάθος',
     'accountCreationDuplicateUsername'   => 'Ο Χρήστης υπάρχει ήδη ή είναι λάθος',
     'accountCreationMissingDefaultGroup' => 'Default group is not set',
     'accountCreationInvalidDefaultGroup' => 'Invalid default group name set',

     // Password
     'passwordChangeSuccessful'           => 'Επιτυχής Αλλαγή Κωδικού',
     'passwordChangeUnsuccessful'         => 'Αδυναμία Αλλαγής Κωδικού',
     'forgotPasswordSuccessful'           => 'Εστάλη Email Κωδικού Επαναφοράς',
     'forgotPasswordUnsuccessful'         => 'Αδυναμία Επαναφοράς Κωδικού',

     // Activation
     'activateSuccessful'                 => 'Ο Λογαριασμός Ενεργοποιήθηκε',
     'activateUnsuccessful'               => 'Αδυναμία Ενεργοποίησης Λογαριασμού',
     'deactivateSuccessful'               => 'Ο Λογαριασμός Απενεργοποιήθηκε',
     'deactivateUnsuccessful'             => 'Αδυναμία Απενεργοποίησης Λογαριασμού',
     'activationEmailSuccessful'          => 'Εστάλη Email Ενεργοποίησης Λογαριασμού',
     'activationEmailUnsuccessful'        => 'Αδυναμία Αποστολής Email Ενεργοποίησης',

     // Login / Logout
     'loginSuccessful'                    => 'Συνδεθήκατε Επιτυχώς',
     'loginUnsuccessful'                  => 'Λάθος Στοιχεία',
     'loginUnsuccessfulNotActive'         => 'Account is inactive',
     'loginTimeout'                       => 'Temporarily locked out. Try again later',
     'logoutSuccessful'                   => 'Αποσυνδεθήκατε Επιτυχώς',

     // Account changes
     'updateSuccessful'                   => 'Οι Πληροφορίες του Λογαριασμού Ενημερώθηκαν Επιτυχώς',
     'updateUnsuccessful'                 => 'Αδυναμία Ενημέρωσης Πληροφοριών Λογαριασμού',
     'deleteSuccessful'                   => 'Ο Χρήστης Διαγράφηκε',
     'deleteUnsuccessful'                 => 'Αδυναμία Διαγραφής Χρήστη',

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
