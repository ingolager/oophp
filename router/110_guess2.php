<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the the game and redirect to play the game.
 */
$app->router->get("guess2/init", function () use ($app) {
    $game = new Inla18\Guess\Guess();
    $_SESSION['number'] = $game->number();
    $_SESSION['number'] = $game->tries();
    return $app->response->redirect("guess2/play");
});

/**
 * Show the game page
 */
$app->router->get("guess2/play", function () use ($app) {
    $title = "Play the game(2)";
    $number     = $_SESSION['number'] ?? null;
    $res     = $_GET['res'] ?? null;
    $guess     = $_SESSION['guess'] ?? null;

    $_SESSION['res'] = null;
    $_SESSION['game'] = null;

    $data = [
        "game" => $guess ?? null,
        "number" => $number ?? null,
        "tries" => $tries ?? null,
        "res" => $res ?? null,
        "doCheat" => false,
    ];

    $app->page->add("guess2/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->get("guess2/cheat", function () use ($app) {
    $title = "Play the game(2)";
    $number     = $_SESSION['number'] ?? null;
    $tries     = $_SESSION['tries'] ?? null;

    $data = [
        "guess" => null,
        "number" => $number,
        "tries" => $tries,
        "doGuess" => $doGuess ?? null,
        "res" => null,
        "doCheat" => true,
    ];
});

/**
 * Play the game
 */
$app->router->post("guess2/play", function () use ($app) {

    $guess     = $_POST['guess'] ?? null;
    $number     = $_SESSION['number'] ?? null;
    $tries     = $_SESSION['tries'] ?? null;

    $game = new Inla18\Guess\Guess($number, $tries);
    $res = $game->makeGuess($guess);
    $_SESSION["tries"] = $game->tries;
    $_SESSION["res"] = $res;
    $_SESSION["guess"] = $guess;
    $_SESSION["doGuess"] = $doGuess;

    return $app->response->redirect("guess2/play");
});
