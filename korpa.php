<?php
session_start();

// Provera da li je korisnik prijavljen
if (!isset($_SESSION['id_korisnika'])) {
    // Ako korisnik nije prijavljen, preusmeri ga na stranicu za prijavljivanje
    header("Location: login.php");
    exit();
}

// Povezivanje sa bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is_projekat";

$conn = new mysqli($servername, $username, $password, $dbname);

// Provera konekcije
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Provera da li je poslat zahtev za kreiranje računa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kreiranje računa (tabela "racun")
    $id_korisnika = $_SESSION['id_korisnika'];
    $datum = date("Y-m-d");
    $ukupna_cena = 0;

    // Dobijanje svih proizvoda iz korpe (tabela "racun_proizvod")
    $sql = "SELECT * FROM racun_proizvod WHERE id_racuna IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $id_proizvoda = $row['id_proizvoda'];
            $ukupna_kolicina = $row['ukupna_kolicina'];

            // Dobijanje cene proizvoda iz tabele "proizvod"
            $sql_proizvod = "SELECT cena FROM proizvod WHERE id_proizvoda = '$id_proizvoda'";
            $result_proizvod = $conn->query($sql_proizvod);
            $row_proizvod = $result_proizvod->fetch_assoc();
            $cena = $row_proizvod['cena'];

            // Izračunavanje ukupne cene
            $ukupna_cena += $cena * $ukupna_kolicina;

            // Oduzimanje količine proizvoda iz tabele "proizvod"
            $sql_update_proizvod = "UPDATE proizvod SET kolicina = kolicina - $ukupna_kolicina WHERE id_proizvoda = '$id_proizvoda'";
            $conn->query($sql_update_proizvod);
        }
    }

    // Unos računa u bazu
    $sql_insert_racun = "INSERT INTO racun (id_korisnika, datum, ukupna_cena) VALUES ('$id_korisnika', '$datum', '$ukupna_cena')";
    $conn->query($sql_insert_racun);

    // Dodeljivanje ID-ja kreiranog računa
    $id_racuna = $conn->insert_id;

    // Ažuriranje ID-ja računa za proizvode u korpi (tabela "racun_proizvod")
    $sql_update_racun_proizvod = "UPDATE racun_proizvod SET id_racuna = '$id_racuna' WHERE id_racuna IS NULL";
    $conn->query($sql_update_racun_proizvod);

    // Redirekcija na stranicu računa
    header("Location: racun.php?id_racuna=$id_racuna");
    exit();
}

// Dobijanje svih proizvoda iz korpe (tabela "racun_proizvod")
$sql = "SELECT p.naziv, p.cena, rp.ukupna_kolicina
        FROM racun_proizvod rp
        INNER JOIN proizvod p ON rp.id_proizvoda = p.id_proizvoda
        WHERE rp.id_racuna IS NULL";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Korpa</title>
</head>
<body style="background-color:#669999;">
    <h3 class="display-3">Proizvodi u korpi:</h3>
    <table class="table table-striped table-dark">
        <tr>
            <th>Naziv</th>
            <th>Cena</th>
            <th>Količina</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $naziv = $row['naziv'];
                $cena = $row['cena'];
                $ukupna_kolicina = $row['ukupna_kolicina'];
                ?>
                <tr>
                    <td><?php echo $naziv; ?></td>
                    <td><?php echo $cena; ?></td>
                    <td><?php echo $ukupna_kolicina; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>Nema proizvoda u korpi.</td></tr>";
        }
        ?>
    </table>
    <br>
    <form method="POST" action="">
        <input style="margin-left:10px;" class="btn btn-light" type="submit" value="Kreiraj račun">
    </form>
    <br>
    <a style="position:relative; left:150px; bottom:62px;" href="pocetna.php"><button class="btn btn-light">Pocetna</button></a>
</body>
</html>

<?php
$conn->close();
?>