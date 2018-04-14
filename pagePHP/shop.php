<?php
    require 'shop\BDDInteraction.php';
?>
<!DOCTYPE html>
<html id="top">

    <head>
        <title> Boutique </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
    </head>

    <body>
        <?php include 'nav.php'; ?>

        <section>
            <?php
                require 'shop\fillShop.php';
                if (isset($_POST['research']) AND $_POST['research'] != '')
                {
                    researchedShop($_POST['research']);
                    $_POST['research'] = '';
                }
                else if (isset($_POST['category']) AND $_POST['category'] == 1)
                {
                    categorisedShop();
                    $_POST['category'] = 0;
                }
                else if (isset($_POST['price']) AND $_POST['price'] == 1)
                {
                    priceShop();
                    $_POST['price']= 0;
                }
//                else if (isset($_POST['popularity'])AND $_POST['popularity'] == 1)
//                {
//                    getGoodiesByCategory();
//                }
                else
                {
                    normalShop();
                }
            ?>



            <div id="sidebar">
                <button type="button" id="filterButton">Filtrer</button>

                <img src="\projetWeb\imagePNG\boutique\chariot.jpg" alt="Le panier d'achat" title="Le panier" id="basket"/>

                <div id="filter">
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
            </div>

        </section>


        <?php include 'footer.php';  ?>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
