<?php

namespace Inla18\Dice;

include_once(__DIR__ . "/Dice.php");
include_once(__DIR__ . "/DiceComputer.php");

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices   Array consisting of dices.
     * @var int  $values  Array consisting of last roll of the dices.
     */
    private $dices;
    public $values;
    private $sum;
    public $total;
    private $totalComp;
    private $runTime;
    private $throwOne;
    private $throwTwo;
    private $throwThree;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 2, int $runTime = 3)
    {
        $this->dices  = [];
        $this->values = [];
        $this->sum = $this->values;
        $this->totalComp = 0;
        $this->runTime = $runTime;
        $this->throwOne = 0;
        $this->throwTwo = 0;
        $this->throwThree = 0;


        for ($i = 0; $i < $dices; $i++) {
            $this->dices[]  = new Dice();
            $this->values[] = null;
        }
    }

    /**
     * Roll all dices save their value.
     *
     * @return void.
     */
    public function roll()
    {
        $this->values[0] = $this->dices[0]->rollDice();
        $this->values[1] = $this->dices[1]->rollDice();
    }


    /**
     * Get values of dices from last roll.
     *
     * @return array with values of the last roll.
     */
    public function values()
    {
        return [$this->values[0],
                $this->values[1]];
    }

    /**
    * Get the sum of all dices.
    *
    * @return int as the sum of all dices.
    */
    public function sumDice()
    {
        $this->throwOne = null;
        $this->throwTwo = null;
        $this->throwThree = null;
        if (in_array(1, $this->values())) {
            return 0;
        }
        return array_sum($this->values());
    }

    public function partPoints()
    {
        array_push($this->sum, $this->sumDice());
        if (in_array(1, $this->values())) {
            $this->sum = [];
        }
        return array_sum($this->sum);
    }

    public function totalPoints()
    {
        $this->total += array_sum($this->sum);
        $this->sum = [];
        return $this->total;
    }

    public function computerRoll()
    {
        $this->values[0] = $this->dices[0]->rollDice();
        $this->values[1] = $this->dices[1]->rollDice();
        return [$this->values[0],
        $this->values[1]];
    }

    public function sessionDestroy()
    {
        $_SESSION = [];

        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }
        session_destroy();
    }
}
