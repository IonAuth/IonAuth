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

    function it_is_immutable()
    {
        $this->shouldThrow('IonAuth\IonAuth\Config\ConfigurationException')
            ->during('__set', ["siteTitle", "hello"]);
    }


}
