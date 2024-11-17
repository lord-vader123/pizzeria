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
        <main>

            <article>
                <header>
                    <h1>🍕 O Pizzy - Wszyscy Ją Kochają! 🍕</h1>
                </header>

                <section>
                    <h2>Witaj w Królestwie Pizzy!</h2>
                    <p>Pizza, to nie tylko jedzenie, to <strong>prawdziwa pasja</strong>! Z jej pysznym, chrupiącym ciastem, aromatycznymi składnikami i <em>niepowtarzalnym smakiem</em>, każdy kawałek to jak mały kawałek nieba na ziemi! ✨</p>
                </section>

                <section>
                    <h3>Dlaczego Pizza Jest Najlepsza? 🤔</h3>
                    <ul>
                        <li><strong>Uniwersalność:</strong> Możesz ją jeść na <em>zimno</em> lub na <em>gorąco</em>, o każdej porze dnia i nocy!</li>
                        <li><strong>Wybór składników:</strong> Od klasycznych <u>margherita</u>, przez <i>pepperoni</i>, aż po bardziej ekskluzywne <b>trufle</b> i <b>szampana</b>!</li>
                        <li><strong>Szybkość:</strong> Pizzę dostaniesz w 30 minut, bo "czas to pieniądz" 💸.</li>
                    </ul>
                </section>

                <section>
                    <h3>Pizza na Świecie 🌍</h3>
                    <p>Pizza to <strong>międzynarodowy hit</strong>! Od Włoch po Stany Zjednoczone, każdy kraj ma swoje własne wersje. W Polsce nie brakuje takich smaków, jak <b>pizza hawajska</b>, która dzieli naród na dwa obozy!</p>
                </section>

                <section>
                    <h2>🍕 Najlepsze Składniki - Przepis na Sukces! 🍕</h2>
                    <p>Dobry przepis na pizzę to nie tylko ciasto. To także świeże, jakościowe składniki! <b>Pomidorowa baza</b>, <i>ser mozzarella</i>, <b>świeża bazylia</b> i <i>oliwa z oliwek</i> to tajemnica sukcesu!</p>
                    <p>A jeśli chcesz zabłysnąć wśród znajomych, spróbuj zrobić pizzę z dodatkiem <u>rukoli</u> i <strong>prosciutto</strong> — totalny hit!</p>
                </section>

                <footer>
                    <p>Nie czekaj, zamów pizzę już teraz! 🍕📞</p>
                </footer>
            </article>
        </main>
    </main>

    <footer>
    </footer>
</body>

</html>
