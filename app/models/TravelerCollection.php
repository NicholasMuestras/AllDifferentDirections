<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 18:14
 */

namespace NicholasMuestras\AllDifferentDirections\models;

use NicholasMuestras\AllDifferentDirections\interfaces\Point2DInterface;
use NicholasMuestras\AllDifferentDirections\models\point\Point2D;


class TravelerCollection
{

    private $_id;
    private $_items = [];

    private $_distances = [];


    public function __construct(string $id)
    {
        $this->_id = $id;
    }


    public function add(Traveler $traveler)
    {
        $this->_items[] = $traveler;
    }


    public function getTravelersPositions(): array
    {
        $positions = [];

        foreach ($this->_items as $traveler) {
            $position = $traveler->getPosition();
            $positions[] = new Point2D($position[0], $position[1]);
        }

        return $positions;
    }


    public function getTravelersPoints(): array
    {
        $points = [];

        foreach ($this->_items as $traveler) {
            $points[] = $traveler->getPoints();
        }

        return $points;
    }


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


    public static function calcDistanceBetweenPoints(Point2DInterface $a, Point2DInterface $b, int $roundPrecision = 4): float
    {
        $xA = $a->getX();
        $yA = $a->getY();
        $xB = $b->getX();
        $yB = $b->getY();

        return round(sqrt(pow($xB - $xA, 2) + pow($yB - $yA, 2)), $roundPrecision);
    }


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


    public function getMaxDistance(): float
    {
        return max($this->_distances);
    }


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
