<?php

namespace spec\IonAuth\IonAuth\Config;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Config\Config');
    }

    function let()
    {
        $this->beConstructedWith(['yello' => 'blue', 'this' => true]);
    }

    function it_can_get_a_config_value()
    {
        $this->get('yello')->shouldReturn('blue');
    }
}
