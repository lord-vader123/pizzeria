<?php
session_start();

setcookie("login", '', time() - 3600, '/');
setcookie("password", '', time() - 3600, '/');

session_destroy();

header("Location: /pizzeria/index.php");
exit();
