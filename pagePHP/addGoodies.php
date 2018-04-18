<?php
    session_start();
    if(!isset($_SESSION['Role']) OR ((isset($_SESSION['Role']) AND $_SESSION['Role'] != "BDEMember")))
    {
        header("Location: \ProjetWeb\pagePHP\home.php");
        exit();
    }

    require 'BDDConnection.php';
    require 'addGoodies/BDDAddGoodies.php';
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

             <form class="addNewGoodie" action="scriptAddEventOfTheMonth.php" method="post" enctype="multipart/form-data">

                        <div class="goodieBloc">

                            <div class="titleAndPhoto">

                                <textarea rows="2" placeholder="Nom de l'article" name="eventName" class="inputText"></textarea>

                                <div class="photo">
                                    <p id="warningPhoto">Attention le fichier doit faire au maximum 10 Mo!</p>
                                    <input type="file" name="photoOfTheGoodie" id="choosePhoto"/>
                                </div>

                            </div>

                            <textarea rows="10" cols="51" placeholder="Description de l'article" name="eventDescription" class="inputText"></textarea>


                            <select name="goodieCategory">
<!--
                                <option value="test">test</option>
                                <option value="test1">test1</option>
-->
                                <?php
                                chooseCategory();
                                ?>
                            </select>

                            <input type="text" name="price" placeholder="Prix de l'article" id="price"/>


                            <div class="inscriptionButton">
                                <input type="hidden" name="IDEvent" value=""/>
                                <input type="submit" value="Ajouter l'article" name="test"/>
                            </div>

                        </div>

                </form>

            </section>
        </div>
    <?php include('footer.php');?>

    </body>

</html>
