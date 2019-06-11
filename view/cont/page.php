<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<article>
    <header>
        <h1><?= esc($content->title) ?></h1>
        <p><i>Latest update: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
    </header>
    <p><?= $content->data ?></p>
</article>
