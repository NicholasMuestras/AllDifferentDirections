<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 22:18
 */

namespace NicholasMuestras\AllDifferentDirections\models;


class Launcher
{
    private $_travelCases = [];
    private $_travelersCollections = [];


    public function __construct(string $rawData)
    {
        $this->_travelCases = Parser::run($rawData);
    }


    public function run()
    {
        $this->_travelersCollections = $this->followTravelCases();

        return $this->getResultAsString();
    }


    protected function followTravelCases()
    {
        $travelerCollections = [];
        $travelCaseGroupName = '';
        $travelerName = '';

        foreach ($this->_travelCases as $keyByOrder => $travelCase) {

            $travelerCollectionName = implode('_', [$keyByOrder, $travelCase->getId()]);
            $travelerCollection = new TravelerCollection($travelerCollectionName);

            foreach ($travelCase as $way) {

                $travelerName = implode('_', [$travelCase->getId(), $way->getId()]);
                $anotherTraveler = DestinyFactory::happen(new Traveler($travelerName), $way);
                $travelerCollection->add($anotherTraveler);
            }

            $travelerCollections[] = $travelerCollection;
        }

        return $travelerCollections;
    }


    protected function getResultAsString(string $reportGlue = PHP_EOL, string $itemGlue = ' ')
    {
        $string = '';

        foreach ($this->_travelersCollections as $travelersCollection) {
            $string .= implode($itemGlue, $travelersCollection->getReport()) . $reportGlue;
        }

        return $string;
    }
}
