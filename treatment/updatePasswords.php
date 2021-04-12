<?php

include("../config/bdd.php");
session_start();

$email = $_SESSION['email'];
$password = $_POST['newPassword'];
$password = password_hash($password, PASSWORD_BCRYPT);

$sql = 'UPDATE users SET password = :password WHERE email = :email';
$req = $pdo->prepare($sql);
$req->bindValue(':email', $email);
$req->bindValue(':password', $password);
if ($req->execute()) {
    $sql = 'SELECT * FROM users WHERE email = :email';
    $req = $pdo->prepare($sql);
    $req->bindValue(':email', $email);
    $req->execute();
    while ($row = $req->fetch()) {
        $hash = $row['password'];
        $verify = password_verify($password, $hash);
        $_SESSION['id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['avatar'] = $row['image'];
    }
    echo true;
}else echo false;













