<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:11
 */

namespace NicholasMuestras\AllDifferentDirections\interfaces;

use NicholasMuestras\AllDifferentDirections\models\TravelCaseCollection;


interface ParserInterface
{
    public static function run($data): TravelCaseCollection;
}
