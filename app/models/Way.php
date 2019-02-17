<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:47
 */

namespace NicholasMuestras\AllDifferentDirections\models;

use NicholasMuestras\AllDifferentDirections\interfaces\CommandInterface;
use NicholasMuestras\AllDifferentDirections\models\command\HomePoint;


class Way implements \IteratorAggregate
{
    private $_id;
    private $_commands;


    public function __construct(string $id, float $x, float $y)
    {
        $this->_id = $id;
        $this->setHome($x, $y);
    }


    public function getId(): string
    {
        return $this->_id;
    }


    public function createCommand(string $name, float $value)
    {
        if (!$this->commandAcceptable($name)) {
            throw new \Exception("Command $name not acceptable.");
        }

        $commandClass = $this->interpretClassName($name);
        $this->_commands[] = new $commandClass($value);
    }

    public function addCommand(CommandInterface $command)
    {
        $name = $command->getName();

        if (!$this->commandAcceptable($name)) {
            throw new \Exception("Command $name not acceptable.");
        }

        $this->_commands[] = $command;
    }


    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->_commands);
    }


    public function setHome(float $x, float $y)
    {
        $this->_commands[0] = new HomePoint($x, $y);
    }


    protected function commandAcceptable(string $name): bool
    {
        if (class_exists($this->interpretClassName($name))) {
            return true;
        }

        return false;
    }


    protected function interpretClassName(string $string): string
    {
        $nameSpace = 'NicholasMuestras\AllDifferentDirections\models\command'; // todo issue with dynamic namespace
        $className = \mb_convert_case($string, MB_CASE_TITLE, 'UTF-8') . 'Command';

        return $nameSpace . '\\' . $className;
    }

}
