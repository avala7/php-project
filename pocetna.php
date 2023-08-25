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

// Provera da li je poslat zahtev za dodavanje proizvoda u korpu
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Provera da li je izabrana količina
    if (isset($_POST['kolicina']) && is_numeric($_POST['kolicina']) && $_POST['kolicina'] > 0) {
        // Dobijanje ID-ja izabranog proizvoda
        $id_proizvoda = $_POST['id_proizvoda'];
        $kolicina = $_POST['kolicina'];

        // Dodavanje proizvoda u korpu (tabela "racun_proizvod")
        $id_korisnika = $_SESSION['id_korisnika'];
        $sql = "INSERT INTO racun_proizvod (id_proizvoda, id_racuna, ukupna_kolicina)
                VALUES ('$id_proizvoda', NULL, '$kolicina')";
        $conn->query($sql);
    }
}

// Dobijanje svih proizvoda iz baze
$sql = "SELECT * FROM proizvod";
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
    <title>Početna stranica</title>
</head>
<body style="background-color:#669999;">
    <h3 class="display-3">Proizvodi:</h3>
    <table class="table table-striped table-dark">
        <tr>
            <th>Naziv</th>
            <th>Kategorija</th>
            <th>Cena</th>
            <th>Stanje na lageru</th>
            <th>Količina</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $id_proizvoda = $row['id_proizvoda'];
                $naziv = $row['naziv'];
                $kategorija = $row['kategorija'];
                $cena = $row['cena'];
                $kolicina = $row['kolicina'];
                ?>
                <tr>
                    <td><?php echo $naziv; ?></td>
                    <td><?php echo $kategorija; ?></td>
                    <td><?php echo $cena; ?></td>
                    <td><?php echo $kolicina; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id_proizvoda" value="<?php echo $id_proizvoda; ?>">
                            <input type="number" name="kolicina" min="1" max="<?php echo $kolicina; ?>">
                            <input style="position:relative; left:200px;"  class="btn btn-light" type="submit" value="Dodaj u korpu">
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='6'>Nema dostupnih proizvoda.</td></tr>";
        }
        ?>
    </table>
    <br><br>
    <a style="margin-left:10px;" href="korpa.php"><button class="btn btn-light">Pregled korpe</button></a>
    <a style="margin-left:10px;" href="odjava.php"><button class="btn btn-light">Odjava</button></a>
</body>
</html>

<?php
$conn->close();
?>