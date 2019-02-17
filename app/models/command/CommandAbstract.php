<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:38
 */

namespace NicholasMuestras\AllDifferentDirections\models\command;

use NicholasMuestras\AllDifferentDirections\interfaces\CommandInterface;


abstract class CommandAbstract implements CommandInterface
{
    private $_value;

    public function __construct(float $value)
    {
        $this->_value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->_value;
    }


    public function getName(): string
    {
        $parts = explode('\\', get_called_class());
        $command = mb_eregi_replace('Command', '', array_pop($parts));
        $command = mb_convert_case($command, MB_CASE_LOWER, 'UTF-8');

        return $command;
    }

}
