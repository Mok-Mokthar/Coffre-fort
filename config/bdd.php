<?php
// Script connexion.php utilisé pour la connexion à la BD
$host="localhost";
$db="coffre-fort";
$user="root";
$passwd="";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $passwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e) {
    echo "Erreur : ".$e->getMessage()."<br />";
}
?>

