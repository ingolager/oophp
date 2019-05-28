<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$resultset) {
    return;
}

?><table>
    <tr class="first">
        <th>Titel</th>
        <th>År</th>
        <th>Regissör</th>
        <th>Bild på regissören</th>

    </tr>
<?php $id = -1; foreach ($resultset as $row) :
    $id++; ?>
    <tr>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
        <td><?= $row->director ?></td>
        <td><img class="thumb" src="<?= url($row->image) ?>"></td>
    </tr>
<?php endforeach; ?>
</table>
