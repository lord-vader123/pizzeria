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
    <link rel="stylesheet" href="/pizzeria/style/style.css" />
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Pizzeria - strona główna</title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header.php'; ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
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

            <label for="zdjecie">Podaj obrazek profilowy</label>
            <input type="file" name="zdjecie" id="zdjecie">

            <label for="ulica">Podaj ulicę</label>
            <input type="text" name="ulica" id="ulica" required>

            <label for="dom">Podaj numer domu</label>
            <input type="number" name="dom" id="dom" required>

            <label for="mieszkanie">Podaj numer mieszkania</label>
            <input type="number" name="mieszkanie" id="mieszkanie">

            <label for="kod">Podaj kod pocztowy</label>
            <input type="text" name="kod" id="kod" required>

            <button type="reset">Wyczyść</button>
            <button type="submit" id="submit">Zatwierdź</button>

            <section id="info">
                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    try {
                        $password = password_hash($_POST['haslo'], PASSWORD_BCRYPT);

                        $sql1 = "INSERT INTO adres (ulica, nr_domu, nr_mieszkania, kod_pocztowy) VALUES (?, ?, ?, ?)";
                        $stmt1 = $conn->prepare($sql1);
                        $stmt1->bind_param("siss", $_POST['ulica'], $_POST['dom'], $_POST['mieszkanie'], $_POST['kod']);
                        if (!$stmt1->execute()) {
                            throw new Exception("Błąd przy dodawaniu adresu: " . $stmt1->error);
                        }

                        $adres_id = $conn->insert_id;

                        $image_path = null;
                        if (!empty($_FILES['zdjecie']['name'])) {
                            $upload_dir = __ROOT__ . '/assets/users/';
                            $image_path = $upload_dir . basename($_FILES['zdjecie']['name']);
                            if (!move_uploaded_file($_FILES['zdjecie']['tmp_name'], $image_path)) {
                                throw new Exception("Nie udało się przesłać pliku ze zdjęciem. image_path = " . $image_path);
                            }
                        }

                        $sql2 = "INSERT INTO uzytkownik (imie, nazwisko, login, haslo, plec, zdjecie_src, adres) VALUES (?, ?, ?, ?, ?, ?, ?)";
                        $stmt2 = $conn->prepare($sql2);
                        $stmt2->bind_param(
                            "ssssiss",
                            $_POST['imie'],
                            $_POST['nazwisko'],
                            $_POST['login'],
                            $password,
                            $_POST['plec'],
                            $image_path,
                            $adres_id
                        );

                        if (!$stmt2->execute()) {
                            throw new Exception("Błąd przy dodawaniu użytkownika: " . $stmt2->error);
                        }
                        $id = $conn->insert_id;

                        echo "Rejestracja zakończona sukcesem!";
                        setcookie("login", $_POST['login'], time() + 3600, '/');
                        setcookie("password", $password, time() + 3600, '/');
                        $_SESSION['login'] =  $_POST['login'];
                        $_SESSION['password'] = $password;
                        $_SESSION['id'] = $id;
                        header("Location: /pizzeria/dashboard.php");
                        exit();
                    } catch (Exception $e) {
                        echo "Wystąpił błąd: " . $e->getMessage();
                    }
                }
                ?>
            </section>
        </form>
    </main>

    <script src="/pizzeria/js/validate.js"></script>
</body>

</html>
