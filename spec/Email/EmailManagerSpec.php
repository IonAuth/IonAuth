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

    function it_creates_a_mail_driver()
    {
        $this->getDriver()->shouldImplement('IonAuth\IonAuth\Email\EmailAdapterInterface');
        $this->getDriver()->shouldHaveType('IonAuth\IonAuth\Email\Adapters\NativeAdapter');
    }

}
