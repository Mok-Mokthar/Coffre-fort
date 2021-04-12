<?php include 'partials/header.php' ?>

    <form class="global" enctype="multipart/form-data" id="loginForm" method="post">
        <div class="errors"></div>
        <input type="email" name="email" placeholder="Email" autocomplete="off" id="email">
        <input type="password" name="password" placeholder="Password" required="required" id="password">
        <input type="submit" value="Se connecter" id="loginFormSubmit">
    </form>

<?php include 'partials/footer.php' ?>