<?php

namespace Inla18\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";
    //
    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "INDEX!!";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        $play = new DiceComputer();
        // $comp = new Inla18\Dice\DiceComputer();
        $this->app->session->destroy();
        $play->roll();
        $play->computerRoll();
        return $this->app->response->redirect("dice1/play");
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playActionGet() : object
    {
        $title = "Play the game (1)";

        $data = [
            "roll" => $roll ?? null,
            "savePoints" => $savePoints ?? null,
        ];

        $this->app->page->add("dice1/play", $data);
        // $app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }


    public function playActionPost() : object
    {
        $title = "Play the game (1)";

        $request = $this->app->request;

        $roll = $request->getPost('roll', null);
        $savePoints = $request->getPost('savePoints', null);
        $doInit = $request->getPost('doInit', null);

        if (!$this->app->session->get('play')) {
            $this->app->session->set('play', new DiceComputer());
        }
        $play = $this->app->session->get('play');

        if (!$savePoints) {
            $play->roll();
            $play->zeroCompRoll();
            $play->computerThrow();
        }

        if ($savePoints) {
            $play->zeroValue();
            $play->computerPlay();
        }

        // if ($roll) {
        //     $play->zeroCompRoll();
        // }

        // $res = $play->values();
        $sumDice = $play->sumDice();

        if ($doInit) {
            $this->app->session->destroy();
        }

        // $dice = new DiceHistogram();
        //
        // for ($i = 0; $i < 2; $i++) {
        //     $dice->roll();
        // }
        //
        $histogram = new Histogram();
        $histogram->injectData($play);


        // $dator = $play->computerThrow();
        // $strrepl = str_replace(", ", "", $dator);
        // $tointreal = implode($strrepl);
        // $nowint = (int) $tointreal;
        // $mapped = array_map('intval', str_split($nowint));
        //
        // $compDice = $play->compSumDice();

        $data = [
            "roll" => $roll,
            "play" => $play,
            "savePoints" => $savePoints,
            "histogram" => $histogram,
            // "res" => $res,
            // "sumDice" => $sumDice,
            // "mapped" => $mapped,
            // "compDice" => $compDice,
        ];

        $this->app->page->add("dice1/play", $data);
        // $app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my Game!!";
    }
}
