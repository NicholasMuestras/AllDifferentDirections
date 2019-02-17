<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:46
 */

namespace NicholasMuestras\AllDifferentDirections\models;


class TravelCase implements \IteratorAggregate
{
    private $_id;
    private $_ways = [];


    public function __construct(string $id)
    {
        $this->_id = $id;
    }


    public function getId(): string
    {
        return $this->_id;
    }


    public function addWay(Way $way)
    {
        $this->_ways[] = $way;
    }


    public function getIterator()
    {
        return new \ArrayIterator($this->_ways);
    }


    public function getCount(): int
    {
        return count($this->_ways);
    }

}
