<?php
// Włącz wyświetlanie błędów
ini_set('display_errors', 1);

// Ustaw poziom raportowania błędów
error_reporting(E_ALL);
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);
include_once __ROOT__ . '/php/login-mysql.php';
include_once __ROOT__ . '/php/check-logged.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css">
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Zamów</title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header-logged.php'; ?>

    <main>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <h2>Twoje zamówienie:</h2>
            <label for="pizza">Twoja pizza</label>
            <input type="text" list="pizze" id="pizza" name="pizza" required>
            <datalist id="pizze">
                <?php
                $result = $conn->query("SELECT id, nazwa FROM pizza;");
                if (!$result) {
                    echo "Błąd strony";
                    exit();
                }
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row['id'] . ">" . $row['nazwa'] . "</option>";
                }
                ?>
            </datalist>
            <label for="ilosc">Ile pizz pragniesz zamówić?</label>
            <input type="number" id="ilosc" name="ilosc" min="1" required>
            <button type="reset">Zresetuj</button>
            <button type="submit">Zamów</button>
            <?php

            if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $login = $_SESSION['login'];
                $password = $_SESSION['password'];

                $stmt = $conn->prepare("SELECT id FROM uzytkownik WHERE login = ? AND haslo = ?");
                $stmt->bind_param("ss", $login, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $id = $row['id'];

                    $id_pizza = $_POST['pizza'];
                    $ilosc = $_POST['ilosc'];

                    $stmt = $conn->prepare("SELECT cena FROM pizza WHERE id = ?");
                    $stmt->bind_param("i", $id_pizza);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $cena_pizzy = $row['cena'];

                    $cena = $ilosc * $cena_pizzy;

                    $stmt = $conn->prepare("INSERT INTO zamowienie (klient, pizza_id, ilosc, cena) VALUES (?, ?, ?, ?)");
                    $stmt->bind_param("iiii", $id, $id_pizza, $ilosc, $cena);
                    $stmt->execute();

                    echo "Złożono zamówienie! <br>";
                    echo "Cena za zamówienie: " . number_format($cena, 2) . " zł.";
                } else {
                    echo "Nie znaleziono użytkownika.";
                }

                $stmt->close();
            }
            ?>
        </form>


    </main>

</body>

</html>
