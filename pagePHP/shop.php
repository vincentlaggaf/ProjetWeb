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
            <?php

                $reponse = $bdd->query('SELECT NameGoodies, URL FROM Goodies') or die(print_r($bdd->errorInfo()));
                while ($donnees = $reponse->fetch())
                {

            ?>

               <p>
                   <img src="<?php echo $donnees['URL']; ?>" alt="<?php echo $donnees['NameGoodies']; ?>" title="<?php echo $donnees['NameGoodies']; ?>" class="shop-picture"/>
               </p>

            <?php
                }
                $reponse->closeCursor(); // Termine le traitement de la requête
            ?>
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
