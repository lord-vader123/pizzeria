<?php
$server = "127.0.0.1";
$user = "root";
$password = "";
$db = "pizzeria";

$conn = new mysqli($server, $user, $password, $db) or die("Error connecting to database");
