<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<form method="get">
    <fieldset>
    <legend>Sök filmtitel</legend>
    <input type="hidden" name="route" value="search-title">
    <p>
        <label>Titel (använd % som jokertecken)
            <input type="search" name="searchTitle" value="<?= esc($searchTitle) ?>"/>
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    <p class="movie-navbar"><a href="<?= url("movie") ?>">Visa alla filmer</a></p>
    </fieldset>
</form>
