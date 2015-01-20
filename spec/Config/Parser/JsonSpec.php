<?php

namespace spec\IonAuth\IonAuth\Config\Parser;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Config\Parser\Json');
    }
}
