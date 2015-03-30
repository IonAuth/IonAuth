<?php namespace IonAuth\IonAuth;

use League\Container\Container;

class IonAuth
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