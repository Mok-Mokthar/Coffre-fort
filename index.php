<?php include 'partials/header.php';

if (!isset($_SESSION['id'])){?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Coffre-Fort</h1>
    <div class="menu">
        <a href="./register.php">s'enregistrer</a>
        <a href="./login.php">se connecter</a>
        <a href="./lostPassword.php">mot de passe oublié</a>
    </div>
    
    <?php } else{?>
    
    <div class="containerUploadDownload">
        <div class="row">
            <form action="./treatment/uploads.php" method="post" enctype="multipart/form-data" >
                <h3>Upload File</h3>
                <input type="file" name="myfile"> <br>
                <button type="submit" name="save">upload</button><br>
            </form>
            <br>
        </div>
        <div class="row">
            <form action="./treatment/downloads.php" method="post" enctype="multipart/form-data" >
                <h3>Donwload File</h3>
                <br>
                <a href="downloads.php">downloads</a>
            </form>
        </div>
    </div>
    <button id="disconnect">Se déconnecter</button>
    <?php }
    ?>

    

</body>
</html>
    

<?php include 'partials/footer.php' ?>