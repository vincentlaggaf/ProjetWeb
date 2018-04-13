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


        <!-- AUTHENTIFICATION  -->
        <div id="id02" class="modal">
            <form class="modal-content animate" action="logIn.php" method="post">
                <div class="container">

                    <label for="uname"><b>Nom d'utilisateur</b></label>
                    <input type="text" name="Login">

                    <label for="psw"><b>Mot de passe</b></label>
                    <input type="text" name="UserPassword">

                    <button type="submit" class="loginbtn"> Se connecter </button>

                    <button type="button" class="cancelbtn" onclick="document.getElementById('id02').style.display='none'"> Annuler </button>
                </div>
            </form>
        </div>
    </body>
</html>
