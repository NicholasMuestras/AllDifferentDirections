<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:46
 */

namespace app\models;


/**
 * Class TravelCase
 * @package app\models
 */
class TravelCase implements \IteratorAggregate
{
    /**
     * @var string
     */
    private $_id;
    /**
     * @var array
     */
    private $_ways = [];


    /**
     * TravelCase constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->_id = $id;
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }


    /**
     * @param Way $way
     */
    public function addWay(Way $way)
    {
        $this->_ways[] = $way;
    }


    /**
     * @return \ArrayIterator|\Traversable
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->_ways);
    }


    /**
     * @return int
     */
    public function getCount(): int
    {
        return count($this->_ways);
    }

}
