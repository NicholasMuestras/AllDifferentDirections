<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:38
 */

namespace app\models\command;

use app\interfaces\CommandInterface;


/**
 * Class CommandAbstract
 * @package app\models\command
 */
abstract class CommandAbstract implements CommandInterface
{
    /**
     * @var float
     */
    private $_value;

    /**
     * CommandAbstract constructor.
     * @param float $value
     */
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


    /**
     * @return string
     */
    public function getName(): string
    {
        $parts = explode('\\', get_called_class());
        $command = mb_eregi_replace('Command', '', array_pop($parts));
        $command = mb_convert_case($command, MB_CASE_LOWER, 'UTF-8');

        return $command;
    }

}
