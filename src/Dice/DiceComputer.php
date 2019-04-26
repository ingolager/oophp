<?php

namespace Inla18\Dice;

include_once(__DIR__ . "/Dice.php");
include_once(__DIR__ . "/DiceHand.php");

class DiceComputer extends DiceHand
{
    private $totalComp;
    private $runTime;
    private $throwOne;
    private $throwTwo;
    private $throwThree;

    public function __construct(int $runTime = 3)
    {
        parent::__construct();
        $this->totalComp = 0;
        $this->runTime = $runTime;
        $this->throwOne = 0;
        $this->throwTwo = 0;
        $this->throwThree = 0;
    }

    public function compAmount()
    {
        $this->runTimes = rand(1, 3);
        return $this->runTimes;
    }

    public function computerPlay()
    {
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

    public function computerThrow()
    {
        if (in_array(1, parent::values())) {
            return self::computerPlay();
        }
        return [null];
    }

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
    }

    public function compTotal()
    {
        $this->totalComp += self::compSumDice();
        return $this->totalComp;
    }

    public function endMessage()
    {
        if ($this->totalComp >= 100) {
            return "Game over. Datorn vann din loser.";
        } elseif (parent::totalPoints() >= 100) {
            return "Game over. Du besegrade datorn!!";
        }
        return "Människa vs maskin. Mycket spännande match!";
    }
}
