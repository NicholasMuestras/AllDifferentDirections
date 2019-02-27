<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 18:14
 */

namespace app\models;

use app\interfaces\Point2DInterface;
use app\models\point\Point2D;


/**
 * Class TravelerCollection
 * @package app\models
 */
class TravelerCollection
{

    /**
     * @var string
     */
    private $_id;
    /**
     * @var array
     */
    private $_items = [];

    /**
     * @var array
     */
    private $_distances = [];


    /**
     * TravelerCollection constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->_id = $id;
    }


    /**
     * @param Traveler $traveler
     */
    public function add(Traveler $traveler)
    {
        $this->_items[] = $traveler;
    }


    /**
     * @return array
     */
    public function getTravelersPositions(): array
    {
        $positions = [];

        foreach ($this->_items as $traveler) {
            $position = $traveler->getPosition();
            $positions[] = new Point2D($position[0], $position[1]);
        }

        return $positions;
    }


    /**
     * @return array
     */
    public function getTravelersPoints(): array
    {
        $points = [];

        foreach ($this->_items as $traveler) {
            $points[] = $traveler->getPoints();
        }

        return $points;
    }


    /**
     * @return Point2DInterface
     * @throws \Exception
     */
    public function calcAverageDestinationPoint(): Point2DInterface
    {
        $x = 0;
        $y = 0;
        $ch = 0;

        foreach ($this->_items as $traveler) {

            $point = $traveler->getPosition();
            $x += $point->getX();
            $y += $point->getY();
            $ch++;
        }

        if (!$ch) {
            throw new \Exception('Unable AverageDestinationPoint calculation. No one point.');
        }

        return new Point2D(round($x / $ch, 4), round($y / $ch, 4));
    }


    /**
     * @param Point2DInterface $a
     * @param Point2DInterface $b
     * @param int $roundPrecision
     * @return float
     */
    public static function calcDistanceBetweenPoints(Point2DInterface $a, Point2DInterface $b, int $roundPrecision = 4): float
    {
        $xA = $a->getX();
        $yA = $a->getY();
        $xB = $b->getX();
        $yB = $b->getY();

        return round(sqrt(pow($xB - $xA, 2) + pow($yB - $yA, 2)), $roundPrecision);
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function calcDistanceBetweenDestinationPointsAndAverageDestinationPoint(): array
    {

        $distanceList = [];
        $averageDestinationPoint = $this->calcAverageDestinationPoint();

        foreach ($this->_items as $key => $traveler) {
            $destinationPoint = $traveler->getPosition();
            $distanceList[$key] = self::calcDistanceBetweenPoints($averageDestinationPoint, $destinationPoint);
        }

        return $distanceList;
    }


    /**
     * @return float
     */
    public function getMaxDistance(): float
    {
        return max($this->_distances);
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function getReport(): array
    {
        // Painter::draw(array_merge($this->getTravelersPoints(), [[$this->calcAverageDestinationPoint()]]), 500, 500);
        $this->_distances = $this->calcDistanceBetweenDestinationPointsAndAverageDestinationPoint();
        $adp = $this->calcAverageDestinationPoint();
        $report = [
            'averageDestinationPointX' => $adp->getX(),
            'averageDestinationPointY' => $adp->getY(),
            'maxDistance' => $this->getMaxDistance(),
        ];

        return $report;
    }
}
