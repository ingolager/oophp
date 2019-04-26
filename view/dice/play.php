<?php

namespace Anax\View;

?><h1>Upp till 100</h1>

<form method="post">
    <input type='submit' name='roll' value='Kasta tärningarna'>
    <input type='submit' name='savePoints' value='Lås in dina poäng'>
    <input type='submit' name='doInit' value='Nytt spel'>
</form>

<?php if ($roll) :
    $res = $play->values();
    ?>
    <table>
        <tr>
            <th>Människa</th>
            <th>Dator</th>
        </tr>
        <tr>
        <td>
            <?php foreach ($res as $value) : ?>
                <p class="dice-sprite dice-<?= $value ?>"></p>
            <?php endforeach; ?>
            <p>Din kastsumma är <?= $play->sumDice() ?></p>
            <p>Du har <?= $play->partPoints() ?> poäng att låsa in.</p>
            <p>Du har totalt <?= $play->total ?> poäng.</p>
            <p><?php var_dump($play->total) ?></p>
        </td>
<?php endif;
if ($roll) :
    $dator = $play->computerThrow();
    $strrepl = str_replace(", ", "", $dator);
    $tointreal = implode($strrepl);
    $nowint = (int) $tointreal;
    $mapped = array_map('intval', str_split($nowint));
    ?>
        <td>
            <?php foreach ($mapped as $value) :
                if ($value !==0) { ?>
                    <p class="dice-sprite dice-<?= $value ?>"></p>
                <?php } else { ?>
                    <p class="minheight"></p>
                <?php }
            endforeach; ?>
            <p>Datorns kastsumma är <?= $play->compSumDice() ?></p>
            <p>Datorn har totalt <?= $play->compTotal() ?> poäng.</p>
            <p>Datorn väntar på ditt kast.</p>
        </td>
        </tr>
    </table>
<?php endif;

if ($savePoints) : ?>
    <table>
        <tr>
            <th>Människa</th>
            <th>Dator</th>
        </tr>
        <tr>
        <td>
            <p>Du låste in dina poäng. </p>
            <p>Det är din tur att kasta.</p>
            <p>Du har totalt <?= $play->totalPoints($savePoints) ?> poäng.</p>

        </td>
<?php endif;
if ($savePoints) :
    $comp = $play->computerPlay();
    $strrepl = str_replace(", ", "", $comp);
    $tointreal = implode($strrepl);
    $nowint = (int) $tointreal;
    $mapped = array_map('intval', str_split($nowint)); ?>
        <td>
            <?php foreach ($mapped as $value) :
                if ($value !==0) { ?>
                    <p class="dice-sprite dice-<?= $value ?>"></p>
                <?php } else { ?>
                    <p class="minheight"></p>
                <?php }
            endforeach; ?>
            <p>Datorns kast gav <?= $play->compSumDice() ?> poäng.</p>
            <p>Datorn har totalt <?= $play->compTotal() ?> poäng. </p>

        </td>
    </table>
<?php endif;
if ($roll || $savePoints) : ?>
    <h2><?= $play->endMessage() ?></h2>
<?php endif;
