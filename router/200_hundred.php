<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("100-game/init", function () use ($app) {
    // init the dession for the gamestart.
    //$game = new Supe\Guess\Guess();

//    session_name("game");
//    session_start();

    //if (!isset($_SESSION["guess"])) {
    //    $_SESSION["guess"] = new Supe\Guess\Guess();
    //}


    //$game = $_SESSION["guess"];

    return $app->response->redirect("100-game/play");
});

$app->router->get("100-game/play", function () use ($app) {
    $title = "Play the 100 game";

    $app->page->add("100-game/play");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - show game status
 */


/**
 * Play the game - make a guess / start anew / cheat
 */
$app->router->post("100-game/play", function () use ($app) {




    return $app->response->redirect("100-game/play");
});
