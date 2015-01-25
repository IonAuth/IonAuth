<?php
namespace spec\IonAuth\IonAuth\Email\Adapters;

use PhpSpec\ObjectBehavior;
use IonAuth\IonAuth\Email\Adapters\NativeAdapter;

class NativeAdapterSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['test' => 1]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Email\Adapters\NativeAdapter');
    }
}
