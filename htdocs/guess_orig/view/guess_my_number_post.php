<h1>Guess my number</h1>

<form method="post">
    <input type='text' name='guess' >
    <input type='hidden' name='number' value='<?= $number ?>'>
    <input type='hidden' name='tries' value='<?= $tries ?>'>
    <input type='submit' name='doGuess' value='Make a guess'>
    <input type='submit' name='doInit' value='Start from the beginning'>
    <input type='submit' name='doCheat' value='Cheat'>
</form>

<?php if ($doGuess) : ?>
    <p><?= $game->makeGuess($guess) ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>CHEAT: Current number is <?= $number ?></p>
<?php endif;
