<?php

namespace spec\IonAuth\IonAuth;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AuthSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Auth');
    }
}
