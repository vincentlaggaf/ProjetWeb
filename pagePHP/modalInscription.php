<!DOCTYPE html>
<html id="top">
    <head>
        <title> Inscription </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-modal.css">
    </head>
    <body>
        <div id="inscriptionModal" class="modal">
            <form class="modal-content animate" action="signIn.php" method="post">
                <div class="container">
                    <label for="lastname"><b>Nom</b></label>
                    <input type="text"
                           name="LastName"
                           required>
                    <label for="firstname"><b>Prénom</b></label>
                    <input type="text"
                           name="FirstName"
                           required>
                    <label for="mail"><b>Mail</b></label>
                    <input type="text"
                           name="Mail"
                           size="64" maxLength="64"
                           required
                           placeholder="nom.prenom@viacesi.fr"
                           pattern=".+@viacesi.fr"
                           title="Merci de fournir uniquement une adresse Viacesi">
                    <label for="uname"><b>Nom d'utilisateur</b></label>
                    <input type="text"
                           name="Login"
                           required>
                    <label for="psw"><b>Mot de passe</b></label>
                    <input type="password"
                           name="UserPassword"
                           pattern="^(?=.*\d)(?=.*[A-Z])(?!.*\s).*$"
                           required
                           title="Le mot de passe doit  contenir au moins une majuscule et au moins un chiffre">
                    <button type="submit" class="loginbtn"> S'inscrire </button>
                    <button type="reset" class="cancelbtn" onclick="closeInscriptionModal()"> Annuler </button>
                    <br/><br/>
                    <a href="modalLogin.php"> Déjà un compte ? </a>
                </div>
            </form>
        </div>
        <script>

            document.getElementById('inscriptionModal').style.display='none';
            <?php
            $page = "/projetWeb/pagePHP/modalInscription.php";
            $currentpage = $_SERVER['REQUEST_URI'];
            if($page == $currentpage) {
            ?>
            document.getElementById('inscriptionModal').style.display='block';
            <?php }
            else {
            ?>
            document.getElementById('inscriptionModal').style.display='none';
            <?php }
            ?>
            function closeInscriptionModal() {
                var backPage = document.referrer;
                switch(backPage) {
                    case "":
                        document.getElementById('inscriptionModal').style.display='none';
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/home.php":
                        window.history.back();
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/modalLogin.php":
                        document.location.replace('/projetWeb/pagePHP/home.php');
                        break;
                    case "http://localhost:8888/projetWeb/pagePHP/scriptInscriptionEvent.php":
                        window.history.go(-2);
                        break;
                    default:
                        document.getElementById('inscriptionModal').style.display='none';
                }
            }
        </script>
    </body>
</html>
