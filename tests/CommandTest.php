<?php
/**
 * Created by PhpStorm.
 * User: Nicholas Muestras
 * Date: 16.02.2019
 * Time: 21:15
 */

use app\models\command\HomePoint;


class CommandTest extends PHPUnit\Framework\TestCase
{

    public function testHome()
    {
        $x = 1;
        $y = 2.5;
        $command = new HomePoint($x, $y);

        $this->assertEquals([$x, $y], [$command->getX(), $command->getY()]);
    }


    public function testCommands()
    {
        $vocabulary = ['Start', 'Turn', 'Walk'];

        foreach ($vocabulary as $word) {
            $className = 'app\models\command\\' . $word . 'Command';
            $command = new $className(25.5);

            $this->assertEquals(25.5, $command->getValue());
        }
    }

}
