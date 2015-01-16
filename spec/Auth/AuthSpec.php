<?php
namespace spec\BenEdmunds\IonAuth\Auth;

use Auth;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DbSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('BenEdmunds\IonAuth\Auth');
    }

    function it_throws_exception_on_bad_has_method()
    {
        $this->shouldThrow(new PDOException())->duringSetHashMethod('foobar');
    }
}