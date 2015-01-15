<?php

namespace spec\BenEdmunds\IonAuth\Lang;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class LangSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BenEdmunds\Lang\Lang');
    }

    function it_can_read_a_config_file()
    {

    }
}
