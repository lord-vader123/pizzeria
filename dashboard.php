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
    <main>
        <article>
            <header>
                <h1>Witaj na stronie głównej, <?php echo $_COOKIE['login']; ?>! 🎉</h1>
            </header>

            <section>
                <h2>🍕 Twoje Ulubione Pizze 🍕</h2>
                <p>Na tej stronie będziesz mógł śledzić wszystkie <strong>ulubione</strong> pizze, które zamówiłeś, oraz nowe <i>smaki</i>, które czekają na odkrycie! Nie ma nic lepszego niż zapach świeżo upieczonej pizzy prosto z pieca, prawda? 🤩</p>
                <p>Wybierz swoją ulubioną pizzę, sprawdź zamówienia lub po prostu rozkoszuj się pięknem tego prostego, ale jakże smacznego życia! 🌟</p>
            </section>

            <section>
                <h2>💬 Potrzebujesz Pomocy?</h2>
                <p>Jeśli masz jakiekolwiek pytania lub potrzebujesz pomocy, nasz zespół obsługi klienta jest tutaj, żeby Ci pomóc! Zadzwoń pod numer <strong>123-456-789</strong>.</p>
            </section>

            <footer>
                <p>Nie zapomnij, że pizza to życie! 🍕<br>– Twoja Pizzeria online</p>
            </footer>
        </article>
    </main>


</body>

</html>
