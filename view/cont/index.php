<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

if (!$resultset) {
    return;
}
?>

<table>
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Publicerad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Borttagen</th>
        <th>Path</th>
        <th>Slug</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td class="time"><pre><?= $row->published ?></pre></td>
        <td class="time"><pre><?= $row->created ?></pre></td>
        <td class="time"><pre><?= $row->updated ?></pre></td>
        <td class="time"><pre><?= $row->deleted ?></pre></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
    </tr>
<?php endforeach; ?>
</table>
