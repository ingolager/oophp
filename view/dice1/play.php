<?php
namespace Anax\View;

?><h1>Upp till 100 - controller version!</h1>

<form method="post">
    <input type='submit' name='roll' value='Kasta tärningarna'>
    <input type='submit' name='doInit' value='Nytt spel'>
    <input type='submit' name='savePoints' value='Lås in dina poäng'>
</form>

<?php if ($roll) :
    $res = $play->serie;
    ?>
    <table>
        <tr>
            <th>Människa</th>
            <th>Dator</th>
            <th>Histogram</th>
        </tr>
        <tr>
        <td>
            <?php foreach ($res as $value) : ?>
                <p class="dice-sprite dice-<?= $value ?>"></p>
            <?php endforeach; ?>
            <p>Din kastsumma är <?= $play->sumDice ?></p>
            <p>Du har <?= $play->partPoints(); ?> poäng att låsa in.</p>
            <p>Du har totalt <?= $play->total ?> poäng.</p>
            <!-- <?php var_dump(count(array_keys($play->addSerie, 1)) / count(array_filter($play->addSerie))); ?>
            <p><?php var_dump(count(array_keys($play->addSerie, 1))); ?><p>
            <p><?php var_dump(count(array_filter($play->addSerie))); ?><p> -->
        </td>
    <td>
        <?php
        if (in_array(1, $res)) :
            $mapped = $play->series;
            if ($mapped[0] !==null) {
                foreach ($mapped as $value) : ?>
                    <p class="dice-sprite dice-<?= $value ?>"></p>
                <?php endforeach; ?>
                <p>Datorns kastsumma är <?= $play->compSumDice() ?></p>
            <?php } else { ?>
                <p class="minheight"></p>
            <?php }
        endif;
        if (!in_array(1, $res)) : ?>
                <p class="minheight"></p>
                <p>Datorn har inte slagit.</p>
        <?php endif; ?>
                <p>Datorn väntar på ditt kast.</p>
                <p>Datorn har totalt <?= $play->compTotal(); ?> poäng.</p>
                <p><?= $play->compZero() ?></p>
            </td>
            <td>
                <pre><?php $histogram->getAsText() ?></pre>
            </td>
        </tr>
    </table>
<?php endif;
if ($savePoints) : ?>
    <table>
        <tr>
            <th>Människa</th>
            <th>Dator</th>
            <th>Histogram</th>
        </tr>
        <tr>
        <td>
            <p class="minheight"></p>
            <p>Du låste in dina poäng. </p>
            <p><?= $play->totalTrigger(); ?></p>
            <p>Det är din tur att kasta.</p>
            <p>Du har totalt <?= $play->totalPoints() ?> poäng.</p>
            <!-- <p><?php var_dump(count(array_filter($play->addSerie))); ?><p> -->
        </td>
<?php endif;
if ($savePoints) :
    $mapped = $play->series;
    ?>
        <td>
            <?php
            if ($mapped[0] !==null) {
                foreach ($mapped as $value) : ?>
                <p class="dice-sprite dice-<?= $value ?>"></p>
                <?php endforeach;
            } else { ?>
                <p class="minheight"></p>
            <?php } ?>
            <p>Datorns kaststumma är <?= $play->compSumDice() ?> poäng.</p>
            <p>Datorn väntar på ditt kast.</p>
            <p>Datorn har totalt <?= $play->compTotal() ?> poäng. </p>
            <p><?= $play->compZero() ?></p>
        </td>
        <td>
            <pre><?php $histogram->getAsText() ?></pre>
        </td>
    </tr>
    </table>
<?php endif;
if ($roll || $savePoints) : ?>
    <h2><?= $play->endMessage() ?></h2>
<?php endif;
