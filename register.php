<?php include 'partials/header.php' ?>

<!DOCTYPE html>
 <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">        
    </head>
    <body>
        <?php
            $questions = [
                [
                    "question" => 'Dans quelle ville êtes-vous né ?'
                ],
                [
                    "question" => 'Quel est votre film favori ?'
                ],
                [
                    "question" => 'Quelle est la marque de votre première voiture ?'
                ],
            ];
        ?>
        
        <form class="global" enctype="multipart/form-data" id="registerForm" method="post">
            <h2>Coffre-Fort Register</h2>
            <div class="errors"></div>
            <input type="email" name="email" placeholder="Email" autocomplete="off" id="email">
            <input type="text" name="username" placeholder="Username" required="required" autocomplete="off" id="username">
            <input type="password" name="password" placeholder="Password" required="required" id="password">
            <input type="password" name="cpassword" placeholder="Confirm your password" required="required" id="cpassword">
            <h3>Photo de profil</h3>
            <input type="file" id="file_img" required="required" autocomplete="off" name="image"/>
            <h3>Question secrète</h3>
            <select name="secretQuestions" div="grid">
                <?php foreach ($questions as $question){
                    echo '<option value="'.$question['question'].'">'.$question['question'].'</option>';
                }
                ?>
            </select>
            <input type="text" required="required" autocomplete="off" name="responseSecretQuestion" id="responseSecretQuestion" placeholder="Votre réponse"/>
            <input type="submit" value="S'enregistrer" id="registerFormSubmit">
        </form>
    </body>
</html>





<?php include 'partials/footer.php' ?>