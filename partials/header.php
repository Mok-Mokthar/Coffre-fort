<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/main.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LdD9VcaAAAAAFqaEkqCHEu-zgIQOGX6Rv21njv8"></script>
    <title>Coffre-Fort</title>
</head>
<body>
<?php session_start() ?>


    <?php
    if (isset($_SESSION['id'])){
        ?>
        <span><?= $_SESSION['username']?></span>
        <img src="<?php echo './uploads/avatar/' . $_SESSION['avatar']?>"/>
   <?php } ?>
