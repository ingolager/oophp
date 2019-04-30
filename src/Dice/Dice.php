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

    /**
    * Constructor to initiate the object with current game settings,
    * if available. Randomize the current number if no value is sent in.
    *
    * @param int $sides The result
    * @param int $throws  Number of throws
    */
    public function __construct(int $sides = 6)
    {
        $this->sides = $sides;
    }
    /**
     * Roll the dice
     * @return int represents the side of the rolled dice.
     */
    public function rollDice()
    {
        $this->sides = rand(1, 6);
        return $this->sides;
    }
}
