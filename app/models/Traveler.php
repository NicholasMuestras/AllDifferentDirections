<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:33
 */

namespace app\models;

use app\interfaces\Point2DInterface;
use app\models\point\Point2D;
use app\models\point\PositionPoint;


/**
 * Class Traveler
 * @package app\models
 */
class Traveler
{
    /**
     * @var string
     */
    private $_name;
    /**
     * @var
     */
    private $_x;
    /**
     * @var
     */
    private $_y;
    /**
     * @var
     */
    private $_direction;
    /**
     * @var
     */
    private $_points;

    /**
     * Traveler constructor.
     * @param string $id
     * @param float $x
     * @param float $y
     * @param float $direction
     */
    public function __construct(string $id, float $x = 0, float $y = 0, float $direction = 0)
    {
        $this->_name = $id;
        $this->setHomePoint($x, $y, $direction);
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_name;
    }


    /**
     * @param float $x
     * @param float $y
     */
    public function setHomePoint(float $x, float $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }


    /**
     * @param float $direction
     */
    public function start(float $direction)
    {
        $this->turn($direction);
        $this->checkPoint($this->_x, $this->_y, $this->_direction);
    }


    /**
     * @param float $direction
     */
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


    /**
     * @param float $distance
     */
    public function walk(float $distance)
    {
        $this->_x = $this->_x + $distance * round(cos(deg2rad($this->_direction)), 2);
        $this->_y = $this->_y + $distance * round(sin(deg2rad($this->_direction)), 2);

        $this->checkPoint($this->_x, $this->_y, $this->_direction);
    }


    /**
     * @return Point2DInterface
     */
    public function getPosition(): Point2DInterface
    {
        return new Point2D($this->_x, $this->_y);
    }


    /**
     * @return float
     */
    public function getDirection(): float
    {
        $this->_direction;
    }


    /**
     * @param float $x
     * @param float $y
     * @param float $direction
     */
    private function checkPoint(float $x, float $y, float $direction)
    {
        $this->_points[] = new PositionPoint($x, $y, $direction);
    }


    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->_points;
    }
}
