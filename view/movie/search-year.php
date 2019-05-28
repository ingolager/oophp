<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<form method="get">
    <fieldset>
    <legend>Sök år</legend>
    <input type="hidden" name="route" value="search-year">
    <p>
        <label>Visa filmer mellan år
        <input type="number" name="year1" value="<?= esc($year1) ?: 1890 ?>" min="1890" max="1940"/>
        och
        <input type="number" name="year2" value="<?= esc($year2) ?: 1940 ?>" min="1890" max="1940"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    <p class="movie-navbar"><a href="<?= url("movie") ?>">Visa alla filmer</a></p>
    </fieldset>
</form>
