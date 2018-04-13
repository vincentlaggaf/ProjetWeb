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
                    <button type="reset" class="cancelbtn" onclick="test()"> Annuler </button>
                    <a href="modalInscription.php"> Pas encore inscrit ? </a>
                </div>
            </form>
        </div>
        <script>

            <?php
            $homepage = "/projetWeb/pagePHP/home.php";
            $currentpage = $_SERVER['REQUEST_URI'];
            if($homepage==$currentpage) {
            ?>
            document.getElementById('id02').style.display='none';
            <?php
            }
            else {
            ?>
            document.getElementById('id02').style.display='block';
            <?php
            }
            ?>

            function test() {
                //   document.getElementById('id02').style.display='none';
                var backPage = document.referrer;
                switch(backPage) {
                    case "":
                        alert("case : vide");
                        document.getElementById('id02').style.display='none';
                        break;

                    case "http://localhost:8888/projetWeb/pagePHP/home.php":
                        alert("case : http://localhost:8888/projetWeb/pagePHP/home.php");
                        window.history.back();
                        break;

                    case "http://localhost:8888/projetWeb/pagePHP/modalInscription.php":
                        document.location.replace('/projetWeb/pagePHP/home.php');
                        break;

                    case "http://localhost:8888/projetWeb/pagePHP/scriptInscriptionEvent.php":
                        alert("case : scriptInscriptionEvent");
                        window.history.go(-2);
                        break;

                    default:
                        alert("case : default");
                        document.getElementById('id02').style.display='none';
                        //window.history.back();
                }
            }
        </script>
    </body>
</html>
