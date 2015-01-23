<?php
  namespace IonAuth\IonAuth\Helper;

  /**
   * prepareIp
   *
   * @param $ipAddress
   * @return
   */
  function prepareIp($ipAddress)
  {
    $driver = $this->config->get('database')['driver'];

    return (in_array($driver, ['postgres', 'sqlsrv', 'mssql'])) ? $ipAddress : inet_pton($ipAddress);
  }

  /**
   * validate email
   *
   * @param $email, string
   * @return
   */
  function validateEmail($email)
  {
    $regex = '/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
    return ( preg_match( $regex, $email ));
  }
