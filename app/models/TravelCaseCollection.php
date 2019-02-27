<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:46
 */

namespace app\models;

use app\traits\IteratorAggregateTrait;


/**
 * Class TravelCaseCollection
 * @package app\models
 */
class TravelCaseCollection implements \IteratorAggregate
{
    use IteratorAggregateTrait;

    /**
     * @var
     */
    private $_id;

    /**
     * TravelCaseCollection constructor.
     * @param $_id
     */
    public function __construct($_id)
    {
        $this->_id = $_id;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @return mixed
     */
    public function getCurrent() // todo check - maybe bicycle
    {
        return current($this->_items);
    }

    /**
     * @return bool
     */
    public function deleteLastEmptyCase(): bool
    {
        $lastCase = array_pop($this->_items);

        if ($lastCase->getCount() == 0) {
            return true;
        }

        return false;
    }

}
