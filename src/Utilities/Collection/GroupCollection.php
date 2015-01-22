<?php

namespace IonAuth\IonAuth\Utilities\Collection;

use IonAuth\IonAuth\Entities\Group;

class GroupCollection extends AbstractCollection
{
    static public function create($items)
    {
        foreach ($items as $item)
        {
            if (!($item instanceof Group))
            {
                throw new \Exception('A Group Collection can only contain groups');
            }
        }
        return parent::create($items);
    }
}
