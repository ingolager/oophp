<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<form method="post">
    <fieldset>
    <legend>Uppdatera</legend>
    <input type="hidden" name="movieId" value="<?= esc($movie->id) ?>"/>

    <p>
        <label>Titel:<br>
        <input type="text" name="movieTitle" value="<?= esc($movie->title) ?>"/>
        </label>
    </p>

    <p>
        <label>År:<br>
        <input type="number" name="movieYear" value="<?= esc($movie->year) ?>"/>
    </p>

    <p>
        <label>Regissör:<br>
        <input type="text" name="movieDirector" value="<?= esc($movie->director) ?>"/>
    </p>

    <p>
        <label>Bild:<br>
        <input type="text" name="movieImage" value="<?= esc($movie->image) ?>"/>
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara">
    </p>
    <p class="movie-navbar">
        <a href="<?= url("movie/select") ?>">Uppdatera en annan film</a>
        <a href="<?= url("movie") ?>">Visa alla filmer</a>
    </p>
    </fieldset>
</form>
