<?php
// Povezivanje s bazom podataka
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "is_projekat";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Provera konekcije
if (!$conn) {
    die("Neuspela konekcija na bazu: " . mysqli_connect_error());
}

// Inicijalizacija promenljivih za poruke o grešci i uspehu
$poruka_greske = $poruka_uspeha = "";

// Procesiranje forme za registraciju
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prikupljanje unetih podataka
    $naziv = $_POST['naziv'];
    $kategorija = $_POST['kategorija'];
    $cena = $_POST['cena'];
    $kolicina = $_POST['kolicina'];

    // Provera da li proizvod već postoji u bazi
    $sql_provera = "SELECT * FROM proizvod WHERE naziv = '$naziv'";
    $rezultat_provera = mysqli_query($conn, $sql_provera);

    if (mysqli_num_rows($rezultat_provera) > 0) {
        $poruka_greske = "Proizvod vec postoji.";
    } else {
        // Unos novog proizvoda u bazu
        $sql_unos = "INSERT INTO proizvod (naziv, kategorija, cena, kolicina)
                     VALUES ('$naziv', '$kategorija', '$cena', '$kolicina')";
        
        if (mysqli_query($conn, $sql_unos)) {
            $poruka_uspeha = "Uspesno dodat proizvod.";
        } else {
            $poruka_greske = "Proizvod vec postoji. " . mysqli_error($conn);
        }
    }
}

// Zatvaranje konekcije
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Registracija</title>
</head>
<body style="background-color:#669999;">
    <h1 class="display-3">Dodavanje novog proizvoda</h1>
    <?php if (!empty($poruka_greske)) { ?>
        <p class="bg-danger text-white"><?php echo $poruka_greske; ?></p>
    <?php } ?>
    <?php if (!empty($poruka_uspeha)) { ?>
        <p class="bg-success text-white"><?php echo $poruka_uspeha; ?></p>
    <?php } ?>
    <form style="margin-left:10px" method="POST" action="dodaj_proizvod.php">
        <label style='font-weight:bold' for="naziv">Naziv proizvoda:</label><br>
        <input type="text" id="naziv" name="naziv" required><br>

        <label style='font-weight:bold' for="kategorija">Kategorija:</label><br>
        <input type="text" id="kategorija" name="kategorija" required><br>

        <label style='font-weight:bold' for="cena">Cena</label><br>
        <input type="number" id="cena" name="cena" required><br>

        <label style='font-weight:bold' for="kolicina">Kolicina:</label><br>
        <input type="number" id="kolicina" name="kolicina" required><br><br>

        <input class="btn btn-light" type="submit" value="Dodaj proizvod">
    </form>
    <br>
    <a href="admin.php"><button class="btn btn-light" style="position:relative; left:160px; bottom:61px">Admin strana</button></a>
</body>
</html>