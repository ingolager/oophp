<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the the game and redirect to play the game.
 */
$app->router->get("guess3/init", function () use ($app) {
    $game = new Inla18\Guess\Guess();
    return $app->response->redirect("guess3/play");
});

/**
 * Show the game page
 */
$app->router->get("guess3/play", function () use ($app) {
    $title = "Play the game(3)";

    $data = [
        "guess" => $guess ?? null,
        "number" => $number ?? null,
        "tries" => $tries ?? null,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess3/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game
 */
$app->router->post("guess3/play", function () use ($app) {
    $title = "Play the game(3)";

    $number     = $_POST['number'] ?? null;
    $tries     = $_POST['tries'] ?? null;
    $guess     = $_POST['guess'] ?? null;
    $doInit     = $_POST['doInit'] ?? null;
    $doGuess     = $_POST['doGuess'] ?? null;
    $doCheat    = $_POST['doCheat'] ?? null;

    if (!isset($_SESSION['game'])) {
        $_SESSION['game'] = new Inla18\Guess\Guess();
    }
    
    $game = $_SESSION["game"];

    $number = $game->number();

    if ($doInit || $number === null) {
        $game->sessionDestroy();
    }

    $data = [
        "guess" => $guess,
        "number" => $number,
        "tries" => $tries,
        "doGuess" => $doGuess,
        "doCheat" => $doCheat,
        "game" => $game,
    ];

    $app->page->add("guess3/play", $data);
    // $app->page->add("guess/debug");

    // return $app->response->redirect("guess/play");

    return $app->page->render([
        "title" => $title,
    ]);
});
