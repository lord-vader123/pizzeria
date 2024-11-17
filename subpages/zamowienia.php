<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);
include_once __ROOT__ . '/php/login-mysql.php';
include_once __ROOT__ . '/php/check-logged.php';

$login = $_SESSION['login'];
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css">
    <link rel="stylesheet" href="/pizzeria/style/menu.css">
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Twoje zamówienia</title>
</head>

<body>
    <?php include_once __ROOT__ . '/snippets/header-logged.php'; ?>

    <table>
        <thead>
            <tr>
                <th>Pizza</th>
                <th>Ilość</th>
                <th>Cena</th>
            </tr>
        </thead>

        <tbody>
            <?php
            $stmt = $conn->prepare("
                SELECT pizza.nazwa, zamowienie.ilosc, zamowienie.cena
                FROM pizza
                INNER JOIN zamowienie ON pizza.id = zamowienie.pizza_id
                INNER JOIN uzytkownik ON uzytkownik.id = zamowienie.klient
                WHERE uzytkownik.id = ?;
");

            $stmt->bind_param("i", $id);

            if (!$stmt->execute()) {
                echo "Błąd zapytania";
                exit();
            }

            $stmt->store_result();
            $stmt->bind_result($nazwa, $ilosc, $cena);

            while ($stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($nazwa) . "</td>";
                echo "<td>" . htmlspecialchars($ilosc) . "</td>";
                echo "<td>" . htmlspecialchars($cena) . " zł</td>";
                echo "</tr>";
            }

            $stmt->free_result();
            $stmt->close();
            ?>
        </tbody>
    </table>

</body>

</html>
