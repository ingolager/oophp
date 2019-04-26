<?php
/**
 * Create routes using $app programming style.
 */
/**
 * Init the the game and redirect to play the game.
 */

$app->router->get("dice/init", function () use ($app) {
    $play = new Inla18\Dice\DiceComputer();
    // $comp = new Inla18\Dice\DiceComputer();
    $play->sessionDestroy();
    return $app->response->redirect("dice/play");
});

/**
 * Show the game page
 */
$app->router->get("dice/play", function () use ($app) {
    $title = "Play the game";

    $data = [
        "roll" => $roll ?? null,
        "savePoints" => $savePoints ?? null,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game
 */
$app->router->post("dice/play", function () use ($app) {
    $title = "Play the game";

    $roll     = $_POST['roll'] ?? null;
    $savePoints   = $_POST['savePoints'] ?? null;
    $doInit     = $_POST['doInit'] ?? null;

    if (!isset($_SESSION['play'])) {
        $_SESSION['play'] = new Inla18\Dice\DiceComputer();
    }

    // if (!isset($_SESSION['comp'])) {
    //     $_SESSION['comp'] = new Inla18\Dice\DiceComputer();
    // }

    $play = $_SESSION["play"];
    // $comp = $_SESSION["comp"];
    $play->roll();

    if ($doInit) {
        $play->sessionDestroy();
    }

    $data = [
        "roll" => $roll,
        "play" => $play,
        "savePoints" => $savePoints,
        // "comp" => $comp,
    ];

    $app->page->add("dice/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("dice/process", function () use ($app) {
    $title = "Process";
    $_SESSION["roll"] = $_POST["roll"] ?? null;

    $_SESSION["savePoints"] = $_POST["savePoints"] ?? null;

    $_SESSION["doInit"] = $_POST["doInit"] ?? null;

    return $app->response->redirect("dice/play");
});
