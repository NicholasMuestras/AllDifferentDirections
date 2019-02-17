<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:46
 */

namespace NicholasMuestras\AllDifferentDirections\models;

use NicholasMuestras\AllDifferentDirections\traits\IteratorAggregateTrait;


class TravelCaseCollection implements \IteratorAggregate
{
    use IteratorAggregateTrait;

    private $_id;

    /**
     * TravelCaseCollection constructor.
     * @param $_id
     */
    public function __construct($_id)
    {
        $this->_id = $_id;
    }


    public function getId()
    {
        return $this->_id;
    }

    public function getCurrent() // todo check - maybe bicycle
    {
        return current($this->_items);
    }

    public function deleteLastEmptyCase(): bool
    {
        $lastCase = array_pop($this->_items);

        if ($lastCase->getCount() == 0) {
            return true;
        }

        return false;
    }

}
