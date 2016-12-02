<?php

// mission-part

/* @var $this yii\web\View */
/* @var $isUp boolean  сверху от линии */
/* @var $imagesrc string картинка в кружке */
/* @var $text string текст блока */

if(  !isset($isUp) ) {
    $isUp = true;
}

$sBall = '<div class="sphere-ball-block" style="top: ' . ($isUp ? '144px;' : '-16px;') . '; "></div>';
$sLine = '<div class="sphere-line-block"></div>';

/*  vertical-align: <?= $isUp ? 'bottom;' : 'top' ?>; */
/*  border: 1px solid #cccccc; width: 146px; */
?>

<table>
    <tr>
        <td style="position: relative; width: 146px; vertical-align: top;">
            <?= $isUp ? '' : ($sBall . $sLine) ?>
            <div class="sphere-block" style="background: transparent url(<?= $imagesrc ?>) 50% 50% no-repeat;"></div>
            <?= $isUp ? ($sLine . $sBall) : '' ?>
        </td>
        <td style="width: 24px;"></td>
        <td valign="center;" style="max-width: 250px;">
            <?= $text ?>
        </td>
    </tr>
</table>

<?php
/*
<div class="row">
    <div class="col-sm-3" style="position: relative;">
        <?= $isUp ? '' : ($sBall . $sLine) ?>
        <div class="sphere-block" style="background: transparent url(<?= $imagesrc ?>) 50% 50% no-repeat;"></div>
        <?= $isUp ? ($sLine . $sBall) : '' ?>
    </div>
    <div class="col-sm-7">
        <?= $text ?>
    </div>
</div>

*/
