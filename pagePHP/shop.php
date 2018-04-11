<?php
    session_start();
    try
        {
            $bdd = new PDO('mysql:host=178.62.4.64;dbname=test_boutique_lav;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }
?>
<!DOCTYPE html>
<html id="top">

    <head>
        <title> Boite à Idées </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">




    </head>

    <body>
        <!--        <header> </header> -->

        <img id="exia" src="\ProjetWeb\imagePNG\exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">


                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="\ProjetWeb\imagePNG\Menu_icon.png" alt="signIn ">
                </button>
            </nav>
        </div>



        <section id="corps">
            <p id="p_picture">
            <?php

                $reponse = $bdd->query('SELECT NameGoodies, URL FROM Goodies') or die(print_r($bdd->errorInfo()));
                while ($donnees = $reponse->fetch())
                {
            ?>


                   <img src="<?php echo $donnees['URL']; ?>" alt="<?php echo $donnees['NameGoodies']; ?>" title="<?php echo $donnees['NameGoodies']; ?>" class="shop-picture"/>


            <?php
                }
                $reponse->closeCursor(); // Termine le traitement de la requête
            ?>
            </p>
            <div class="goodies_information">
                <div class="goodies_information_part">
                    <img src="\projetWeb\imagePNG\boutique\t-shirt.jpg" alt="t-shirt" title="t-shirt" class="goodies-picture"/>
                    <div class="info_goodies info_goodies_margin">nom</div>
                    <div class="info_goodies info_goodies_margin">catégorie</div>
                    <div class="info_goodies info_goodies_margin">prix</div>
                </div>
                <div class="goodies_information_part">
                    <div class="info_goodies info_goodie_description info_goodies_margin">St Graal du développeur web, le centrage vertical et horizontal peut d'ailleurs être obtenu encore plus facilement. Dites que votre conteneur est une flexbox et établissez des marges automatiques sur les éléments à l'intérieur. C'est tout ! Essayez !</div>
                </div>
                <div class="goodies_information_part goodies_information_part_position">
                    <div class="info_goodies">acheter</div>
                    <div class="info_goodies">supprimer</div>
                </div>
            </div>
            <script>




            </script>






        </section>


        <footer id="bas">
             <div id="logoContact">
                <img src="\ProjetWeb\imagePNG\www.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\mail.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\facebook.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\github.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
                <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>

        </footer>

    </body>
</html>
