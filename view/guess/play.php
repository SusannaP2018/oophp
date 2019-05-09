<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());



?><h1>Gissa mitt nummer!</h1>

<p>Gissa en siffra mellan 1 och 100, du har <?= $game->tries() ?> försök kvar.</p>

<form method="post">
    <input type="text" name="guess">
    <input type="hidden" name="number" value="<?= $number ?>">
    <input type="hidden" name="tries" value="<?= $tries ?>">
    <input type="submit" name="doGuess" value="Gissa">
    <input type="submit" name="doInit" value="Börja om">
    <input type="submit" name="doCheat" value="Fuska">
</form>

<?php if ($res) : ?>
    <p><?= $res ?></p>
<?php endif; ?>

<?php if ($doCheat) : ?>
    <p>FUSKA: Det aktuella numret är <?= $number ?>.</p>
<?php endif; ?>


 <pre>
<?=
var_dump($game);
?>
