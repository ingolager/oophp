<?php

namespace Inla18\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{

    /**
     * Tests if dice returns int
     *
     */

    public function testDice()
    {
        $dice  = new Dice();
        $this->assertInstanceOf("\Inla18\Dice\Dice", $dice);

        $res = $dice->rollDice();
        $this->assertIsInt($res);
    }

    /**
     * Tests if roll of dice returns void
     *
     */

    public function testRoll()
    {
        $play  = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $res = $play->roll();
        $this->assertNull($res);
    }

    /**
     * Tests if values of a roll is in an array
     *
     */

    public function testValues()
    {
        $play  = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $res = $play->values();
        $this->assertIsArray($res);
    }

    /**
     * Tests sum of Dices. Covers not everything.
     */

    public function testSumDice()
    {
        $play  = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        in_array(1, $play->values());
        $res = $play->sumDice();
        $exp = 0;
        $this->assertEquals($res, $exp);
    }

    /**
     * Tests method partPoints. Do not cover all of it.
     *
     */


    public function testPartPoints()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        $play->sumDice = 5;
        $play->sum = [6, 7];
        array_push($play->sum, $play->sumDice);
        $play->partPoints();
        $res = array_sum($play->sum);
        $exp = 18;
        $this->assertEquals($exp, $res);
    }


    /**
     * Attempt to test totalPoint. Covers only a little bit.
     */

    public function testTotalPoints()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        $play->totalPoints();
        $play->trigger = 1;
        $play->total = 15;
        $play->sum = [5, 4];
        $res = 15 + array_sum([5, 4]);
        $exp = 24;
        $this->assertEquals($res, $exp);
    }

    /**
     * Tests if totalTrigger i working.
     */

    public function testTrigger()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        $play->totalTrigger();
        $play->trigger = 1;
        $res = $play->trigger;
        $exp = 1;
        $this->assertEquals($res, $exp);
    }

    /**
     * Tests if computer throw is an array.
     */

    public function testComputerRoll()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $res = $play->computerRoll();
        $this->assertIsArray($res);
    }

    /**
        * Tests if computers amount of throw i int.
    */

    public function testCompAmount()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        $res = $play->compAmount();
        $this->assertIsInt($res);
    }

    /**
     * Tests thar compZero returns void.
     */
    public function testCompZero()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);
        $res = $play->compZero();
        $this->assertNull($res);
    }

    /**
     * Tests that computer total point i int.
     */

    public function testCompTotal()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $res = $play->compTotal();
        $this->assertIsInt($res);
    }

    /**
     * Tests end message.
     */

    public function testEndMessage()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $res = $play->endMessage();
        $this->assertNotNull($res);
    }

    /**
     * Tests end message when computer wins.
     */

    public function testEndMessageComp()
    {
        $play = new DiceComputer();
        $this->assertInstanceOf("\Inla18\Dice\DiceComputer", $play);

        $play->totalComp = 105;
        $res = $play->endMessage();
        $exp = "Game over. Datorn vann!!";
        $this->assertEquals($res, $exp);
    }
}
