<?php

namespace spec\IonAuth\IonAuth\Entities;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LoginAttemptSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Entities\LoginAttempt');
    }

}
