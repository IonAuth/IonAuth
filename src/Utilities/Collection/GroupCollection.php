<?php namespace IonAuth\IonAuth\Utilities\Collection;

use IonAuth\IonAuth\Entities\Group;

/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/19/15
 * Time: 12:03 AM
 */


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
