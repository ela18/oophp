<h1>Guess my number</h1>

<p>Guess a number between 1 and 100, you have <?= $_SESSION["tries"] ?> tries left</p>

<form method="post">
    <input type="text" name="guess">
    <input type="submit" name="doGuess" value="Make a guess">
    <input type="submit" name="doInit" value="Start a new game">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doGuess) : ?>
    <?php if ($_SESSION["tries"] <= 0) : ?>
        <p><h3>No guesses left! Start a new game.</h3></p>
    <?php else : ?>
        <p>Your guess <?= $guess ?> is <?= $res ?></p>
    <?php endif; ?>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>The current number to guess is <?= $number ?></p>
<?php endif; ?>
