<link rel="stylesheet" href="/projetWeb/feuilleCSS/style-modal.css">

<!--div that contains the pop-up for the logIn-->
<div id="logInModal" class="modal">
    <form class="modal-content animate" action="logIn.php" method="post">
        <div class="container">
            <label for="uname"><b>Nom d'utilisateur</b></label>
            <input type="text" name="Login" required>
            <label for="psw"><b>Mot de passe</b></label>
            <input type="password" name="UserPassword" required>
            <button onclick="closeLogInModal()"> Pas encore inscrit ?</button>
             <br/><br/>
            <button type="submit" class="loginbtn"> Se connecter </button>
            <button type="reset" class="cancelbtn" onclick="document.getElementById('logInModal').style.display='none';">Annuler</button>
        </div>
    </form>
</div>

<!--div that contains the pop-up for the signIn-->
<div id="signInModal" class="modal">
    <form name="formulaireSignIn" class="modal-content animate" action="signIn.php" onSubmit="return checkformSignIn()" method="post">
        <div class="container">
            <label for="lastname"><b>Nom</b></label>
            <input type="text" name="LastName" required>
            <label for="firstname"><b>Prénom</b></label>
            <input type="text" name="FirstName" required>
            <label for="mail"><b>Mail</b></label>
            <input type="text" name="Mail" size="64" maxLength="64" required placeholder="nom.prenom@viacesi.fr"
                   pattern="^[a-zA-Z0-9]+[.]?[a-zA-Z0-9]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)+$">
            <label for="uname"><b>Nom d'utilisateur</b></label>
            <input type="text" name="Login" required>
            <label for="psw"><b>Mot de passe</b></label>
            <input id="mdp1" type="password" name="UserPassword" pattern="^(?=.*\d)(?=.*[A-Z])(?!.*\s).*$" required
                   title="Le mot de passe doit  contenir au moins une majuscule et au moins un chiffre">
            <label for="psw2"><b>Mot de passe (vérification)</b></label>
            <input type="password" name="UserPassword2" required title="Veuillez remettre le même mot de passe">
            <button onclick="closeSignInModal()">Déjà un compte ?</button>
            <br/><br/>
            <button type="submit" class="loginbtn"> S'inscrire </button>
            <button type="reset" class="cancelbtn"  onclick="document.getElementById('signInModal').style.display='none';">Annuler</button>
        </div>
    </form>
</div>

<script>

    function closeSignInModal() {
        document.getElementById('signInModal').style.display='none';
        document.getElementById('logInModal').style.display='block';
    }
    function closeLogInModal() {
        document.getElementById('logInModal').style.display='none';
        document.getElementById('signInModal').style.display='block';
    }

    function checkformSignIn() {
        if(document.formulaireSignIn.UserPassword.value != document.formulaireSignIn.UserPassword2.value) {
            alert("mots de passe différents");
            return false;
        }
        else {
            return true;
        }
    }
</script>
