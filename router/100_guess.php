<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the dession for the gamestart.
    //$game = new Supe\Guess\Guess();

    session_name("game");
    session_start();

    //if (!isset($_SESSION["guess"])) {
        $_SESSION["guess"] = new Supe\Guess\Guess();
    //}
    newGame();

    //$game = $_SESSION["guess"];

    return $app->response->redirect("guess/play");
});



/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    // Incoming variables
    // $guess = $_POST["guess"] ?? null;
    // $doInit = $_POST["doInit"] ?? null;
    // $doGuess = $_POST["doGuess"] ?? null;
    // $doCheat = $_POST["doCheat"] ?? null;
    //
    // $number = $_POST["number"] ?? null;
    $tries = $_POST["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;



    //$_SESSION["guess"] = null;
    //$_SESSION["res"] = null;

// if ($doGuess) {
//     if ($game->tries() < 1) {
//         newGame();
//         $res = "Du har använt alla gissningar! Spelet startas om.";
//     } else {
//         $res = $game->makeGuess($guess);
// }}

    $data = [
        "guess" => $guess ?? null,
        "res" => $res,
        "triesleft" => 8,
        "tries" => $_POST["tries"] ?? null,
        "number" => $number ?? null,
        "doCheat" => $doCheat ?? null,
        "doGuess" => $doGuess ?? null,
        "game" => $_SESSION["guess"]
    ];

    $app->page->add("guess/play", $data);
    //$app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});

/**
 * Play the game - make a guess / start anew / cheat
 */
$app->router->post("guess/play", function () use ($app) {

    // Incoming variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    $number = $_POST["number"] ?? null;
    $tries = $_SESSION["guess"] ?? null;
    $res = null;
    $game = $_SESSION["guess"];

    if ($doGuess) {
        if ($game->tries() < 1) {
            newGame();
            $res = "Du har använt alla gissningar! Ett nytt spel har startats.";
            $_SESSION["res"] = $res;
        } else {
            $res = $game->makeGuess($guess);
            $_SESSION["res"] = $res;
        }
    } elseif ($doInit) {
        newGame();
        $res = "Ett nytt spel har startats.";
        $_SESSION["res"] = $res;
    } elseif ($doCheat) {
        $res = "Det aktuella numret är ".$game->number().".";
        $_SESSION["res"] = $res;
    }


    return $app->response->redirect("guess/play");
});



// Functions
function newGame()
{
    $_SESSION["guess"] = new Supe\Guess\Guess();
    $game = $_SESSION["guess"];

    $game->random();
    //$tries = $game->tries();
    //$number = $game->number();
}
