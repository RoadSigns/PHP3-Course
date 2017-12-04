<?php

    session_start();
    require('classes/Hangman.php');
    require('dumpr.php');

    // ERRORS
    //-----------------------------
    error_reporting(E_ALL & ~E_NOTICE);
    ini_set('display_errors', 1);

    // HANGMAN
    // Instantiate before any HTML, to allow for redirects
    // --------------------------------------------------------------

    $hangman = new Hangman;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="/learn/phpcourse/php3/hangman/styles.css">
</head>
<body>

<div id="hangman">

    <h1>Hangman</h1>
    <h2><?= $hangman->showWord() ?></h2>
    <div class='row'>
        <div class='col-xs-6'>
            <?= $hangman->displayImage();?>
        </div>
        <div class='col-xs-6'>
            <?php
                // Display hangman Object for debug
                dumpr($_SESSION['hangman'],0,0,0);
            ?>
        </div>
    </div>
    <?= $hangman->outputMessage() ?>
    <h3><?= $hangman->showAlphabet() ?></h3>
    <p><a href="?restart=true" class="btn">Restart</a></p>

</div>

</body>
</html>