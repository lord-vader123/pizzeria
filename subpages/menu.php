<?php
session_start();
define("__ROOT__", $_SESSION['__ROOT__']);

include_once __ROOT__ . '/php/login-mysql.php';

$logged = false;

if (isset($_SESSION['login']) && isset($_SESSION['password']) || isset($_COOKIE['login']) && isset($_COOKIE['password'])) {
    $logged = true;
}

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/pizzeria/style/style.css" />
    <link rel="stylesheet" href="/pizzeria/style/menu.css" />
    <link rel="icon" href="/pizzeria/assets/favico.ico">
    <title>Menu</title>
</head>

<body>
    <?php if ($logged) {
        include_once __ROOT__ . '/snippets/header-logged.php';
    } else {
        include_once __ROOT__ . '/snippets/header.php';
    } ?>

    <main>
        <h2>Nasze menu</h2>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <label for="sortowanie">Sortuj według</label>
            <input type="text" list="sortowanie" name="sortowanie">
            <datalist id="sortowanie">
                <option value="cena-rosnaco">Cena (rosnąco)</option>
                <option value="cena-malejaco">Cena (malejąco)</option>
                <option value="rozmiar-rosnaco">Rozmiar (rosnąco)</option>
                <option value="rozmiar-malejaco">Rozmiar (malejąco)</option>
            </datalist>
            <label for="grupowanie">Grupuj według</label>
            <input type="text" list="grupowanie" name="grupowanie">
            <datalist id="grupowanie">
                <option value="nie">Nie grupuj</option>
                <option value="cena">Według ceny</option>
                <option value="rozmiar">Według rozmiaru</option>
            </datalist>

            <button type="reset">Wyczyść</button>
            <button type="submit">Zatwierdź</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sortowanie = $_POST['sortowanie'] ?? '';
            $grupowanie = $_POST['grupowanie'] ?? '';

            $orderBy = '';
            $groupBy = '';

            switch ($sortowanie) {
                case 'cena-rosnaco':
                    $orderBy = 'ORDER BY cena ASC';
                    break;
                case 'cena-malejaco':
                    $orderBy = 'ORDER BY cena DESC';
                    break;
                case 'rozmiar-rosnaco':
                    $orderBy = 'ORDER BY rozmiar ASC';
                    break;
                case 'rozmiar-malejaco':
                    $orderBy = 'ORDER BY rozmiar DESC';
                    break;
                default:
                    break;
            }

            switch ($grupowanie) { // to grupowanie za bardzo nie ma sensu, ale nie mam pomysłu jak je zrobić
                case 'cena':
                    $groupBy = 'GROUP BY cena';
                    break;
                case 'rozmiar':
                    $groupBy = 'GROUP BY rozmiar';
                    break;
                default:
                    break;
            }

            try {
                $sql = "SELECT nazwa, skladniki, rozmiar, cena FROM pizza $groupBy $orderBy;";
                $result = $conn->query($sql);

                if (!$result) {
                    throw new Exception("Error executing query");
                }

                if ($result->num_rows > 0) {
                    echo '<table>
                        <thead>
                            <tr>
                                <th>Nazwa</th>
                                <th>Składniki</th>
                                <th>Rozmiar</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['nazwa']) . "</td>
                            <td>" . htmlspecialchars($row['skladniki']) . "</td>
                            <td>" . htmlspecialchars($row['rozmiar']) . "</td>
                            <td>" . htmlspecialchars($row['cena']) . " zł</td>
                        </tr>";
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>Brak wyników</p>';
                }
                $result->free();
            } catch (Exception $e) {
                echo '<p>Błąd: ' . $e->getMessage() . '</p>';
            }
        } else {
            try {
                $sql = "SELECT nazwa, skladniki, rozmiar, cena FROM pizza;";
                $result = $conn->query($sql);

                if (!$result) {
                    throw new Exception("Error executing query");
                }

                if ($result->num_rows > 0) {
                    echo '<table>
                        <thead>
                            <tr>
                                <th>Nazwa</th>
                                <th>Składniki</th>
                                <th>Rozmiar</th>
                                <th>Cena</th>
                            </tr>
                        </thead>
                        <tbody>';
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['nazwa']) . "</td>
                            <td>" . htmlspecialchars($row['skladniki']) . "</td>
                            <td>" . $row['rozmiar'] . "</td>
                            <td>" . htmlspecialchars($row['cena']) . " zł</td>
                        </tr>";
                    }
                    echo '</tbody></table>';
                } else {
                    echo '<p>Brak wyników</p>';
                }
                $result->free();

        } catch (Exception $e) {
            echo '<p>Błąd: ' . $e->getMessage() . '</p>';
            }
        }
        ?>
    </main>

</body>

</html>
