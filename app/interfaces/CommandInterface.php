<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 15:28
 */

namespace NicholasMuestras\AllDifferentDirections\interfaces;


interface CommandInterface
{
    public function getName(): string;

    public function getValue(): float;

}
