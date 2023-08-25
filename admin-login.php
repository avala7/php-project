<?php
    session_start();

    if(isset($_POST['pass'])){
        if($_POST['pass']=='admin12345'){
            $_SESSION['provera'] = true;
            header('Location: admin.php');
            exit();
        }else{
            echo "Pogresna sifra pokusaj ponovo";
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
    <title>Prijava - Admin</title>
</head>
<body style="background-color:#669999;">
        <h1 class="display-3">Prijavi se kao administrator</h1>
        <form style='margin-left:10px;' method='POST'>
        <label style='font-weight:bold' for='pass'>Lozinka:</label><br>
        <input type='password' name='pass' required><br><br>
        <button class="btn btn-light" type='submit'>Prijavi se</button>
        </form>
</body>
</html>