<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:15
 */

use app\models\Way;
use app\models\command\{StartCommand, WalkCommand, TurnCommand};


/**
 * Class WayTest
 */
class WayTest extends PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    private $id = 'testWay';


    /**
     *
     */
    public function testCreate()
    {
        $way = new Way($this->id, 1, 1);

        $this->assertEquals($this->id, $way->getId());
    }


    /**
     * @throws Exception
     */
    public function testCreatingWayByCommandSequence()
    {
        $sequence = ['start' => 90, 'walk' => 100500, 'turn' => -45];
        $way = new Way('testWay', 3.2, -4);

        foreach ($sequence as $command => $value) {
            $way->createCommand($command, $value);
        }
//        todo update hash when class Way will be complete
//            throw new \PHPUnit\Framework\Exception(md5(serialize($way))); // For update control sum.
        $this->assertTrue(md5(serialize($way)) === '634baaefe730637c5192ddbf4e1946b1', 'Control sum object wrong.');
    }


    /**
     * @throws Exception
     */
    public function testCreatingWayFromAddCommands()
    {
        $way = new Way('testWay', -1, 100500);
        $way->setHome(3.2, -4);
        $way->addCommand(new StartCommand(90));
        $way->addCommand(new WalkCommand(100500));
        $way->addCommand(new TurnCommand(-45));

        $this->assertTrue(md5(serialize($way)) === '634baaefe730637c5192ddbf4e1946b1', 'Control sum object wrong.');
    }

}
