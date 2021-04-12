<?php

include("../config/bdd.php");
$email = $_POST['emailLostPassword'];

$sql = 'SELECT COUNT(id) FROM users WHERE email = :email';
$req = $pdo->prepare($sql);
$req->bindValue(':email', $email);
$req->execute();
if ($req->fetchColumn() == 0) {
    echo 0;
} else {
    $sql = 'SELECT question FROM users WHERE email = :email';
    $req = $pdo->prepare($sql);
    $req->bindValue(':email', $email);
    $req->execute();
    while($row = $req->fetch()) {
        session_start();
        $_SESSION["email"] = $email;
        echo $row['question'];
    }
}










