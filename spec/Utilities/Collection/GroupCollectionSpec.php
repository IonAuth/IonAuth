<?php

namespace spec\IonAuth\IonAuth\Utilities\Collection;

use IonAuth\IonAuth\Entities\Group;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GroupCollectionSpec extends ObjectBehavior
{

    public function let(Group $group)
    {
        $group->beADoubleOf('IonAuth\IonAuth\Entities\Group');
        $group->getId()->willReturn('5');
        $this->beConstructedThrough('create', [$group]);
    }

    public function it_can_get_count()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_can_be_created_from_array_of_groups(Group $group1, Group $group2)
    {
        $group1->getId()->willReturn('5');
        $group2->getId()->willReturn('10');

        $groups = [$group1, $group2];

        $this->beConstructedThrough('create', [$groups]);

        $this->count()->shouldReturn(2);
    }

    public function it_can_be_created_from_a_single_group(Group $group)
    {
        $this->count()->shouldReturn(1);
    }

    public function it_can_tell_if_its_empty()
    {
        $this->beConstructedThrough('create', [[]]);
        $this->isEmpty()->shouldReturn(true);
    }

    public function it_can_remove_a_group($group)
    {
        $this->beConstructedThrough('create', [[]]);
        $this->isEmpty()->shouldReturn(true);

        $this->remove($group);

        $this->isEmpty()->shouldReturn(true);
    }

    public function it_can_return_keys(Group $group)
    {
        $this->getKeys()->shouldBeArray();
    }

    public function it_can_get_the_first_item(Group $group)
    {
        $this->first()->shouldBeAnInstanceOf('IonAuth\IonAuth\Utilities\Collection\CollectionItem');
    }

    public function it_come_get_the_last_item(Group $group)
    {
        $this->last()->shouldBeAnInstanceOf('IonAuth\IonAuth\Utilities\Collection\CollectionItem');
    }

    public function it_can_clear_itself()
    {
        $this->clear();
        $this->all()->shouldHaveCount(0);
    }

    public function it_can_only_contain_groups()
    {
        $group = $this->create([]);
        $group->shouldThrow('\Exception')->duringCreate(['yellow']);
    }

    public function it_cannot_create_if_not_empty(Group $group)
    {
        $group->getId()->willReturn(7);
        $this->add($group);

        $this->shouldThrow('\Exception')->duringCreate($group);
    }

    public function it_can_return_all(Group $group)
    {
        $group->getId()->willReturn(30);
        $this->add($group);
        $this->all()->shouldHaveCount(2);
    }

    public function letGo()
    {
        $this->clear();
    }
}
