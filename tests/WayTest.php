<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:15
 */

use NicholasMuestras\AllDifferentDirections\models\Way;
use NicholasMuestras\AllDifferentDirections\models\command\{StartCommand, WalkCommand, TurnCommand};


class WayTest extends PHPUnit\Framework\TestCase
{
    private $id = 'testWay';


    public function testCreate()
    {
        $way = new Way($this->id, 1, 1);

        $this->assertEquals($this->id, $way->getId());
    }


    public function testCreatingWayByCommandSequence()
    {
        $sequence = ['start' => 90, 'walk' => 100500, 'turn' => -45];
        $way = new Way('testWay', 3.2, -4);

        foreach ($sequence as $command => $value) {
            $way->createCommand($command, $value);
        }
//        todo update hash when class Way will be complete
//            throw new \PHPUnit\Framework\Exception(md5(serialize($way))); // For update control sum.
        $this->assertTrue(md5(serialize($way)) === 'a5bd84fa6bcb726e5cbd645c18f082ad', 'Control sum object wrong.');
    }


    public function testCreatingWayFromAddCommands()
    {
        $way = new Way('testWay', -1, 100500);
        $way->setHome(3.2, -4);
        $way->addCommand(new StartCommand(90));
        $way->addCommand(new WalkCommand(100500));
        $way->addCommand(new TurnCommand(-45));

        $this->assertTrue(md5(serialize($way)) === 'a5bd84fa6bcb726e5cbd645c18f082ad', 'Control sum object wrong.');
    }

}
