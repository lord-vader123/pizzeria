<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);
include_once __ROOT__ . '/php/login-mysql.php';
include_once __ROOT__ . '/php/check-logged.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css">
    <link rel="icon" href="./assets/favico.ico">
    <title>Strona główna - <?php echo $_COOKIE['login']; ?></title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header-logged.php'; ?>


</body>

</html>
