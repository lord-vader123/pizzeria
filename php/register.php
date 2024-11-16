<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);

include_once __ROOT__ . '/php/login-mysql.php';
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
    <?php include_once __ROOT__ . '/snippets/header.php'; ?>
    
    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <label for="imie">Podaj imię</label>
            <input type="text" name="imie" id="imie">

            <label for="nazwisko">Podaj nazwisko</label>
            <input type="text" name="nazwisko" id="nazwisko">

            <label for="login">Podaj login, którym będziesz się logować</label>
            <input type="text" name="login" id="login">

            <label for="haslo">Podaj hasło</label>
            <input type="password" name="haslo" id="haslo">

            <label for="haslo2">Powtórz hasło</label>
            <input type="password" name="haslo2" id="haslo2">

            <label for="plec">Podaj swoją płeć</label>
            <label for="chop">Mężczyzna</label>
            <input type="radio" name="plec" id="chop">
            <label for="baba">Kobieta</label>
            <input type="radio" name="baba" id="baba">

            <label for="zdjecie">Podaj obrazek profilowy</label>
            <input type="file" name="zdjecie" id="zdjecie">

            <label for="ulica">Podaj ulicę</label>
            <input type="text" name="ulica" id="ulica">

            <label for="dom">Podaj numer domu</label>
            <input type="number" name="dom" id="dom">

            <label for="mieszkanie">Podaj numer mieszkania</label>
            <input type="number" name="mieszkanie" id="mieszkanie">
            
            <label for="kod">Podaj kod pocztowy</label>
            <input type="text" name="kod" id="kod">

            <button type="reset">Wyczyć</button>
            <button type="submit">Zatwierdź</button>

            
        </form>
    </main>


</body>
