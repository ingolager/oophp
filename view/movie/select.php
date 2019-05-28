<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());
//
?>
<form method="post">
    <fieldset>
    <legend>Filmväljare</legend>

    <p>
        <label><br>
        <select name="movieId">
            <option value="">Välj film...</option>
            <?php foreach ($movies as $movie) : ?>
            <option value="<?= $movie->id ?>"><?= $movie->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Ny film">
        <input type="submit" name="doEdit" value="Redigera">
        <input type="submit" name="doDelete" value="Ta bort">
    </p>
    <p class="movie-navbar"><a href="<?= url("movie") ?>">Visa alla filmer</a></p>
    </fieldset>
</form>
