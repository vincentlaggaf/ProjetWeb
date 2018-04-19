<?php
session_start();

//this refuse the access of the page for all the visitors who aren't BDE members even with the link of this page and send them to the home page
if(!isset($_SESSION['Role']) OR ((isset($_SESSION['Role']) AND $_SESSION['Role'] != "BDEMember")))
{
    header("Location: \ProjetWeb\pagePHP\home.php");
    exit();
}
require 'BDDConnection.php';
require 'addGoodies/scriptAddGoodies.php';
?>

<!DOCTYPE html>
<html>

    <head>
        <title> Ajout article </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-addGoodies.css">
    </head>

    <body>
        <?php  include('nav.php');?>
        <div id=addGoodieDiv>
            <section>
                <?php
                try
                {
                    if(isset($_POST['submit']) AND $_POST['goodieName'] != "" AND $_POST['price'] != "" AND $_POST['goodieDescription'] != "")
                    {
                        if(checkNewGoodieName($_POST['goodieName']))
                        {
                            //get the file sent by the BDE member
                            $fileURL = getFile();
                            if(isset($fileURL))
                            {
                                //add the new goodie with all the informations
                                addNewGoodie($_POST['goodieName'], $fileURL, $_POST['goodieDescription'], $_POST['goodieCategory'], $_POST['price']);
                            }
                            else
                            {
                                ?>
                                <p>Vous n'avez pas choisi de fichier!</p>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <p>Ce nom d'article est déjà pris, veuillez en choisir un autre.</p>
                            <?php
                        }
                    }
                }
                catch(Exception $e)
                {
                    echo 'Exception reçue : ',  $e->getMessage(), "\n";
                }
                ?>
<!--                display the form to fill with all the informations for the new goodie-->
                <form class="addNewGoodie" action="\ProjetWeb\pagePHP\addGoodies.php" method="post" enctype="multipart/form-data">

                    <div class="goodieBloc">

                        <div class="titleAndPhoto">

                            <textarea rows="2" placeholder="Nom de l'article" name="goodieName" class="inputText"></textarea>

                            <div class="photo">
                                <p id="warningPhoto">Attention le fichier doit faire au maximum 10 Mo!</p>
                                <input type="file" name="photoOfTheGoodie" id="choosePhoto"/>
                            </div>

                        </div>

                        <textarea placeholder="Description de l'article" name="goodieDescription" class="inputText"></textarea>


                        <select name="goodieCategory"e id="goodieCategory">
                            <?php
                            //get all the existing categories
                            chooseCategory();
                            ?>
                        </select>

                        <input type="number" name="price"  min="1" placeholder="Prix de l'article" id="price"/>


                        <div>
                            <input type="submit" value="Ajouter l'article" name="submit" id="inscriptionButton"/>
                        </div>

                    </div>

                </form>

            </section>
        </div>
        <?php include('footer.php');?>

    </body>

</html>
