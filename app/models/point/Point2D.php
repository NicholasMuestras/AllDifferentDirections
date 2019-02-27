<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 0:28
 */

namespace app\models\point;

use app\interfaces\Point2DInterface;


class Point2D implements Point2DInterface
{
    public $x;
    public $y;

    /**
     * _2dPoint constructor.
     * @param $x
     * @param $y
     */
    public function __construct(float $x, float $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY(): float
    {
        return $this->y;
    }

}
