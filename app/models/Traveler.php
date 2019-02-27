<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:33
 */

namespace NicholasMuestras\AllDifferentDirections\models;

use NicholasMuestras\AllDifferentDirections\interfaces\Point2DInterface;
use NicholasMuestras\AllDifferentDirections\models\point\Point2D;
use NicholasMuestras\AllDifferentDirections\models\point\PositionPoint;


class Traveler
{
    private $_name;
    private $_x;
    private $_y;
    private $_direction;
    private $_points;

    public function __construct(string $id, float $x = 0, float $y = 0, float $direction = 0)
    {
        $this->_name = $id;
        $this->setHomePoint($x, $y, $direction);
    }


    public function getId(): string
    {
        return $this->_name;
    }


    public function setHomePoint(float $x, float $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }


    public function start(float $direction)
    {
        $this->turn($direction);
        $this->checkPoint($this->_x, $this->_y, $this->_direction);
    }


    public function turn(float $direction)
    {
        $this->_direction = $this->_direction + $direction;

        if ($this->_direction > 360) {
            $this->_direction = $this->_direction - 360;
        } elseif ($this->_direction < 0) {
            $this->_direction = $this->_direction + 360;
        } elseif ($this->_direction == 360) {
            $this->_direction = 0;
        }

        $this->checkPoint($this->_x, $this->_y, $this->_direction);
    }


    public function walk(float $distance)
    {
        $this->_x = $this->_x + $distance * round(cos(deg2rad($this->_direction)), 2);
        $this->_y = $this->_y + $distance * round(sin(deg2rad($this->_direction)), 2);

        $this->checkPoint($this->_x, $this->_y, $this->_direction);
    }


    public function getPosition(): Point2DInterface
    {
        return new Point2D($this->_x, $this->_y);
    }


    public function getDirection(): float
    {
        $this->_direction;
    }


    private function checkPoint(float $x, float $y, float $direction)
    {
        $this->_points[] = new PositionPoint($x, $y, $direction);
    }


    public function getPoints()
    {
        return $this->_points;
    }
}
