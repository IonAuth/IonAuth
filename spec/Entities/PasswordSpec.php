<?php

namespace spec\IonAuth\IonAuth\Entities;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PasswordSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('blueDabaDee');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Entities\Password');
    }

    public function it_can_be_hashed()
    {

    }
}
