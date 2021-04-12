<?php

include("../config/bdd.php");

$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$question = $_POST['secretQuestions'];
$reponse = strtolower($_POST['responseSecretQuestion']);
$password = password_hash($password, PASSWORD_BCRYPT);

$file_name = date('YmdHis').$_FILES['image']['name'];
$file_tmp = $_FILES['image']['tmp_name'];
$file_dest = '../uploads/avatar/'. $file_name;
move_uploaded_file($file_tmp, $file_dest);

$sql = 'SELECT COUNT(id) FROM users WHERE email = :email';
$req = $pdo->prepare($sql);
$req->bindValue(':email', $email);
$req->execute();
if ($req->fetchColumn() == 0) {
    $sql = "INSERT INTO users (id, email, username, password, image, question, reponse) VALUES (NULL, '$email', '$username', '$password', '$file_name', '$question', '$reponse')";
    $query = $pdo->prepare($sql);
    if($query->execute()){
        session_start();
        $_SESSION['id'] = $pdo->lastInsertId();
        $_SESSION['username'] = $username;
        $_SESSION['email'] = $email;
        $_SESSION['avatar'] = $file_name;
        echo true;
    }
    else echo 'error';
}else{
    echo 303;
}







