<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:11
 */

namespace app\interfaces;

use app\models\TravelCaseCollection;


/**
 * Interface ParserInterface
 * @package app\interfaces
 */
interface ParserInterface
{
    /**
     * @param $data
     * @return TravelCaseCollection
     */
    public static function run($data): TravelCaseCollection;
}
