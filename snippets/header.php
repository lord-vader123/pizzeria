<header>
    <section>
        <a href="/pizzeria/index.php"><img src="/pizzeria/assets/logo.png" alt="Logo pizzeri"></a>
    </section>

    <nav>
        <a href="/pizzeria/subpages/menu.php">Menu</a>
        <a onclick="if (confirm('Musisz być zalogowany, bo złożyć zamówienie. Czy chcesz się zalogować?')) window.location.replace('/pizzeria/php/login.php')">Zamów</a>
        <a onclick="if (confirm('Musisz być zalogowany, bo zobaczyć swoje zamówienia. Czy chcesz się zalogować?')) window.location.replace('/pizzeria/php/login.php');">Edytuj</a>
    </nav>

    <section>
        <img src="/pizzeria/assets/user-symbol.jpg" alt="Symbol użytkownika" />
        <nav class="menu">
            <a class="menu-item" href="/pizzeria/php/login.php">Zaloguj się</a>
            <a class="menu-item" href="/pizzeria/php/register.php">Zarejestruj się</a>
        </nav>
    </section>
</header>
