<?php

include("../config/bdd.php");

$email = $_POST['email'];
$password = $_POST['password'];

$sql = 'SELECT * FROM users WHERE email = :email';
$req = $pdo->prepare($sql);
$req->bindValue(':email', $email);
$req->execute();
while($row = $req->fetch()) {
    $hash = $row['password'];
    $verify = password_verify($password, $hash);
    if ($verify === true){
        session_start();
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['avatar'] = $row['image'];
    }
    echo $verify;
}









