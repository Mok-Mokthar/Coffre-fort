<?php include 'partials/header.php' ?>

    <form class="global" id="lostPasswordForm" method="post">
        <div class="errors"></div>
        <div class="inputsLostPassword">
            <input type="email" name="emailLostPassword" placeholder="Email" autocomplete="off" id="emailLostPassword">
        </div>
        <input type="submit" value="Afficher ma question secrète" id="lostPasswordFormSubmit">
    </form>

<?php include 'partials/footer.php' ?>