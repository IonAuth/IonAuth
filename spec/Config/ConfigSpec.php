<?php

namespace spec\BenEdmunds\IonAuth\Config;

use BenEdmunds\IonAuth\Config\ConfigurationException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BenEdmunds\IonAuth\Config\Config');
    }

    function it_throws_exception_on_bad_has_method()
    {
        $this->shouldThrow(new ConfigurationException())->duringSetHashMethod('foobar');
    }
}
