<?php

namespace Inla18\Dice;

/**
 * File with class Dice.
 */

include_once(__DIR__ . "/DiceHand.php");
include_once(__DIR__ . "/DiceComputer.php");

class Dice
{
    /**
     * @var int $sides   number of sides on dice.
     * @var int $tries    Number of throws.
     */
    private $sides;
    private $throws;

    /**
    * Constructor to initiate the object with current game settings,
    * if available. Randomize the current number if no value is sent in.
    *
    * @param int $sides The result
    * @param int $throws  Number of throws
    */

    public function __construct(int $sides = 6, int $throws = 0)
    {
        $this->sides = $sides;
        $this->throws = $throws;
    }

    public function rollDice()
    {
        $this->sides = rand(1, 6);
        return $this->sides;
    }

    public function throw()
    {
        return $this->rollDice();
    }
}
