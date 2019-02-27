<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 22:50
 */
namespace app\traits;


trait IteratorAggregateTrait
{
    private $_items = [];

    public function getIterator()
    {
        return new \ArrayIterator($this->_items);
    }

    public function add($item)
    {
        $this->_items[] = $item;
    }
}
