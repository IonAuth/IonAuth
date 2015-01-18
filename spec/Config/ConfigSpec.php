<?php

namespace spec\IonAuth\IonAuth\Config;

use IonAuth\IonAuth\Config\ConfigurationException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Config\Config');
    }

    function it_throws_exception_on_bad_has_method()
    {
        $this->shouldThrow(new ConfigurationException())->duringSetHashMethod('foobar');
    }
}
