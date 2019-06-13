<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

if (!$resultset) {
    return;
}
?>

<article>

<?php foreach ($resultset as $row) : ?>
<section>
    <header>
        <h2><a href="<?= url("cont/blog/$row->slug") ?>"><?= esc($row->title) ?></a></h2>
        <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
    </header>
    <p><?= $row->data ?></p>
<?php endforeach; ?>
</section>
</article>
