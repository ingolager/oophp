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
     * @var array  $values  Array consisting of last roll of the dices.
     * @var int $total Total sum of points
     * @var array $sum Holding the points during a players turn
     * @var int $trigger evaluates if total points will be added
     * @var
     * @var
     * @var
     */
    private $dices;
    private $values;
    public $total;
    private $sum;
    private $trigger;

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $dices Number of dices to create, defaults to five.
     */
    public function __construct(int $dices = 2, int $total = 0)
    {
        $this->dices  = [];
        $this->values = [];
        $this->sum = $this->values;
        $this->total = $total;
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
        if (in_array(1, $this->values())) {
            return 0;
        }
        return array_sum($this->values());
    }

    /**
     * Get the points to lock in during the game
     * @return int sum of throws that is not locked in.
     */

    public function partPoints()
    {
        array_push($this->sum, $this->sumDice());
        if (in_array(1, $this->values())) {
            $this->sum = [];
        }
        return array_sum($this->sum);
    }

    /**
     * calculates and dislpays total points of player
     * @return int sum of all partPoints()
     */

    public function totalPoints()
    {
        if ($this->trigger === 1) {
            $this->total += array_sum($this->sum);
            $this->sum = [];
            $this->trigger = 0;
            return $this->total;
        }
    }

    /**
     * evaluates if points will be added to $total
     * @return int default 0, if 1 points will be added to $total
     */

    public function totalTrigger()
    {
        $this->trigger = 1;
    }

    /**
     * The computers roll of dices
     * @return array with values of computers throw
     */

    public function computerRoll()
    {
        $this->values[0] = $this->dices[0]->rollDice();
        $this->values[1] = $this->dices[1]->rollDice();
        return [$this->values[0],
        $this->values[1]];
    }

    /**
     * Destroys all sesstion
     * @return void sets session to null.
     */


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
