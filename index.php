<?php
session_start();

define("__ROOT__", __DIR__);
$_SESSION['__ROOT__'] = __ROOT__;

if (isset($_SESSION['login']) && $_SESSION['password'] || isset($_COOCKIE['login']) && isset($_COOKIE['haslo'])) {
    header('Location: dashboard.php');
    exit();
}

?>
<!doctype html>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./style/style.css" />
    <link rel="icon" href="./assets/favico.ico">
    <title>Pizzeria - strona główna</title>
</head>

<body>

    <?php include_once __ROOT__ . '/snippets/header.php' ?>

    <main>
        <h2>O nas:</h2>
        <p>Nasza pizzeria… sraty taty</p>
    </main>

    <footer>
        <p>Nwm</p>
    </footer>
</body>

</html>
