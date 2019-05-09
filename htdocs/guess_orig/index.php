<?php
/**
 * Gissa nummer.
 */
 require __DIR__ . "/autoload.php";
 require __DIR__ . "/config.php";

 // Inkommande variabler
 $number = $_POST["number"] ?? null;
 $tries = $_POST["tries"] ?? null;
 $guess = $_POST["guess"] ?? null;
 $doInit = $_POST["doInit"] ?? null;
 $doGuess = $_POST["doGuess"] ?? null;
 $doCheat = $_POST["doCheat"] ?? null;

session_name("game");
session_start();

if (!isset($_SESSION["guess"])) {
    $_SESSION["guess"] = new Guess();
}

$game = $_SESSION["guess"];
//$tries = $game->tries();
//$number = $game->number();

if ($doInit || $number === null) {
    newGame();
} elseif ($doGuess) {
    if ($game->tries() < 1) {
        newGame();
        $res = "Du har använt alla gissningar! Spelet startas om.";
    } else {
        $res = $game->makeGuess($guess);
    }
}

//Render page
require __DIR__ . "/view/guess_my_number.php";
//require __DIR__ . "/view/debug_session_post_get.php";


// Functions
function newGame()
{
    $_SESSION["guess"] = new Guess();
    $game = $_SESSION["guess"];

    $game->random();
    //$tries = $game->tries();
    //$number = $game->number();
}
