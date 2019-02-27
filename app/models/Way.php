<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:47
 */

namespace app\models;

use app\interfaces\CommandInterface;
use app\models\command\HomePoint;


/**
 * Class Way
 * @package app\models
 */
class Way implements \IteratorAggregate
{
    /**
     * @var string
     */
    private $_id;
    /**
     * @var
     */
    private $_commands;


    /**
     * Way constructor.
     * @param string $id
     * @param float $x
     * @param float $y
     */
    public function __construct(string $id, float $x, float $y)
    {
        $this->_id = $id;
        $this->setHome($x, $y);
    }


    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->_id;
    }


    /**
     * @param string $name
     * @param float $value
     * @throws \Exception
     */
    public function createCommand(string $name, float $value)
    {
        if (!$this->commandAcceptable($name)) {
            throw new \Exception("Command $name not acceptable.");
        }

        $commandClass = $this->interpretClassName($name);
        $this->_commands[] = new $commandClass($value);
    }

    /**
     * @param CommandInterface $command
     * @throws \Exception
     */
    public function addCommand(CommandInterface $command)
    {
        $name = $command->getName();

        if (!$this->commandAcceptable($name)) {
            throw new \Exception("Command $name not acceptable.");
        }

        $this->_commands[] = $command;
    }


    /**
     * @return \ArrayIterator
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->_commands);
    }


    /**
     * @param float $x
     * @param float $y
     */
    public function setHome(float $x, float $y)
    {
        $this->_commands[0] = new HomePoint($x, $y);
    }


    /**
     * @param string $name
     * @return bool
     */
    protected function commandAcceptable(string $name): bool
    {
        if (class_exists($this->interpretClassName($name))) {
            return true;
        }

        return false;
    }


    /**
     * @param string $string
     * @return string
     */
    protected function interpretClassName(string $string): string
    {
        $nameSpace = 'app\models\command'; // todo issue with dynamic namespace
        $className = \mb_convert_case($string, MB_CASE_TITLE, 'UTF-8') . 'Command';

        return $nameSpace . '\\' . $className;
    }

}
