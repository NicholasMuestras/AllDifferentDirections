<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 15:28
 */

namespace app\interfaces;


/**
 * Interface CommandInterface
 * @package app\interfaces
 */
interface CommandInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return float
     */
    public function getValue(): float;

}
