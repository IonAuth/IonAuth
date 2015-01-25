<?php

namespace spec\IonAuth\IonAuth\Commands;

use IonAuth\IonAuth\Config\Config;
use IonAuth\IonAuth\Db\Db;
use IonAuth\IonAuth\Events\Events;
use IonAuth\IonAuth\Entities\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Commands\Register');
    }

    function it_can_register_a_user(Config $config, Events $events, User $user)
    {
        $this->register($config, $events, $user)->shouldReturn('IonAuth\IonAuth\Entities\User');
    }
}
