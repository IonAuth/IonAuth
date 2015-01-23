<?php

namespace IonAuth\IonAuth\Utilities\Collection;

class AbstractCollection implements \Countable, \ArrayAccess
{
    protected $items = null;

    private function __construct(array $items = array())
    {
        $this->items = $items;
    }

    static public function create($items)
    {
        // if (self::$items !== NULL) throw new \Exception('You cannot "create" a non-empty collection');

        if (!is_array($items)) $items = [$items];
        return new static($items);
    }

    /**
     * add
     *
     * @param $item
     */
    public function add(CollectionItem $item)
    {
        $this->items[$item->getId()] = $item;
    }

    /**
     * remove
     *
     * @param $item
     */
    public function remove(CollectionItem $item)
    {
        if(isset($this->items[$item->getId()]) )
        {
            unset($this->items[$item->getId()]);
        }
    }

    /**
     * get
     *
     * @param $item
     * @return
     */
    public function get(CollectionItem $item)
    {
        return isset($this->items[$item->getId()])
            ? $this->items[$item->getId()]
            : false;
    }

    /**
     * isEmpty
     */
    public function isEmpty()
    {
        return (count($this->items) == 0);
    }

    /**
     * count
     *
     * @return
     */
    public function count()
    {
        return count($this->items);
    }

    /**
     * offsetExists
     *
     * @param $offset
     * @return
     */
    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    /**
     * offsetGet
     *
     * @param $offset
     */
    public function offsetGet($offset)
    {
        if (isset($this->items[$offset]))
        {
            return $this->items[$offset];
        }
    }

    /**
     * offsetSet
     *
     * @param $offset
     * @param $value
     */
    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    /**
     * offsetUnset
     *
     * @param offset
     */
    public function offsetUnset($offset)
    {
        if (isset($this->items[$offset])) unset($this->items[$offset]);
    }

    /**
     * first
     *
     * @return
     */
    public function first()
    {
        return array_shift($this->items);
    }

    /**
     * last
     *
     * @return
     */
    public function last()
    {
        return array_pop($this->items);
    }

    /**
     * clear
     */
    public function clear()
    {
        $this->items = [];
    }

    /**
     * getKeys
     *
     * @return
     */
    public function getKeys()
    {
        return array_keys($this->items);
    }

    /**
     * all
     *
     * @return
     */
    public function all()
    {
        return $this->items;
    }
}
