<?php
namespace spec\IonAuth\IonAuth\Email;

use PhpSpec\ObjectBehavior;
use IonAuth\IonAuth\Email\EmailManager;

class EmailManagerSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('native', ['test' => 1]);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Email\EmailManager');
    }

    function it_creates_a_native_mail_driver()
    {
        $this->getDriver()->shouldImplement('IonAuth\IonAuth\Email\EmailAdapterInterface');
        $this->getDriver()->shouldHaveType('IonAuth\IonAuth\Email\Adapters\NativeAdapter');
    }

    function it_throws_an_exception_on_missing_driver()
    {
        $this->beConstructedWith('foo', ['test' => 1]);
        $this->shouldThrow('\DomainException');
    }

    function it_calls_method_on_driver()
    {
        $this->send(['fields' => 'a field'])->shouldBe(true);
    }

    function it_throws_exception_on_missing_method()
    {
        $this->shouldThrow('\BadMethodCallException')->during('foo', ['bar']);
    }
}
