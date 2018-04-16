<!--
<!DOCTYPE html>
<html id="top">
    <head>
        <title> Connection </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-modal.css">
    </head>
    <body>
        <div id="logInModal" class="modal">
            <form class="modal-content animate" action="logIn.php" method="post">
                <div class="container">
                    <label for="uname"><b>Nom d'utilisateur</b></label>
                    <input type="text" name="Login">
                    <label for="psw"><b>Mot de passe</b></label>
                    <input type="password" name="UserPassword">
                    <button type="submit" class="loginbtn"> Se connecter </button>
                    <button type="reset" class="cancelbtn" onclick="closeLogInModal()"> Annuler </button>
                    <br/><br/>
                    <a href="modalInscription.php"> Pas encore inscrit ? </a>
                </div>
            </form>
        </div>
        <script>
            document.getElementById('logInModal').style.display='none';
            <?php
            $page = "/projetWeb/pagePHP/modalLogin.php";
            $currentpage = $_SERVER['REQUEST_URI'];
            if($page == $currentpage) {
            ?>
            document.getElementById('logInModal').style.display='block';
            <?php }
            else {
            ?>
            document.getElementById('logInModal').style.display='none';
            <?php }
            ?>
            function closeLogInModal() {
                var backPage = document.referrer;
                switch(backPage) {
                    case "":
                        document.getElementById('logInModal').style.display='none';
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/home.php":
                        window.history.back();
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/modalInscription.php":
                        document.location.replace('/projetWeb/pagePHP/home.php');
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/scriptInscriptionEvent.php":
                        window.history.go(-2);
                        break;
                    default:
                        document.getElementById('logInModal').style.display='none';
                }
            }
        </script>
    </body>
</html>
-->
