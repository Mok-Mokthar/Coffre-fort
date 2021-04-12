<?php

include("../config/bdd.php");
session_start();

$email = $_SESSION['email'];

$sql = 'SELECT COUNT(id) FROM users WHERE email = :email AND reponse = :reponse';
$req = $pdo->prepare($sql);
$req->bindValue(':email', $email);
$req->bindValue(':reponse', strtolower($_POST["responseLostPassword"]));
$req->execute();
if ($req->fetchColumn() == 0) {
    echo 0;
} else {
   echo true;
}










