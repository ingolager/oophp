<?php

namespace Inla18\Dice;

include_once(__DIR__ . "/DiceHand.php");

/**
 * File that controls the computers throws
 */

class DiceComputer extends DiceHand
{
    /**
     * Private variables of DiceComputer class
     * @var int $totalComp holds computers total points
     * @var int $runTime holds number of throws
     * @var int $throwOne hold sum of first throw
     * @var int $throwTwo hold sum of second throw
     * @var int $throwThree hold sum of third throw
     */
    public $totalComp;
    private $runTime;
    private $throwOne;
    private $throwTwo;
    private $throwThree;

    /**
     * Constructor of class Dice Computer
     * @param integer $runTime default number of throws
     */

    public function __construct(int $runTime = 3)
    {
        parent::__construct();
        $this->totalComp = 0;
        $this->runTime = $runTime;
        $this->throwOne = 0;
        $this->throwTwo = 0;
        $this->throwThree = 0;
    }

    /**
     * Determines number of throws
     * @return int number of throws
     */

    public function compAmount()
    {
        $this->runTimes = rand(1, 3);
        return $this->runTimes;
    }

    /**
     * Plays when human locks in points
     * @return array array with computers throw set
     */

    public function computerPlay()
    {
        if ($this->total < 100) {
            $this->runTime = self::compAmount();
            $this->throwOne = implode(", ", parent::computerRoll());
            $this->throwTwo = implode(", ", parent::computerRoll());
            $this->throwThree = implode(", ", parent::computerRoll());
            if ($this->runTime === 1) {
                $res = [$this->throwOne];
                return $res;
            } elseif ($this->runTime === 2) {
                if (strpos($this->throwOne, "1") !== false) {
                    $res = [$this->throwOne];
                    return $res;
                }
                $res = [$this->throwOne, $this->throwTwo];
                return $res;
            } else {
                if (strpos($this->throwOne, "1") !== false) {
                    $res = [$this->throwOne];
                    return $res;
                } elseif (strpos($this->throwTwo, "1") !== false) {
                    $res = [$this->throwOne, $this->throwTwo];
                    return $res;
                }
                $res = [$this->throwOne, $this->throwTwo, $this->throwThree];
                return $res;
            }
        }
        return [0];
    }

    /**
     * Computer plays when human throws 1.
     * @return array array with computers throw set
     */

    public function computerThrow()
    {
        if (in_array(1, parent::values())) {
            return self::computerPlay();
        }
        return [null];
    }

    /**
     * Calculates sum of computer set of throws
     * @return int sum of throws
     */

    public function compSumDice()
    {
        if ($this->runTime === 1) {
            if ((strpos($this->throwOne, "1") !== false)) {
                return 0;
            }
            return array_sum(explode(', ', $this->throwOne));
        } elseif ($this->runTime === 2) {
            if ((strpos($this->throwOne, "1") !== false || strpos($this->throwTwo, "1") !== false)) {
                return 0;
            }
            return array_sum(explode(', ', $this->throwOne))
                + array_sum(explode(', ', $this->throwTwo));
        } else {
            if ((strpos($this->throwOne, "1") !== false || strpos($this->throwTwo, "1") !== false || strpos($this->throwThree, "1") !== false)) {
                return 0;
            }
            return array_sum(explode(', ', $this->throwOne))
            + array_sum(explode(', ', $this->throwTwo))
            + array_sum(explode(', ', $this->throwThree));
        }
        return 0;
    }

    /**
     * Sets computers throw set to 0 after throw.
     * @return void set to 0.
     */

    public function compZero()
    {
        $this->throwOne = 0;
        $this->throwTwo = 0;
        $this->throwThree = 0;
    }

    /**
     * Holding total points of comuper
     * @return int adds new point to total points
     */

    public function compTotal()
    {
        $this->totalComp += self::compSumDice();
        return $this->totalComp;
    }

    /**
     * Message displayed at end of game.
     * @return string end message
     */

    public function endMessage()
    {
        if ($this->totalComp >= 100) {
            return "Game over. Datorn vann!!";
        } elseif ($this->total >= 100) {
            return "Game over. Du besegrade datorn!!";
        }
        return "Människa vs maskin. Mycket spännande match!";
    }
}
