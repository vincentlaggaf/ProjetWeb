<?php
session_start();

//this refuse the access of the page for all the visitors who aren't BDE members even with the link of this page and send them to the home page
if(!isset($_SESSION['Role']) OR ((isset($_SESSION['Role']) AND $_SESSION['Role'] != "BDEMember")))
{
    header("Location: \ProjetWeb\pagePHP\home.php");
    exit();
}

require 'BDDConnection.php';
require 'GoodiesCategory/BDDGoodiesCategory.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title> Ajout de catégorie </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style.css">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-addGoodiesCategory.css">
    </head>

    <body>
        <?php include 'nav.php'; ?>
        <div id="addGoodiesCategoryDiv">
            <section>
                <?php
                if(isset($_POST['newCategory']) AND checkCategory($_POST['newCategory']))
                {
                    //create a new goodies category
                    insertNewCategory($_POST['newCategory']);
                }
                else if(isset($_POST['newCategory']))
                {
                ?>
                <p>Cette catégorie existe déjà!</p>
                <?php
                }
                ?>
                <p>Voici la liste des catégories disponibles.<br/>Merci de vérifier que celle que vous souhaitez ajouter n'existe pas encore.</p>

                <div id="categoryDisplay">
                    <?php
                    //gets all the existing category and displays them
                    getGoodiesCategory();
                    ?>
                </div>

                <div>
                    <form action="\projetWeb\pagePHP\addGoodiesCategory.php" method="post" id="categoryChange">
                        <input type="text" name="newCategory" placeholder="Catégorie" id="newCategory">
                        <input type="submit" value="Valider" id="validation">
                    </form>
                </div>
            </section>
        </div>

        <?php include 'footer.php';  ?>
    </body>
</html>
