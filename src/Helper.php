<?php namespace IonAuth\IonAuth\Helper;

function prepareIp($ipAddress)
{
    $ipAddress;
}

function validateEmail($email)
{
    $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    return ( preg_match( $regex, $email ));
}