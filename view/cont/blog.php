<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<article>
    <header>
        <h2><?= esc($content->title) ?></h2>
        <p><i>Published: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
    </header>
    <?= $content->data ?>
</article>
