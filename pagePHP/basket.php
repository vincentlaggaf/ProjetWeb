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
                    if(isset($_POST['changed']) AND isset($_POST['quantity']))
                    {
                        setBasket($_SESSION['Id'], $_POST['changed'], $_POST['quantity']);
                    }
                    getBasket($_SESSION['Id']);
                    $price = getTotalPrice($_SESSION['Id']);
                }
                echo $price;
                ?>
            </section>
        </div>

        <?php include 'footer.php'; ?>
    </body>
</html>
