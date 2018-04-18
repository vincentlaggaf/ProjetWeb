<?php
    session_start();

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
                <?php
                if(isset($_POST['changed']) AND isset($_POST['quantity']))
                {
                    setBasket($_SESSION['Id'], $_POST['changed'], $_POST['quantity']);
                }
                else if(isset($_POST['delete']))
                {
                    deleteBasket($_SESSION['Id']);
                }


                if(isset($_POST['validate']))
                {
                    $totalPrice = getTotalPrice($_SESSION['Id']);
                    try{
                        fillOrderMail(getBasketQuery($_SESSION['Id']), $_SESSION['Mail'], $_SESSION['FirstName'], $_SESSION['LastName'], $totalPrice);

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
                    getAndDisplayBasket($_SESSION['Id']);
                    $price = getTotalPrice($_SESSION['Id']);
                    ?>
                    <p id="price">Prix total : <?php  echo $price; ?>€</p>
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
