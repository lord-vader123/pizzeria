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
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
            <label for="imie">Podaj imię</label>
            <input type="text" name="imie" id="imie">

            <label for="nazwisko">Podaj nazwisko</label>
            <input type="text" name="nazwisko" id="nazwisko">

            <label for="login">Podaj login, którym będziesz się logować</label>
            <input type="text" name="login" id="login">

            <label for="haslo">Podaj hasło</label>
            <input type="password" name="haslo" id="haslo">

            <label for="haslo2">Powtórz hasło</label>
            <input type="password" name="haslo2" id="haslo2">

            <label for="plec">Podaj swoją płeć</label>
            <label for="chop">Mężczyzna</label>
            <input type="radio" name="plec" id="chop" value="1">
            <label for="baba">Kobieta</label>
            <input type="radio" name="plec" id="baba" value="0">

            <label for="zdjecie">Podaj obrazek profilowy</label>
            <input type="file" name="zdjecie" id="zdjecie">

            <label for="ulica">Podaj ulicę</label>
            <input type="text" name="ulica" id="ulica">

            <label for="dom">Podaj numer domu</label>
            <input type="number" name="dom" id="dom">

            <label for="mieszkanie">Podaj numer mieszkania</label>
            <input type="number" name="mieszkanie" id="mieszkanie">
            
            <label for="kod">Podaj kod pocztowy</label>
            <input type="text" name="kod" id="kod">

            <button type="reset">Wyczyć</button>
            <button type="submit">Zatwierdź</button>

            
        </form>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                $password = password_hash($_POST['haslo'], PASSWORD_BCRYPT);

                $sql1 = "INSERT INTO adres(ulica, nr_domu, nr_mieszkania, kod_pocztowy) 
                         VALUES (?, ?, ?, ?);";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute([
                    $_POST['ulica'],
                    $_POST['dom'],
                    $_POST['mieszkanie'],
                    $_POST['kod']
                ]);

                $adres_id = $conn->lastInsertId();
                echo $adres_id;

                $image_path = null;
                if (!empty($_FILES['zdjecie']['name'])) {
                    $upload_dir = __ROOT__ . '/assets/users/';
                    $image_path = $upload_dir . basename($_FILES['zdjecie']['name']);
                    if (!move_uploaded_file($_FILES['zdjecie']['tmp_name'], $image_path)) {
                        throw new Exception("Nie udało się przesłać pliku ze zdjęciem.");
                    }
                }
                
                $sql2 = "INSERT INTO uzytkownik(imie, nazwisko, login, haslo, plec, zdjecie_src, adres) 
                         VALUES (?, ?, ?, ?, ?, ?, ?);";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([
                    $_POST['imie'],
                    $_POST['nazwisko'],
                    $_POST['login'],
                    $password,
                    $_POST['plec'],
                    $image_path,
                    $adres_id
                ]);

                echo "Rejestracja zakończona sukcesem!";
            } catch (Exception $e) {
                echo "Wystąpił błąd: " . $e->getMessage();
            }
echo "<pre>";
print_r($_POST);
print_r($_FILES);
echo "Adres ID: $adres_id";
echo "Ścieżka obrazu: $image_path";
echo "</pre>";
        }
        ?>

    </main>


<script src="/js/validate.js"></script>
</body>
