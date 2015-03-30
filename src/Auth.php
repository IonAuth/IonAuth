<?php namespace IonAuth\IonAuth;

use League\Container\Container;

class Auth
{
    private $container = null;

    public static function container()
    {
        if (self::$container == null)
        {
            self::$container = new Container();
        }

        return self::$container;
  }
}