<?php

require 'vendor/autoload.php';

use IonAuth\IonAuth\Email\EmailManager;

$email = new EmailManager('native', []);

$email->send(['test' => 1]);

// Run `php test.php` from cmd line
// 
// output should be 
// Array
// (
//     [test] => 1
// )