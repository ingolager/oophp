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
     *
     * @var int $tries    Number of throws.
     */
    protected $sides;
    private $values;

    /**
    * Constructor to initiate the object with current game settings,
    * if available. Randomize the current number if no value is sent in.
    *
    * @param int $sides Number of sides
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
        $this->values = rand(1, 6);
        return $this->values;
    }

    public function compDice()
    {
        $this->compValues = rand(1, 6);
        return $this->compValues;
    }
}
