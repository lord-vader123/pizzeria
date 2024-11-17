<?php
if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) {
    if (!isset($_COOKIE['login']) && !isset($_COOKIE['password'])) {
        header("Location: /index.php");
        exit();
    }
    $_SESSION['login'] = $_COOKIE['login'];
    $_SESSION['password'] = $_COOKIE['password'];
}
