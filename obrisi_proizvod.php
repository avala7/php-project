<?php
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

// Provera da li je poslat zahtev za brisanje proizvoda
if (isset($_POST['obrisi'])) {
    $id_proizvoda = $_POST['id_proizvoda'];

    // Brisanje proizvoda iz baze
    $sql = "DELETE FROM proizvod WHERE id_proizvoda = '$id_proizvoda'";
    $conn->query($sql);
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
    <title>Brisanje proizvoda</title>
</head>
<body style="background-color:#669999;">
    <h3 class="display-3">Brisanje proizvoda</h3>
    <table class="table table-striped table-dark">
        <tr>
            <th>ID</th>
            <th>Naziv</th>
            <th>Kategorija</th>
            <th>Cena</th>
            <th>Količina</th>
            <th></th>
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
                    <td><?php echo $id_proizvoda; ?></td>
                    <td><?php echo $naziv; ?></td>
                    <td><?php echo $kategorija; ?></td>
                    <td><?php echo $cena; ?></td>
                    <td><?php echo $kolicina; ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="id_proizvoda" value="<?php echo $id_proizvoda; ?>">
                            <input class="btn btn-light" type="submit" name="obrisi" value="Obrisi">
                        </form>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "Nema dostupnih proizvoda.";
        }
        ?>
    </table>
    <a style="margin-left:10px;" href="admin.php"><button class="btn btn-light">Admin strana</button></a>
</body>
</html>

<?php
// Zatvaranje konekcije sa bazom podataka
$conn->close();
?>