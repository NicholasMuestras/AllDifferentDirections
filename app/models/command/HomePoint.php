<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 16:26
 */

namespace NicholasMuestras\AllDifferentDirections\models\command;

use NicholasMuestras\AllDifferentDirections\interfaces\CommandInterface;


class HomePoint implements CommandInterface
{
    private $_x;
    private $_y;

    /**
     * @param float $x
     * @param float $y
     */
    public function __construct(float $x, float $y)
    {
        $this->_x = $x;
        $this->_y = $y;
    }

    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->_x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->_y;
    }


    public function getName(): string
    {
        return 'home';
    }

    /**
     * Implement interface only.
     */
    public function getValue(): float
    {
        return 0;
    }

}
