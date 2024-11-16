<?php
session_start();

define("__ROOT__", $_SESSION['__ROOT__']);

include_once __ROOT__ . '/php/login-mysql.php';
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css">
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Zaloguj się</title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header.php' ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="login">Podaj login</label>
            <input type="text" name="login" id="login">

            <label for="haslo">Podaj hasło</label>
            <input type="password" name="haslo" id="haslo">

            <button type="reset">Wyczyść</button>
            <button type="submit">Zaloguj się</button>

        </form>
        <a href="/pizzeria/php/register.php">Nie masz jeszcze konta? Zarejestruj się!</a>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $stmt = $conn->prepare("SELECT haslo FROM uzytkownik WHERE login = ?");
            $stmt->bind_param("s", $_POST['login']);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($hashed_password);
                $stmt->fetch();

                if (password_verify($_POST['haslo'], $hashed_password)) {
                    $_SESSION['login'] = $_POST['login'];
                    $_SESSION['password'] = $_POST['haslo'];
                    setcookie("login", $_POST['login'], time() + 3600, '/');
                    setcookie("password", $password, time() + 3600, '/');
                    header("Location: /pizzeria/dashboard.php");
                    exit();
                } else {
                    echo "Niepoprawne hasło";
                }
            } else {
                echo "Niepoprawny login";
            }
        }
        ?>
    </main>

</body>

</html>
