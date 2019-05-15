<?php

namespace Inla18\Guess;

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
class GuessController implements AppInjectableInterface
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
        $this->app->session->set('game', new Guess());

        return $this->app->response->redirect("guess1/play");
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
        $title = "Play the game(1)";

        $data = [
            "guess" => $guess ?? null,
            "number" => $number ?? null,
            "tries" => $tries ?? null,
            "doGuess" => $doGuess ?? null,
            "doCheat" => $doCheat ?? null,
        ];

        $this->app->page->add("guess1/play", $data);
        // $this->app->page->add("guess/debug");

        return $this->app->page->render([
            "title" => $title,
        ]);
    }

    public function playActionPost() : object
    {
        $title = "Play the game(1)";

        $request = $this->app->request;

        $number = $request->getPost('number', null);
        $tries = $request->getPost('tries', null);
        $guess = $request->getPost('guess', null);
        $doInit = $request->getPost('doInit', null);
        $doGuess = $request->getPost('doGuess', null);
        $doCheat = $request->getPost('doCheat', null);


        if (!$this->app->session->get('game')) {
            $this->app->session->set('game', new Guess());
        }
        $game = $this->app->session->get('game');

        $number = $game->number();

        if ($doCheat || $doInit) {
            $res = -1;
        } else {
            $res = $game->makeGuess($guess);
        }

        if ($doInit || $number === null) {
            $this->app->session->destroy();
        }

        $data = [
            "guess" => $guess,
            "number" => $number,
            "tries" => $tries,
            "doGuess" => $doGuess,
            "doCheat" => $doCheat,
            "game" => $game,
            "res" => $res,
        ];

        $this->app->page->add("guess1/play", $data);
        // $this->app->page->add("guess/debug");

        // return $this->app->response->redirect("guess/play");

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
