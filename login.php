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

$poruka_uspeha = $poruka_greske="";

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $upit="SELECT * FROM korisnik WHERE username='$username' AND password='$password'";
    $rez=mysqli_query($conn,$upit);

    if(mysqli_num_rows($rez) == 1){
        $red = mysqli_fetch_assoc($rez);
        session_start();
        $_SESSION['id_korisnika'] = $red['id_korisnika'];
        header('Location: pocetna.php');
        exit;
    }else{
        $poruka_greske="Pogresno uneti podaci" . mysqli_error($conn);
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <title>Prijava</title>
</head>
<body style="background-color:#669999;">
    <h1 class="display-3">Prijava</h1>
    <?php if (!empty($poruka_greske)) { ?>
        <p class="bg-danger text-white"><?php echo $poruka_greske; ?></p>
    <?php } ?>
    <form style="margin-left:10px;" method="POST" action="login.php">
        <label style="font-weight:bold;" for="username">Korisničko ime:</label><br>
        <input type="text" id="username" name="username" required><br>

        <label style="font-weight:bold;" for="password">Lozinka:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input class="btn btn-light" type="submit" value="Prijavi se"><br><br>
    </form>
    <a style="position:relative; left:115px; bottom:62px;" href="registracija.php"><button class="btn btn-light">Registruj se</button></a>
    <a style="position:relative; left:130px; bottom:62px;" href="admin.php"><button class="btn btn-light">Administrator</button></a>
</body>
</html>