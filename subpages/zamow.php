<?php
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
        </form>


    </main>

</body>

</html>
