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
        <th>Publicerad</th>
        <th>Skapad</th>
        <th>Uppdaterad</th>
        <th>Borttagen</th>
        <th>Ändra</th>
    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td class="time"><pre><?= $row->published ?></pre></td>
        <td class="time"><pre><?= $row->created ?></pre></td>
        <td class="time"><pre><?= $row->updated ?></pre></td>
        <td class="time"><pre><?= $row->deleted ?></pre></td>
        <td>

            <a class="icons" href="<?= url("cont/edit?id=$row->id") ?>">
                <i class="fa fa-pen" aria-hidden="true"></i>
            </a>
            <a class="icons" href="<?= url("cont/delete?id=$row->id") ?>">
                <i class="fa fa-trash-alt" aria-hidden="true"></i>
            </a>
        </td>
    </tr>
<?php endforeach; ?>
</table>
