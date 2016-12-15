<?php
/*
    <link href="http://<?= $sHost ?>/apple-touch-icon.png" rel="apple-touch-icon" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-76.png" rel="apple-touch-icon" sizes="76x76" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-120.png" rel="apple-touch-icon" sizes="120x120" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-152.png" rel="apple-touch-icon" sizes="152x152" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-180.png" rel="apple-touch-icon" sizes="180x180" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-precomposed.png" rel="apple-touch-icon-precomposed" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-76-precomposed.png" rel="apple-touch-icon-precomposed" sizes="76x76" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-120-precomposed.png" rel="apple-touch-icon-precomposed" sizes="120x120" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-152-precomposed.png" rel="apple-touch-icon-precomposed" sizes="152x152" />
    <link href="http://<?= $sHost ?>/apple-touch-icon-180-precomposed.png" rel="apple-touch-icon-precomposed" sizes="180x180" />
    <link href="http://<?= $sHost ?>/icon-hires.png" rel="icon" sizes="192x192" />
    <link href="http://<?= $sHost ?>/icon-normal.png" rel="icon" sizes="128x128" />
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
favicon-32x32.png
*/
if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
    $protocol = 'https://';
}
else {
    $protocol = 'http://';
}
$sHost = $protocol . $_SERVER['HTTP_HOST'];
$sBaseUrl = $sHost . '/img/icons/';

/* <link rel="icon" type="image/png" sizes="32x32" href="<?= $sBaseUrl . 'ptichka-32.png' ?>"> */
?>

    <link href="<?= $sHost . '/favicon.ico' ?>" rel="shortcut icon" type="image/x-icon" />
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $sBaseUrl . 'blue-ptichka-32.ico' ?>">

