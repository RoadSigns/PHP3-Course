<?php
    include './classes/QRCode.php';

    $qr = new QRCode();
    $qrcode = $qr->generateQRCode();

    echo "<img src='$qrcode' />";

    echo "<pre>";
        var_dump($qr);
    echo "</pre>";

    echo '<hr>';

    $qr = new QRCode();
    $qr->setSize(400);
    $qr->setContent('Chris Maggs');
    $qrcode = $qr->generateQRCode();

    echo "<img src='$qrcode' />";

    echo "<pre>";
        var_dump($qr);
    echo "</pre>";

    echo '<hr>';