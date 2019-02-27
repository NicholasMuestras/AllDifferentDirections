<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 17.02.2019
 * Time: 1:06
 */

namespace app\interfaces;


/**
 * Interface Point2DInterface
 * @package app\interfaces
 */
Interface Point2DInterface
{
    /**
     * Point2DInterface constructor.
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y);

    /**
     * @return float
     */
    public function getX(): float;

    /**
     * @return float
     */
    public function getY(): float;

}
