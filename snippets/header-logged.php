<?php
$zdjecie_src = "";
$stmt = $conn->prepare("SELECT zdjecie_src FROM uzytkownik WHERE login = ?");
$stmt->bind_param("s", $_SESSION['login']);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($zdjecie_src);

$stmt->fetch();

$pos = strpos($zdjecie_src, "/pizzeria");

if ($pos !== false) {
    $zdjecie_src = substr($zdjecie_src, $pos);
}

?>
<header>
    <section>
        <a href="/pizzeria/index.php"><img src="/pizzeria/assets/logo.png" alt="Logo pizzeri"></a>
    </section>

    <nav>
        <a href="/pizzeria/subpages/menu.php">Menu</a>
        <a href="/pizzeria/subpages/zamow.php">Zamów</a>
        <a href="/pizzeria/subpages/zamowienia.php">Zobacz swoje zamówienia</a>
    </nav>

    <section>
        <img src="<?php echo $zdjecie_src ?>" alt="Symbol użytkownika" />
        <nav class="menu">
            <a class="menu-item" href="/pizzeria/php/settings.php">Ustawienia</a>
            <a class="menu-item" href="/pizzeria/php/logout.php">Wyloguj się</a>
        </nav>
    </section>
</header>
