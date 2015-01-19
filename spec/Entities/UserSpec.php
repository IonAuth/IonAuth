<?php

namespace spec\IonAuth\IonAuth\Entities;

use IonAuth\IonAuth\Entities\Group;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('IonAuth\IonAuth\Entities\User');
    }

    function it_has_an_email_address()
    {
        $this->setEmail('email@address.com');
        $this->getEmail()->shouldReturn('email@address.com');
    }

    function it_does_not_allow_an_invalid_email_address()
    {
        $this->shouldThrow('\Exception')->duringSetEmail('adklfjakldfjaldkjflajksdf');
    }

    function it_can_be_added_to_a_group($group)
    {
        $group->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group->getId()->willReturn("10");

        $this->addGroup($group);

        $this->getGroups()->shouldHaveCount(1);
        $this->getGroups()->first()->shouldHaveType('IonAuth\IonAuth\Entities\Group');
    }

    public function it_can_be_added_to_multiple_groups($group, $group2)
    {
        $group->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group->getId()->willReturn("11");

        $group2->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group2->getId()->willReturn("10");

        $this->addGroup($group);
        $this->addGroup($group2);

        $this->getGroups()->count()->shouldReturn(2);
    }

    function it_belongs_to_groups($group)
    {
        $group->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group->getId()->willReturn("Hi, there");

        $this->addGroup($group);

        $this->getGroups()->shouldHaveCount(1);

        $this->inGroup($group)->shouldReturn(true);
    }

    function it_can_be_removed_from_a_group($group)
    {
        $group->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group->getId()->willReturn(10);

        $this->addGroup($group);

        $this->removeGroup($group);

        $this->getGroups()->shouldHaveCount(0);
    }

    public function it_has_a_first_name()
    {
        $this->setFirstName('George');
        $this->getFirstName()->shouldReturn('George');
    }

    public function it_has_a_last_name()
    {
        $this->setLastName('Jingleheimer Schmidt');
        $this->getLastName()->shouldReturn('Jingleheimer Schmidt');
    }

    public function it_can_get_full_name()
    {
        $this->setFirstName('John Jacob');
        $this->setLastName('Jingleheimer Schmidt');
        $this->getFullName()->shouldReturn('John Jacob Jingleheimer Schmidt');
    }

    public function it_has_a_last_login()
    {
        $this->updateLastLogin();
        $this->getLastLogin()->shouldReturn(time());
    }

}
