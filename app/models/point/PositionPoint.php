<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 17.02.2019
 * Time: 1:10
 */

namespace app\models\point;

use app\interfaces\Point2DInterface;


class PositionPoint extends Point2D implements Point2DInterface
{
    private $_direction;

    public function __construct(float $x, float $y, float $direction = 0)
    {
        parent::__construct($x, $y);
        $this->_direction = $direction;
    }


    public function setDirection(float $direction)
    {
        $this->_direction = $direction;
    }


    public function getDirection(): float
    {
        return $this->_direction;
    }
}
