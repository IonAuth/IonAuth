<?php

namespace spec\IonAuth\IonAuth\Commands;

use IonAuth\IonAuth\Entities\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RegisterSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Commands\Register');
    }

    function it_can_register_a_user(User $user)
    {
        $this->register($user)->shouldReturn('IonAuth\IonAuth\Entities\User');
    }
}
