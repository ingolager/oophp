<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<h1>Svenska stumfilmer</h1>

<navbar class="movie-navbar">
    <a href="<?= url("movie") ?>">Visa alla filmer</a>
    <a href="<?= url("movie/search-title") ?>">Sök filmtitel</a>
    <a href="<?= url("movie/search-year") ?>">Sök filmår</a>
    <a href="<?= url("movie/select") ?>">Uppdatera databasen</a>
</navbar>
