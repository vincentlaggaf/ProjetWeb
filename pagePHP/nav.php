<!DOCTYPE html>
<html>
    <head>
<!--        <title></title>-->
        <meta charset="utf-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
    </head>
    <body>
        <?php include ('modalInscription.php'); ?>
        <?php include ('modalLogin.php'); ?>
        <script>
            document.getElementById('id01').style.display='none';
            document.getElementById('id02').style.display='none';
        </script>

        <img id="exia" src="/projetWeb/imagePNG/exia.png" alt="logo exia">
        <nav class="table">
            <a href="shop.php" class="bouton"> <li> Boutique </li> </a>
            <a href="#" class="bouton"> <li> Boite à idées </li> </a>
            <a href="eventOfTheMonth.php" class="bouton"> <li> Évènement du mois </li> </a>
            <a href="#" class="bouton"> <li> Évènements passés </li> </a>

            <!--  <button id ="authentificationBtn" onclick="document.getElementById('id02').style.display='block'">-->
            <button id ="authentificationBtn" onclick="document.getElementById('id02').style.display='block'">
                <img src="/projetWeb/imagePNG/logIn.png" alt="logIn ">
            </button>

            <button id ="authentificationBtn" onclick="document.getElementById('id01').style.display='block'">
                <img src="/projetWeb/imagePNG/signIn.png" alt="signIn ">
            </button>

            <a href="/projetWeb/pagePHP/administration.php" class="bouton"> <li> + </li> </a>
        </nav>


    </body>
</html>
