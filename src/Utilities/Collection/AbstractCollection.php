<?php namespace IonAuth\IonAuth\Utilities\Collection;


/**
 * Created by PhpStorm.
 * User: kayladnls
 * Date: 1/19/15
 * Time: 12:03 AM
 */


class AbstractCollection implements \Countable, \ArrayAccess
{
    protected $items = null;

    private function __construct(array $items = array())
    {
        $this->items = $items;
    }

    static public function create($items)
    {
//        if (self::$items !== NULL) throw new \Exception('You cannot "create" a non-empty collection');

        if (!is_array($items)) $items = [$items];
        return new static($items);
    }

    public function add(CollectionItem $item)
    {
        $this->items[$item->getId()] = $item;
    }

    public function remove(CollectionItem $item)
    {
        if(isset($this->items[$item->getId()]) )
        {
            unset($this->items[$item->getId()]);
        }
    }

    public function get(CollectionItem $item)
    {
        return isset($this->items[$item->getId()])
            ? $this->items[$item->getId()]
            : false;
    }

    public function isEmpty()
    {
        return (count($this->items) == 0);
    }

    public function count()
    {
        return count($this->items);
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        if (isset($this->items[$offset]))
        {
            return $this->items[$offset];
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (isset($this->items[$offset])) unset($this->items[$offset]);
    }

    public function first()
    {
        return array_shift($this->items);
    }

    public function last()
    {
        return array_pop($this->items);
    }

    public function clear()
    {
        $this->items = [];
    }

    public function getKeys()
    {
        return array_keys($this->items);
    }

    public function all()
    {
        return $this->items;
    }
}