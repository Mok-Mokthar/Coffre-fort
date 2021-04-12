(function ($) {
    $(document).ready(function () {

        $("form#registerForm").submit(function(e) {
            e.preventDefault();
            resetErrors();

            let email = $('#email').val();
            let username = $('#username').val();
            let password = $('#password').val();
            let cpassword = $('#cpassword').val();
            let responseSecretQuestion = $('#responseSecretQuestion').val();
            let fileExtension = $('#file_img').val().split('.').pop();


            let emailRGEX = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;
            let passwordRGEX = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            let usernameRGEX = /^[a-zA-Z0-9_-]{3,}$/;
            let responseSecretQuestionRGEX = /^[a-zA-Z0-9 ]+$/;
            let allowedExtensions = ["jpg", "JPG", "png", "PNG", 'JPEG'];

            emailRGEX = emailRGEX.test(email);
            passwordRGEX = passwordRGEX.test(password);
            usernameRGEX = usernameRGEX.test(username);
            responseSecretQuestionRGEX = responseSecretQuestionRGEX.test(responseSecretQuestion);
            allowedExtensions = allowedExtensions.includes(fileExtension);

            let countErrors = 0;

            if (emailRGEX === false) {
                displayErrors('L\'addresse email fourni n\'est pas valide');
                countErrors++;
            }
            if (usernameRGEX === false) {
                displayErrors('Le nom d\'utilisateur fourni n\'est pas valide');
                countErrors++;
            }
            if (passwordRGEX === false) {
                displayErrors('Les mots de passe ne sont pas au bon format');
                countErrors++;
            }
            if (cpassword !== password) {
                displayErrors('Les mots de passe ne correspondent pas');
                countErrors++;
            }
            if (allowedExtensions === false) {
                displayErrors('Ce type de fichier n\'est pas accepté');
                countErrors++;
            }
            if (responseSecretQuestionRGEX === false) {
                displayErrors('La réponse à la question secrète n\'est pas valide');
                countErrors++;
            }
            if (countErrors > 0) {
                return
            } else {
                //Tout est ok on peut valider
                let file_data = $('#file_img').prop('files')[0];
                let data = new FormData(this);
                data.append('file', file_data);

                recaptacha(function (result) {
                    if( result === true){
                        registerUser(data);
                    }else {
                        displayErrors('Vous n\'êtes pas autorisé à soumettre ce formulaire');
                    }
                });
                //
            }
        });


        function displayErrors(error) {
            $('.errors').append('<p>' + error + '</p>');
        }

        function resetErrors() {
            $('.errors').html('');
        }

        function registerUser(data) {
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                url: 'treatment/register.php',
                success: function (retour) {
                    console.log(retour);
                    if (retour == 1){
                        window.location.href='./index.php';
                    }else{
                        if (retour == 303){
                            displayErrors('Cette addresse mail est déjà utilisée');
                        }else {
                            displayErrors('Erreur de connection à la base de données');
                        }
                    }
                }
            })
        }


        function recaptacha(callback) {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdD9VcaAAAAAFqaEkqCHEu-zgIQOGX6Rv21njv8', {action: 'submit'}).then(function(token) {
                    // Add your logic to submit to your backend server here.
                    var data = {'secret': '6LdD9VcaAAAAAGk55Ts6WuqkM1j73FnVCX3xxw0P', 'response': token};
                    $.ajax({
                        type: "POST",
                        data: data,
                        url: 'https://cors-anywhere.herokuapp.com/https://www.google.com/recaptcha/api/siteverify',
                        success: function (retour) {
                            callback(retour.score > 0.7);
                        }
                    });
                });
            });
        }






        $('#disconnect').click(function (e) {
            e.preventDefault();
            let data = {"Action":'disconnect'}
            $.ajax({
                type: "POST",
                data: data,
                url: 'treatment/disconnect.php',
                success: function (retour) {
                    window.location.href='./index.php';
                }
            })
        });


        $("form#loginForm").submit(function(e) {
            e.preventDefault();
            resetErrors();

            let email = $('#email').val();
            let password = $('#password').val();

            let emailRGEX = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;
            let passwordRGEX = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;

            emailRGEX = emailRGEX.test(email);
            passwordRGEX = passwordRGEX.test(password);

            let countErrors = 0;

            if (emailRGEX === false) {
                displayErrors('L\'addresse email fourni n\'est pas valide');
                countErrors++;
            }
            if (passwordRGEX === false) {
                displayErrors('Le mots de passe entré n\'est pas au bon format');
                countErrors++;
            }
            if (countErrors > 0) {
                return
            } else {
                //Tout est ok on peut valider
                let data = new FormData(this);
                loginUser(data);
            }
        });

        function loginUser(data) {
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                url: 'treatment/login.php',
                success: function (retour) {
                    if (retour == 1){
                        window.location.href='./index.php';
                    }else{
                        displayErrors('Les informations soumises ne sont pas valides');
                    }
                }
            })
        }



        $("form#lostPasswordForm").submit(function(e) {
            e.preventDefault();
            resetErrors();

            // Première étape -> validation de l'email + affichage de la question
            if ($('#emailLostPassword').length){

                let data = new FormData(this);
                let email = $('#emailLostPassword').val();
                let emailRGEX = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,4}$/;

                emailRGEX = emailRGEX.test(email);

                if (emailRGEX === false) {
                    displayErrors('L\'addresse email fourni n\'est pas valide');
                }else {
                    emailExist(data, function (retour) {
                        if (retour != false){
                            $('#emailLostPassword').remove();
                            $('.inputsLostPassword').append('<p id="textQuestionLostPassword">'+retour+'</p><input type="text" name="responseLostPassword" id="responseLostPassword" placeholder="votre reponse">');
                            $('#lostPasswordFormSubmit').val("valider ma réponse");
                        }else {
                            displayErrors('L\'addresse email fourni n\'est pas connue');
                        }
                    });
                }
            }

            // 2 ème étape, validation de la réponse + affichage du formualaire de changement de mot de passe
            if ($('#responseLostPassword').length){
                let data = new FormData(this);
                let responseSecretQuestion = $('#responseLostPassword').val();

                let responseSecretQuestionRGEX = /^[a-zA-Z0-9 ]+$/;
                responseSecretQuestionRGEX = responseSecretQuestionRGEX.test(responseSecretQuestion);

                if (responseSecretQuestionRGEX === false) {
                    displayErrors('La réponse à la question secrète n\'est pas valide');
                }else {
                    reponseTest(data, function (retour) {
                        if (retour == true){
                            $('#textQuestionLostPassword').remove();
                            $('#responseLostPassword').remove();
                            $('.inputsLostPassword').append('<input type="password" name="newPassword" id="newPassword" placeholder="nouveau mot de passe"><input type="password" name="newPasswordVerif" id="newPasswordVerif" placeholder="confirmer le mot de passe">');
                            $('#lostPasswordFormSubmit').val("changer mon mot de passe");
                        }else {
                            displayErrors('La réponse à la question secrète n\'est pas valide');
                        }
                    });
                }
            }

            // 3 ème étape, validation des mots de passe et changement dans la bdd
            if ($('#newPassword').length){
                let data = new FormData(this);

                let password = $('#newPassword').val();
                let cpassword = $('#newPasswordVerif').val();

                let passwordRGEX = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
                let  countErrors = 0;
                if (passwordRGEX === false) {
                    displayErrors('Les mots de passe ne sont pas au bon format');
                    countErrors++;
                }
                if (cpassword !== password) {
                    displayErrors('Les mots de passe ne correspondent pas');
                    countErrors++;
                }if (countErrors > 0) {
                    return
                }else {
                    updatePasswords(data, function (retour) {
                        if (retour == true){
                            window.location.href='./index.php';
                        }else {
                            displayErrors('Erreur de connection à la base de données');
                        }
                    });
                }
            }



        });

        function emailExist(data, callback) {
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                url: 'treatment/emailExist.php',
                success: function (retour) {
                    if (retour == 0){
                        callback(false);
                    }else callback(retour);
                }
            })
        }

        function reponseTest(data, callback) {
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                url: 'treatment/responseTest.php',
                success: function (retour) {
                   callback(retour);
                }
            })
        }

        function updatePasswords(data, callback) {
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                cache: false,
                contentType: false,
                url: 'treatment/updatePasswords.php',
                success: function (retour) {
                    callback(retour);
                }
            })
        }


    });
})
(jQuery);

