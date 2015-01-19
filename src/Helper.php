<?php namespace IonAuth\IonAuth\Helper;

function prepareIp($ipAddress)
{
    $driver = $this->config->get('database')['driver'];

    return (in_array($driver, ['postgres', 'sqlsrv', 'mssql'])) ? $ipAddress : inet_pton($ipAddress);
}

function validateEmail($email)
{
    $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    return ( preg_match( $regex, $email ));
}