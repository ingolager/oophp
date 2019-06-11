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
        <th>Typ</th>
        <th>Status</th>
        <th>Publicerad</th>
        <th>Raderad</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><a href="<?= url("cont/page/$row->slug") ?>"><?= $row->title ?></a></td>
        <td><?= $row->type ?></td>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->deleted ?></td>
    </tr>
<?php endforeach; ?>
</table>
