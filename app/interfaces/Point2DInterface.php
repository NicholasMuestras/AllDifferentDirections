<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 17.02.2019
 * Time: 1:06
 */

namespace NicholasMuestras\AllDifferentDirections\interfaces;


Interface Point2DInterface
{
    public function __construct(float $x, float $y);

    public function getX(): float;

    public function getY(): float;

}
