<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 23:16
 */

namespace NicholasMuestras\AllDifferentDirections\models;

use NicholasMuestras\AllDifferentDirections\interfaces\ParserInterface;

/**
 * Class Parser
 * @package NicholasMuestras\AllDifferentDirections\models
 */
class Parser implements ParserInterface
{
    private static $dictionary = ['start' => 'start', 'walk' => 'walk', 'turn' => 'turn'];
    private static $limits = ['testCaseMax' => 100, 'waysPerCaseMax' => 20, 'waysInCurrentCase' => 0];
    private static $counters = ['testCaseCurrent' => 0, 'wayCurrent' => 0];

    private static $rawData = [];
    private static $data = [];


    public static function run($rawData): TravelCaseCollection
    {
        $travelCaseCollection = new TravelCaseCollection('default');
        $travelCase = new TravelCase('default');

        self::$rawData = explode(PHP_EOL, $rawData);

        foreach (self::$rawData as $rowNumber => $string) {

            if (self::isInitTestCaseInteger($rowNumber)) {

                $travelCase = new TravelCase($string);
                $travelCaseCollection->add($travelCase);

            } elseif (self::isWay($rowNumber)) {

                $way = new Way($rowNumber, 0, 0);
                self::buildWay($way, $string);
                $travelCase->addWay($way);

            } else {
                throw new \Exception("Parse error $string in string: " . ++$rowNumber);
            }
        }

        if (!$travelCaseCollection->deleteLastEmptyCase()) {
            throw new \Exception("Parse error. Finally zero travelCase isn't exist.");
        }

        return $travelCaseCollection;
    }


    private static function isInitTestCaseInteger(int &$currentKey)
    {
        $value = trim(self::$rawData[$currentKey]);
        $length = mb_strlen($value, 'UTF-8');

        if ($length > 0 && $length < 4 && is_int($value += 0) && $value >= 0 && $value <= 100) {

            return true;
        }

        return false;
    }


    private static function isWay(int &$currentKey)
    {
        $value = self::$rawData[$currentKey];

        if (mb_substr_count($value, self::$dictionary['start'], 'UTF-8') == 1) {

            return true;
        }

        return false;
    }


    private static function buildWay(Way &$way, string $commandString)
    {
        $commandStart = &self::$dictionary['start'];
        $strPart = explode(' ', $commandString);

        // if correct sequence, like coordinateXvalue -> coordinateYvalue -> commandStartName -> commandStartValue
        if (is_numeric($strPart[0]) && is_numeric($strPart[1])
            && $strPart[2] === $commandStart && is_numeric($strPart[3])) {

            $way->setHome($strPart[0], $strPart[1]);
            $way->createCommand($commandStart, $strPart[3]);

            // parse other command's sequences
            for ($key = 4; isset($strPart[$key]); $key += 2) {

                $commandName = &$strPart[$key];

                if (in_array($commandName, self::$dictionary, true)) {
                    $way->createCommand($commandName, $strPart[$key + 1]);
                } else {
                    return new \Exception("Get wrong command $commandName");
                }
            }
        }
    }

}
