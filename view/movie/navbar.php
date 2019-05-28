<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<navbar class="navbar">
    <a href="?route=select">SELECT *</a> |
    <br>
    <a href="<?= url("movie") ?>">Show all movies</a> |
    <!-- <a href="?route=reset">Reset database</a> | -->
    <a href="<?= url("movie/search-title") ?>">Search title</a> |
    <a href="<?= url("movie/search-year") ?>">Search year</a> |
    <a href="<?= url("movie/select") ?>">Select</a> |
    <!-- <a href="<?= url("movie/edit") ?>">Edit</a> | -->
    <!-- <a href="?route=show-all-sort">Show all sortable</a> |
    <a href="?route=show-all-paginate">Show all paginate</a> | -->
</navbar>

<h1>My Movie Database</h1>
