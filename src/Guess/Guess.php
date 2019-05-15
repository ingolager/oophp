<?php
/**
 * File with class Guess.
 */

namespace Inla18\Guess;

/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
include(__DIR__ . "/GuessException.php");


/**
 * Guess my number, a class supporting the game..
 */

class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    public $tries;
    public $number;


    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */

    public function __construct(int $tries = 6)
    {
        $this->number = rand(1, 100);
        $this->tries = $tries;
    }

    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */

    public function number()
    {
        return $this->number;
    }

    public function tries()
    {
        return $this->tries;
    }

    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     *
     * @throws GuessException when guessed number is out of bounds.
     *
     * @param int $guess, incoming guess of hidden number.
     *
     * @return string to show the status of the guess made.
     */

    public function makeGuess(int $guess)
    {
        while ($this->tries > 0) {
            if (!(is_int($guess) && $guess > 0 && $guess <= 100)) {
                throw new GuessException("Försök igen med ett tal från 1 till 100!");
            } else {
                if ($guess === $this->number) {
                    $res = 'Your guess ' . $guess . ' is <b>CORRECT.</br> START A NEW GAME!</b>';
                    return $res;
                } elseif ($guess < $this->number) {
                    $this->tries -= 1;
                    $res = 'Your guess ' . $guess . ' is <b>TOO LOW</b>';
                    return $res;
                } else {
                    $this->tries -= 1;
                    $res = 'Your guess ' . $guess . ' is <b>TOO HIGH</b>';
                    return $res;
                }
            }
        }
        $res = '<b>GAME OVER! YOU LOST!</b>';
        return $res;
    }

    /**
     * Destroys game session.
     */

    // public function sessionDestroy()
    // {
    //     $_SESSION = [];
    //
    //     if (ini_get("session.use_cookies")) {
    //         $params = session_get_cookie_params();
    //         setcookie(
    //             session_name(),
    //             '',
    //             time() - 42000,
    //             $params["path"],
    //             $params["domain"],
    //             $params["secure"],
    //             $params["httponly"]
    //         );
    //     }
    //     session_destroy();
    // }
}
