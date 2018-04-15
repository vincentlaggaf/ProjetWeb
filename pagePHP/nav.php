
<div>
    <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-nav.css">
    <img id="exia" src="/projetWeb/imagePNG/exia.png" alt="logo exia">
    <nav class="table">
        <a href="home.php" class="bouton"> <li> Accueil </li> </a>
        <a href="shop.php" class="bouton"> <li> Boutique </li> </a>
        <a href="#" class="bouton"> <li> Boite à idées </li> </a>
        <a href="eventOfTheMonth.php" class="bouton"> <li> Évènement du mois </li> </a>
        <a href="#" class="bouton"> <li> Évènements passés </li> </a>
        <?php
        if(isset($_SESSION['Login'])){
        ?>
            <a href="/projetWeb/pagePHP/destroySession.php" class="bouton"><li>Déconnexion</li></a>
        <?php
        }
        else {
include ('modalInscription.php');
include ('modalLogin.php');
        ?>
            <button id ="authentificationBtn" onclick="document.getElementById('id01').style.display='block'">
                <img src="/projetWeb/imagePNG/signIn.png" alt="signIn ">
            </button>
            <button id ="authentificationBtn" onclick="document.getElementById('id02').style.display='block'">
                <img src="/projetWeb/imagePNG/logIn.png" alt="logIn ">
            </button>
        <?php
        }
        if(isset($_SESSION['Login']) AND $_SESSION['Role'] == 'BDEMember') {
        ?>
            <a href="/projetWeb/pagePHP/administration.php" class="bouton">
                <img src="/projetWeb/imagePNG/reglage.png" alt="reglage">
            </a>
        <?php
        }
        ?>
    </nav>
</div>
<script>
    document.getElementById('id01').style.display='none';
    document.getElementById('id02').style.display='none';
</script>

