<?php
    require 'shop\BDDInteraction.php';
?>
<!DOCTYPE html>
<html id="top">

    <head>
        <title> Boite à Idées </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">
    </head>

    <body>
        <img id="exia" src="\ProjetWeb\imagePNG\exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">
                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="\ProjetWeb\imagePNG\Menu_icon.png" alt="signIn ">
                </button>
            </nav>
        </div>

        <section>
            <?php
                require 'shop\fillShop.php';
                if (isset($_POST['research']) AND $_POST['research'] != '')
                {
                    researchedShop($_POST['research']);
                    $_POST['research'] = '';
                }
                else if (isset($_POST['category']) AND $_POST['category'] != 0)
                {
                    categorisedShop();
                    $_POST['category'] = 0;
                }
                else if (isset($_POST['price']) AND $_POST['price'] != 0)
                {
                    priceShop();
                    $_POST['price']= 0;
                }
//                else if (isset($_POST['popularity']))
//                {
//                    getGoodiesByCategory();
//                }
                else
                {
                    normalShop();
                }
            ?>
            <div id="sidebar">
                <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="text" name="research" placeholder="Recherche"/>
                    <input type="submit" value="Valider" />
                </form>
                <p>Filtres :</p>
                    <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="hidden" name="category" value="1">
                    <input type="submit" value="Catégorie">
                    </form>
                <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="hidden" name="price" value="1">
                    <input type="submit" value="Prix">
                    </form>
                <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="hidden" name="popularity" value="1">
                    <input type="submit" value="Popularité">
                </form>
                <p>Ajouter</p>
            </div>
        </section>

        <footer id="bas">
             <div id="logoContact">
                <img src="\ProjetWeb\imagePNG\www.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\mail.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\facebook.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\github.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
            <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>
        </footer>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
