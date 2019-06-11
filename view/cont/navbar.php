<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<h1>Content</h1>

<navbar class="movie-navbar">
    <a href="<?= url("cont") ?>">Visa innehållet</a>
    <a href="<?= url("cont/admin") ?>">Admin</a>
    <a href="<?= url("cont/create") ?>">Skapa nytt</a>
    <a href="<?= url("cont/pages") ?>">Pages</a>
    <a href="<?= url("cont/blogg") ?>">Blog</a>
</navbar>
