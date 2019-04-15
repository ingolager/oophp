<?php
/**
 * file for starting the game
 */
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

// Deal with incoming variables
$number     = $_POST['number'] ?? null;
$tries     = $_POST['tries'] ?? null;
$guess     = $_POST['guess'] ?? null;
$doInit     = $_POST['doInit'] ?? null;
$doGuess     = $_POST['doGuess'] ?? null;
$doCheat    = $_POST['doCheat'] ?? null;

session_start();
if (!isset($_SESSION['game'])) {
    $_SESSION['game'] = new Guess();
}
$game = $_SESSION["game"];
$number = $game->number();

if ($doInit) {
    $game->sessionDestroy();
}

require __DIR__ . "/view/guess_my_number_post.php";
