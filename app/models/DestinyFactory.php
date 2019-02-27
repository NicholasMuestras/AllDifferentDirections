<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 23:09
 */

namespace app\models;


/**
 * Class DestinyFactory
 * @package app\models
 */
class DestinyFactory
{
    /**
     * @param Traveler $traveler
     * @param Way $way
     * @return Traveler
     */
    public static function happen(Traveler $traveler, Way $way): Traveler
    {
        foreach ($way as $momentOfLife) {

            $actionTitle = $momentOfLife->getName();
            $actionValue = $momentOfLife->getValue();

            if($actionTitle === 'home') {
                $traveler->setHomePoint($momentOfLife->getX(), $momentOfLife->getY());
            } else {
                $traveler->$actionTitle($actionValue);
            }
        }

        return $traveler;
    }
}
