<!DOCTYPE html>
<html id="top">

    <head>
        <title> accueil </title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
    </head>

    <body>

        <!--   CRÉATION D'UN COMPTE         -->
        <div id="id01" class="modal">
            <form class="modal-content animate" action="signIn.php" method="post">
                <div class="container">

                    <label for="name"><b>Nom</b></label>
                    <input type="text" name="LastName">

                    <label for="firstname"><b>Prénom</b></label>
                    <input type="text" name="FirstName">

                    <label for="mail"><b>Adresse email</b></label>
                    <input type="text" name="Mail">

                    <label for="uname"><b>Nom d'utilisateur</b></label>
                    <input type="text" name="Login">

                    <label for="psw"><b>Mot de passe</b></label>
                    <input type="text" name="UserPassword">

                    <button type="submit" class="loginbtn"> S'inscrire </button>

                    <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'"> Annuler </button>
                </div>
            </form>
        </div>

    </body>
</html>
