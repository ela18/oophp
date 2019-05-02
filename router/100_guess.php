<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Init the game, redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // init the session for the game;
    $game = new Ela\Guess\Guess();
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();
    $_SESSION["doCheat"] =  null;

    return $app->response->redirect("guess/play");
});

/**
 * Play the game - show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";
    // Get current settings from the session
    $tries = $_SESSION["tries"] ?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $number = $_SESSION["number"];
    $doCheat = $_SESSION["doCheat"] ?? null;

    $_SESSION["res"] =  null;
    $_SESSION["guess"] =  null;

    $data = [
        "guess" => $guess ?? null,
        "tries" => $tries,
        "number" => $number ?? null,
        "res" => $res,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
    ];

    $app->page->add("guess/play", $data);
    // $app->page->add("guess/debug");

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Play the game - make a guess
 */
$app->router->post("guess/play", function () use ($app) {
    // Deal with incomming variables
    $guess = $_POST["guess"] ?? null;
    $doInit = $_POST["doInit"] ?? null;
    $doGuess = $_POST["doGuess"] ?? null;
    $doCheat = $_POST["doCheat"] ?? null;

    // Get current settings from the session
    $number = $_SESSION["number"] ?? null;
    $tries = $_SESSION["tries"] ?? null;

    if ($doGuess) {
    // Do a guess
        $game = new Ela\Guess\Guess($number, $tries);
        $res = $game->makeGuess($guess);
        $_SESSION["tries"] = $game->tries();
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }

    if ($doInit) {
        // Start a new game
        $game = new Ela\Guess\Guess();
        $_SESSION["number"] = $game->number();
        $_SESSION["tries"] = $game->tries();
        $_SESSION["doCheat"] =  null;
    }

    if ($doCheat) {
        $_SESSION["doCheat"] = $doCheat;
    }

    return $app->response->redirect("guess/play");
});
