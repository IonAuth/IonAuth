<?php namespace IonAuth\IonAuth;

use League\Container\Container;

class Auth
{
    private $container = null;

    /**
     * container
     *
     * @access public
     */
    public static function container()
    {
        if (self::$container == null)
        {
            self::$container = new Container();
        }

        return self::$container;
  }
}
