<?php
    session_start();
    require 'shop/BDDInteraction.php';
    require 'BDDConnection.php';
    require 'shop/fillShop.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title> Boutique </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
    </head>

    <body>
        <?php include 'nav.php';

        ?>
        <div id="shopDiv">
            <section>
                <?php
                $role = roleCheck();
                if (isset($_POST['research']) AND $_POST['research'] != '')
                {
                    $check = researchCheck($_POST['research']);
                }
                else if (isset($_POST['delete']))
                {
                    deleteGoodie($_POST['delete']);
                }
                else if (isset($_POST['buy']) AND $_POST['quantity'] AND isset($_SESSION['Id']) AND $role != "Visitor")
                {
                    addGoodieToBasket($_SESSION['Id'], $_POST['buy'], $_POST['quantity']);
                }
                ?>
                <p>Voici une sélection de nos articles les plus vendus :</p>
                <div id="popularGoodies">
                    <?php
                    getPopularGoodies();
                    ?>
                </div>
                <p>Voici la liste des articles que nous proposons dans notre boutique :</p>
                <article>
                <?php
                    if (isset($check) AND $check)
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
                        $_POST['price'] = 0;
                    }
                    else if (isset($_POST['popularity'])AND $_POST['popularity'] == 1)
                    {
                        getGoodiesByPopularity();
                        $_POST['popularity'] = 0;
                    }
                    else
                    {
                        normalShop();
                    }
                    ?>
                </article>
            </section>
        </div>

        <div id="sidebar">

            <button type="button" id="filterButton">Filtrer</button>
            <?php
            if($role != "Visitor" AND $role != "Inactif")
            {
            ?>
                <a href="basket.php"><img src="\projetWeb\imagePNG\boutique\chariot.jpg" alt="Le panier d'achat" title="Le panier" id="basket"/></a>
            <?php
            }
            else
            {
            ?>
                <img src="\projetWeb\imagePNG\boutique\chariot.jpg" alt="Le panier d'achat" title="Le panier" id="basket"/>
            <?php
            }
            ?>

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
                <?php
                if($role == "BDEMember")
                {
                ?>
                    <p>Ajouter</p>
                <?php
                }
                ?>
            </div>
        </div>

        <?php include 'footer.php';  ?>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
