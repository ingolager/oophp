<?php

namespace Inla18\Dice;

include_once(__DIR__ . "/DiceHand.php");

/**
 * A graphic dice.
 */
class DiceGraphic extends Dice
{
    /**
     * @var integer SIDES Number of sides of the Dice.
     */
    const SIDES = 6;

    /**
     * Constructor to initiate the dice with six number of sides.
     */
    public function __construct()
    {
        parent::__construct(self::SIDES);
    }

    /**
    * Get a graphic value of the last rolled dice.
    *
    * @return string as graphical representation of last rolled dice.
    *
    */

    public function numbers()
    {
        return parent::values();
    }
}
