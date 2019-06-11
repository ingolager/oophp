<?php

namespace Anax\View;

/**
 * Template file to render a view with content.
 */
?>

<form method="post">
    <fieldset>
    <legend>Skapa ny artikel</legend>

    <p>
        <label>Title:<br>
        <input type="text" name="contentTitle" default="A Title"/>
        </label>
    </p>

    <p>
        <button type="submit" name="doCreate"><i class="fa fa-plus" aria-hidden="true"></i> Skapa</button>
        <button type="reset"><i class="fa fa-undo" aria-hidden="true"></i> Reset</button>
    </p>
    </fieldset>
</form>
