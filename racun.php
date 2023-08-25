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

// Provera postojanja ID-ja računa u URL parametrima
if (isset($_GET['id_racuna'])) {
    $id_racuna = $_GET['id_racuna'];

    // Dobijanje informacija o računu iz baze
    $sql_racun = "SELECT * FROM racun WHERE id_racuna = '$id_racuna'";
    $result_racun = $conn->query($sql_racun);
    $row_racun = $result_racun->fetch_assoc();

    if ($row_racun) {
        $id_korisnika = $row_racun['id_korisnika'];
        $datum = $row_racun['datum'];
        $ukupna_cena = $row_racun['ukupna_cena'];

        // Dobijanje informacija o korisniku iz baze
        $sql_korisnik = "SELECT * FROM korisnik WHERE id_korisnika = '$id_korisnika'";
        $result_korisnik = $conn->query($sql_korisnik);
        $row_korisnik = $result_korisnik->fetch_assoc();

        $ime = $row_korisnik['ime'];
        $prezime = $row_korisnik['prezime'];
        $email = $row_korisnik['email'];
        $broj_telefona = $row_korisnik['broj_telefona'];
        $adresa = $row_korisnik['adresa'];
    } else {
        echo "Račun ne postoji.";
        exit();
    }
} else {
    echo "Nedostaje ID računa.";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Račun</title>
</head>
<body>
    <h1 class="display-3">Račun broj <?php echo $id_racuna; ?></h1>
    <!--<p style="margin-left:10px; font-weight:bold;">Datum: <?php echo $datum; ?></p>-->
    <p style="margin-left:10px; font-weight:bold;">Kupac: <?php echo $ime . " " . $prezime; ?></p>
    <p style="margin-left:10px; font-weight:bold;">Email: <?php echo $email; ?></p>
    <p style="margin-left:10px; font-weight:bold;">Broj telefona: <?php echo $broj_telefona; ?></p>
    <p style="margin-left:10px; font-weight:bold;">Adresa: <?php echo $adresa; ?></p>
    <br>
    <h3>Stavke računa:</h3>
    <table class="table table-striped">
        <tr>
            <th>Naziv</th>
            <th>Cena</th>
            <th>Količina</th>
        </tr>
        <?php
        // Dobijanje svih stavki računa iz baze (tabela "racun_proizvod")
        $sql_stavke = "SELECT p.naziv, p.cena, rp.ukupna_kolicina
                       FROM racun_proizvod rp
                       INNER JOIN proizvod p ON rp.id_proizvoda = p.id_proizvoda
                       WHERE rp.id_racuna = '$id_racuna'";
        $result_stavke = $conn->query($sql_stavke);

        if ($result_stavke->num_rows > 0) {
            while ($row_stavke = $result_stavke->fetch_assoc()) {
                $naziv = $row_stavke['naziv'];
                $cena = $row_stavke['cena'];
                $kolicina = $row_stavke['ukupna_kolicina'];
                ?>
                <tr>
                    <td><?php echo $naziv; ?></td>
                    <td><?php echo $cena; ?></td>
                    <td><?php echo $kolicina; ?></td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='3'>Nema stavki na računu.</td></tr>";
        }
        ?>
        <tr>
            <td style="font-weight:bold; text-align:right;" colspan="3";>Datum: <?php echo $datum; ?> </td>
        </tr>  
        <tr>
            <td style="font-weight:bold; text-align:right;" colspan="3";>Ukupna cena: <?php echo $ukupna_cena; ?> </td>
        </tr>   
    </table>
    <br>
    <p></p>
    <br>
    <a style="margin-left:10px;" href="pocetna.php"><button class="btn btn-dark">Pocetna</button></a>
</body>
</html>

<?php
$conn->close();
?>