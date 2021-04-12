<?php

$conn = mysqli_connect('localhost', 'root', '', 'coffre-fort');

$sql = "SELECT * FROM files";
$result = mysqli_query($conn, $sql);

$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_POST['save'])){
    $filename = $_FILES['myfile']['name'];

    $destination = '../uploads/' . $filename;

    $extension = pathinfo($filename, PATHINFO_EXTENSION);

    $file = $_FILES['myfile']['tmp_name'];
    $size = $_FILES['myfile']['size'];
    if (!in_array($extension, ['zip', 'pdf', 'docx', 'jpg', 'png', 'JPG', 'PNG', 'rar', 'odt', 'doc', 'gif'])) {
        echo "L'extension de votre fichier doit être .zip, .pdf, .docx, .jpg, .png, .rar, .odt, .doc or .gif ";
        echo "Vous allez être redirigé sur la page d'acceuil.";
            header('Refresh: 8;url=../index.php');
    } elseif ($_FILES['myfile']['size'] > 300000000) { // le fichier ne doit pas dépasser 300 mo
        echo "Fichier trop lourd! 300 mo MAX. " . "\n";
        echo "Vous allez être redirigé sur la page d'acceuil.";
            header('Refresh: 5;url=../index.php');
    } else {
        if (move_uploaded_file($file, $destination)) {
            $sql = "INSERT INTO files (name, size, downloads) VALUES ('$filename', $size, 0)";
            if (mysqli_query($conn, $sql)) {
                echo "L'upload de votre fichier est un succès. " . "\n";
                echo "Vous allez être redirigé sur la page d'acceuil.";
                header('Refresh: 5;url=../index.php');
            }
        } else {
            echo "L'upload de votre fichier est un échec. " . "\n";
            echo "Vous allez être redirigé sur la page d'acceuil.";
            header('Refresh: 5;url=../index.php');
        }
    }
}
