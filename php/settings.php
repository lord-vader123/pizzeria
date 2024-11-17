<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);
include_once __ROOT__ . '/php/login-mysql.php';
include_once __ROOT__ . '/php/check-logged.php';
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css">
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Ustawienia</title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header-logged.php'; ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Aktualizacja danych</h2>
            <label for="imie">Podaj imię</label>
            <input type="text" name="imie" id="imie" required>

            <label for="nazwisko">Podaj nazwisko</label>
            <input type="text" name="nazwisko" id="nazwisko" required>

            <label for="login">Podaj login, którym będziesz się logować</label>
            <input type="text" name="login" id="login" required>

            <label for="haslo">Podaj hasło</label>
            <input type="password" name="haslo" id="haslo" required>

            <label for="haslo2">Powtórz hasło</label>
            <input type="password" name="haslo2" id="haslo2" required>

            <label for="plec">Podaj swoją płeć</label>
            <label for="chop">Mężczyzna</label>
            <input type="radio" name="plec" id="chop" value="1" required>
            <label for="baba">Kobieta</label>
            <input type="radio" name="plec" id="baba" value="0" required>

            <button type="reset">Wyczyść</button>
            <button type="submit" id="submit">Zatwierdź</button>
            <?php
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $imie = $_POST['imie'];
                $nazwisko = $_POST['nazwisko'];
                $login = $_POST['login'];
                $haslo = $_POST['haslo'];
                $haslo2 = $_POST['haslo2'];
                $plec = $_POST['plec'];

                if ($haslo !== $haslo2) {
                    echo "Hasła nie są takie same!";
                    exit;
                }

                $hashed_password = password_hash($haslo, PASSWORD_DEFAULT);


                $query = "UPDATE uzytkownik SET imie = ?, nazwisko = ?, login = ?, haslo = ?, plec = ? WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ssssii", $imie, $nazwisko, $login, $hashed_password, $plec, $id);
                $stmt->execute();

                $_SESSION['login'] = $login;
                $_SESSION['haslo'] = $hashed_password;
                setcookie("login", $login, time() + 3600, '/');
                setcookie("password", $hashed_password, time() + 3600, '/');
                echo "Dane zostały zaktualizowane!";
                exit;
            }
            ?>


        </form>
    </main>

    <script src="/js/validate.js"></script>
</body>

</html>
