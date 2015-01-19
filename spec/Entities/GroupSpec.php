<?php

namespace spec\IonAuth\IonAuth\Entities;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupSpec extends ObjectBehavior
{
    private $id;

    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Entities\Group');
    }

    function it_has_an_id()
    {
        return $this->id;
    }
}
