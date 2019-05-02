<?php

namespace Anax\View;

/**
 * Render content within the game "Guess my number".
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?><h2>Play the game</h2>

<p>Guess a number between 1 and 100, you have <?= $tries ?> tries left</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess"
    <?php if ($tries <= 0 || $guess == $number) {
        echo 'disabled';
    } ?>>
    <input type="submit" name="doInit" value="Start a new game">
    <input type="submit" name="doCheat" value="Cheat">
</form>


<?php if ($res) : ?>
    <?php if ($tries <= 0) : ?>
        <p><h3>No guesses left! Start a new game.</h3></p>
    <?php else : ?>
        <p>Your guess <?= $guess ?> is <?= $res ?></p>
    <?php endif; ?>
<?php endif; ?>


<?php
if ($doCheat) : ?>
    <p>The current number to guess is <?= $number ?></p>
<?php endif; ?>
