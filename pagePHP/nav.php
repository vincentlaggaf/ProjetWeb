<?php
include ('modalInscription.php');
include ('modalLogin.php');
?>
<link rel="stylesheet" href="/projetWeb/feuilleCSS/style-nav.css">
<link rel="stylesheet" href="/projetWeb/feuilleCSS/style-dropdownMenu.css">

<div class="menu">
    <nav>
        <ul class="table">
            <li><img id="exia" src="/projetWeb/imagePNG/exia.png" alt="logo exia"></li>
            <li><a href="home.php" class="bouton">Accueil</a></li>
            <li><a href="shop.php" class="bouton">Boutique</a></li>
            <li><a href="#" class="bouton">Boite à idées</a></li>
            <li><a href="eventOfTheMonth.php" class="bouton">Évènement du mois</a></li>
            <li><a href="#" class="bouton">Évènements passés</a></li>
            <?php
            if(isset($_SESSION['Login'])){
            ?>
            <li><a href="/projetWeb/pagePHP/destroySession.php" class="bouton">Déconnexion</a> </li>
            <?php
            }
            else {
            ?>

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
>>>>>>> origin/master
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
        </ul>
    </nav>
</div>


<div class="dropdown">
    <button onclick="myFunction()" class="dropbtn">
        menu
<!--                <img src="/projetWeb/imagePNG/Menu_icon.png" alt="menu">-->
</button>
<!--    <input type="button" onclick="myFunction()" class="dropbtn" src="/projetWeb/imagePNG/Menu_icon.png"/>-->
    <div id="myDropdown" class="dropdown-content">
        <a href="home.php">Accueil</a>
        <a href="shop.php">Boutique</a>
        <a href="#">Boite à idées</a>
        <a href="eventOfTheMonth.php">Évènement du mois</a>
        <a href="#">Évènements passés</a>
        <?php if(isset($_SESSION['Login'])){ ?>
        <a href="/projetWeb/pagePHP/destroySession.php" class="bouton">Déconnexion</a>
        <?php } else { ?>
        <button onclick="document.getElementById('id01').style.display='block'">
            Inscription
        </button>
        <button onclick="document.getElementById('id02').style.display='block'">
            Connection
        </button>
        <?php } if(isset($_SESSION['Login']) AND $_SESSION['Role'] == 'BDEMember') { ?>
        <a href="/projetWeb/pagePHP/administration.php" class="bouton"> Administration </a>
        <?php } ?>
    </div>
</div>

<script>
    document.getElementById('id01').style.display='none';
    document.getElementById('id02').style.display='none';
    /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>

