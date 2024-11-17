<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);

include_once __ROOT__ . '/php/login-mysql.php';

if ((isset($_SESSION['login']) && isset($_SESSION['password'])) || (isset($_COOKIE['login']) && isset($_COOKIE['password']))) {
    $logged = true;
}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css" />
    <link rel="stylesheet" href="/pizzeria/style/galeria.css">
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Galeria</title>
</head>

<body>
    <?php if ($logged) {
        include_once __ROOT__ . '/snippets/header-logged.php';
    } else {
        include_once __ROOT__ . '/snippets/header.php';
    } ?>

    <main>
        <div class="gallery-container">
            <div class="arrow left-arrow" id="prev">&#10094;</div>
            <div class="gallery-images" id="gallery-images"></div>
            <div class="arrow right-arrow" id="next">&#10095;</div>
        </div>
    </main>

    <script src="/pizzeria/js/gallery.js"></script>
</body>

</html>
