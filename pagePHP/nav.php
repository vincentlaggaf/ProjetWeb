<?php include ('modals.php'); ?>
<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
<!--<link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">-->
<link rel="stylesheet" href="/projetWeb/feuilleCSS/style-nav.css">
<link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
<link rel="stylesheet" href="/projetWeb/feuilleCSS/style-dropdownMenu.css">

<div class="menu">
    <nav>
        <ul class="table">
            <li><img id="exia" src="/projetWeb/imagePNG/exia.png" alt="logo exia"></li>
            <li><a href="home.php" class="bouton">Accueil</a></li>
            <li><a href="shop.php" class="bouton">Boutique</a></li>
            <li><a href="IdeaBox.php" class="bouton">Boite à idées</a></li>
            <li><a href="eventOfTheMonth.php" class="bouton">Évènement du mois</a></li>
            <li><a href="pastEvent.php" class="bouton">Évènements passés</a></li>
            <?php
            if(isset($_SESSION['Login'])){
            ?>
            <li><a href="/projetWeb/pagePHP/destroySession.php" class="bouton">Déconnexion</a> </li>
            <?php }
            else {
            ?>
            <button class="authentificationBtn" onclick="document.getElementById('signInModal').style.display='block'">
                <img src="/projetWeb/imagePNG/signIn.png" alt="signIn ">
            </button>
            <button class="authentificationBtn" onclick="document.getElementById('logInModal').style.display='block'">
                <img src="/projetWeb/imagePNG/logIn.png" alt="logIn ">
            </button>
            <?php }
            if(isset($_SESSION['Login']) AND $_SESSION['Role'] == 'BDEMember') {
            ?>
            <a href="/projetWeb/pagePHP/administration.php" class="bouton">
                <img src="/projetWeb/imagePNG/reglage.png" alt="reglage">
            </a>
            <?php }
            ?>
        </ul>
    </nav>
</div>


<div class="dropdown">
    <button onclick="dropdownFunction()" class="dropbtn">
        <img src="/projetWeb/imagePNG/menuIcon.png" alt="menuIcon">
    </button>
    <div id="myDropdown" class="dropdown-content">
        <a href="home.php">Accueil</a>
        <a href="shop.php">Boutique</a>
        <a href="#">Boite à idées</a>
        <a href="eventOfTheMonth.php">Évènement du mois</a>
        <a href="#">Évènements passés</a>
        <?php if(isset($_SESSION['Login'])){ ?>
        <a href="/projetWeb/pagePHP/destroySession.php" class="bouton">Déconnexion</a>
        <?php } else {
        ?>
        <button class="authentificationBtn" onclick="document.getElementById('signInModal').style.display='block'">
            <img src="/projetWeb/imagePNG/signIn.png" alt="signIn ">
        </button>
        <button class="authentificationBtn" onclick="document.getElementById('logInModal').style.display='block'">
            <img src="/projetWeb/imagePNG/logIn.png" alt="logIn ">
        </button>
        <?php } if(isset($_SESSION['Login']) AND $_SESSION['Role'] == 'BDEMember') { ?>
        <a href="/projetWeb/pagePHP/administration.php" class="bouton"> Administration </a>
        <?php } ?>
    </div>
</div>

<script>
    /* When the user clicks on the button, toggle between hiding and showing the dropdown content */
    function dropdownFunction() {
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

