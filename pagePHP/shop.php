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
<!--        div wich contains all the goodies sold in the shop-->
        <div id="shopDiv">
            <section>
                <?php
                $role = roleCheck();

                if (isset($_POST['research']) AND $_POST['research'] != '')
                {
                    //look if the research is correct
                    $check = researchCheck($_POST['research']);
                }
                else if (isset($_POST['delete']))
                {
                    //delete a goodie
                    deleteGoodie($_POST['delete']);
                }
                else if (isset($_POST['buy']) AND $_POST['quantity'] AND isset($_SESSION['Id']) AND $role != "Visitor")
                {
                    //add the goodies to the basket
                    addGoodieToBasket($_SESSION['Id'], $_POST['buy'], $_POST['quantity']);
                }
                ?>
                <p>Voici une sélection de nos articles les plus vendus :</p>
                <div id="popularGoodies">
                    <?php
                    //get the three most sold goodies and display them
                    getPopularGoodies();
                    ?>
                </div>
                <p>Voici la liste des articles que nous proposons dans notre boutique :</p>
                <article>
                    <?php
                    if (isset($check) AND $check)
                    {
                        //if the research is correct get the results of the research and display them
                        researchedShop($_POST['research']);
                        $_POST['research'] = '';
                    }
                    else if (isset($_POST['category']) AND $_POST['category'] == 1)
                    {
                        //get and display the goodies by category
                        categorisedShop();
                        $_POST['category'] = 0;
                    }
                    else if (isset($_POST['price']) AND $_POST['price'] == 1)
                    {
                        //get and display the goodies by price
                        priceShop();
                        $_POST['price'] = 0;
                    }
                    else if (isset($_POST['popularity'])AND $_POST['popularity'] == 1)
                    {
                        //get and display the goodies by popularity
                        getGoodiesByPopularity();
                        $_POST['popularity'] = 0;
                    }
                    else
                    {
                        //get and display all the goodies
                        normalShop();
                    }
                    ?>
                </article>
        </section>
        </div>

<!--        The sidebar for the several sorts-->
        <div id="sidebar">
            <button type="button" id="filterButton">Filtrer</button>
            <?php
            //if the visitor is connected, it allows him to go ti his basket
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
<!--the several input to sort the goodies-->
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
                //add the administrator's button to add categories or goodies
                if($role == "BDEMember")
                {
                    ?>
                    <p>Ajouter un Article</p>
                    <form action="\projetWeb\pagePHP\addGoodies.php" method="post">
                        <input type="submit" value="Ajouter">
                    </form>
                    <p>Ajouter une Catégorie :</p>
                    <form action="\projetWeb\pagePHP\addGoodiesCategory.php" method="post">
                        <input type="submit" value="Ajouter">
                    </form>
                    <?php
                }
                ?>
            </div>
            <a href="download.php">testetstetstt</a>
        </div>

        <?php include 'footer.php';  ?>

<!--the script to display the description of the goodies-->
        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
