<?php
    session_start();
    require 'BDDConnection.php';
    require 'basket\fillBasket.php';
    require 'basket\BasketBDDInteraction.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title> Panier </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-basket.css">
    </head>

    <body>
        <?php include 'nav.php'; ?>
        <div id="basketDiv">
            <section>
                <?php
                if (isset($_SESSION['Id'])){

                basket($_SESSION['Id']);
                }
                ?>
            </section>
        </div>

        <?php include 'footer.php';  ?>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
