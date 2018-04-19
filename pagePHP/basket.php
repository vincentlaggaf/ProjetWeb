<?php
session_start();

//this refuse the access of the page for all the visitors who aren't connected even with the link of this page and send them to the home page
if(!isset($_SESSION['Role']) OR (isset($_SESSION['Role']) AND $_SESSION['Role'] == "Inactif"))
{
    header("Location: \ProjetWeb\pagePHP\home.php");
    exit();
}

require 'BDDConnection.php';
require 'basket\fillBasket.php';
require 'basket\BasketBDDInteraction.php';
require 'sendMail\sendMail.php';
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
                <h1>Panier</h1>
                <?php
                if(isset($_POST['changed']) AND isset($_POST['quantity']))
                {
                    //change the quantity of a goodie
                    setBasket($_SESSION['Id'], $_POST['changed'], $_POST['quantity']);
                }
                else if(isset($_POST['delete']))
                {
                    //delete the whole basket of a visitor
                    deleteBasket($_SESSION['Id']);
                }

                //get the price of all the goodies in the basket
                $totalPrice = getTotalPrice($_SESSION['Id']);

                if(isset($_POST['validate']))
                {
                    try{
                        //send a mail to the BDE members
                        fillOrderMail(getBasketQuery($_SESSION['Id']), $_SESSION['Mail'], $_SESSION['FirstName'], $_SESSION['LastName'], $totalPrice);

                        //put the basket in the order table
                        validateBasket($_SESSION['Id']);
                    }
                    catch(Exception $e){
                        echo 'Exception reçue : ',  $e->getMessage(), "\n";
                    }


                ?>
                <p>Votre commande a été validée, un membre du BDE vous contacteras prochaînement.<br/>En attendant vous pouvez continuer votre navigation sur <a href="\projetWeb\pagePHP\home.php">notre site</a>.<br/>Bonne visite!</p>
                <?php
                }
                else if(!checkBasket($_SESSION['Id']))
                {
                ?>
                <p>Votre panier est vide mais vous pouvez le remplir en retourant à <a href="\projetWeb\pagePHP\shop.php">la boutique</a>!</p>
                <?php
                }
                else
                {
                    //display the basket of the visitor
                    getAndDisplayBasket($_SESSION['Id']);
                ?>
                <p id="price">Prix total : <?php  echo $totalPrice; ?>€</p>
<!--                display the button for the validation or the suppression of the basket-->
                <div id="choiceDiv">
                    <form action="\projetWeb\pagePHP\basket.php" method="post">
                        <input type="hidden" name="delete" value="<?php echo $_SESSION['Id']; ?>">
                        <input type="submit" value="Supprimer" class="choice" id="delete">
                    </form>
                    <form action="\projetWeb\pagePHP\basket.php" method="post">
                        <input type="hidden" name="validate" value="<?php echo $_SESSION['Id']; ?>">
                        <input type="submit" value="Valider" class="choice" id="validate">
                    </form>
                </div>
                <?php
                }
                ?>
            </section>
        </div>

        <?php include 'footer.php'; ?>

    </body>
</html>
