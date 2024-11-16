<?php

define("root", __DIR__);

if (isset($_SESSION['id']) || isset($_COOCKIE['login']) && isset($_COOKIE['haslo'])) {
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
    <title>Pizzeria - strona główna</title>
</head>

<body>

    <?php include_once __DIR__ . '/snippets/header.html' ?>

    <main>
        <h2>O nas:</h2>
        <p>Nasza pizzeria… sraty taty</p>
    </main>

    <footer>
        <p>Nwm</p>
    </footer>
</body>

</html>
