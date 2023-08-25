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
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $broj_telefona = $_POST['broj_telefona'];
    $adresa = $_POST['adresa'];

    // Provera da li korisničko ime već postoji u bazi
    $sql_provera = "SELECT * FROM korisnik WHERE username = '$username'";
    $rezultat_provera = mysqli_query($conn, $sql_provera);

    if (mysqli_num_rows($rezultat_provera) > 0) {
        $poruka_greske = "Korisničko ime već postoji.";
    } else {
        // Unos novog korisnika u bazu
        $sql_unos = "INSERT INTO korisnik (ime, prezime, username, password, email, broj_telefona, adresa)
                     VALUES ('$ime', '$prezime', '$username', '$password', '$email', '$broj_telefona', '$adresa')";
        
        if (mysqli_query($conn, $sql_unos)) {
            $poruka_uspeha = "Registracija uspešna. Možete se prijaviti.";
        } else {
            $poruka_greske = "Greška pri registraciji: " . mysqli_error($conn);
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
    <h1 class="display-3">Registracija novog korisnika</h1>
    <?php if (!empty($poruka_greske)) { ?>
        <p class="bg-danger text-white"><?php echo $poruka_greske; ?></p>
    <?php } ?>
    <?php if (!empty($poruka_uspeha)) { ?>
        <p class="bg-success text-white"><?php echo $poruka_uspeha; ?></p>
    <?php } ?>
    <form style="margin-left:10px" method="POST" action="registracija.php">
        <label style="font-weight:bold;" for="ime">Ime:</label><br>
        <input type="text" id="ime" name="ime" required><br>

        <label style="font-weight:bold;" for="prezime">Prezime:</label><br>
        <input type="text" id="prezime" name="prezime" required><br>

        <label style="font-weight:bold;" for="username">Korisničko ime:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label style="font-weight:bold;" for="password">Lozinka:</label><br>
        <input type="password" id="password" name="password" required><br>

        <label style="font-weight:bold;" for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br>

        <label style="font-weight:bold;" for="broj_telefona">Broj telefona:</label><br>
        <input type="text" id="broj_telefona" name="broj_telefona" required><br>

        <label style="font-weight:bold;" for="adresa">Adresa:</label><br>
        <input type="text" id="adresa" name="adresa" required><br><br>

        <input class="btn btn-light" type="submit" value="Registruj se">
    </form>

    <a style="position:relative; left:125px; bottom:38px;" href="login.php"><button class="btn btn-light">Prijava</button></a>
</body>
</html>