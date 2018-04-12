<?php
    session_start();
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=ProjetWeb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
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
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-IdeaBox.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">




    </head>

    <body>
        <!--        <header> </header> -->

        <img id="exia" src="\projetWeb\imagePNG\exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">


                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="\projetWeb\imagePNG\Menu_icon.png" alt="signIn ">
                </button>
            </nav>
        </div>



        <section id="corps">

            <?php
                $getIdea=$bdd->query('SELECT NameEvent,Description,IDEvent FROM Happenings WHERE Validate="NULL"');
                while( $donnees=$getIdea->fetch())
                    {

                    }


                ?>




            <form class="addNewEvent" action="scriptNewEvent.php" method="post">
            <fieldset class="event">
                <legend class="eventNumber">Proposez votre idée</legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title">
                        <input   type="text" name="title"  maxlength="20"  placeholder="Titre"/>
                    </div>

                    <div class="photo">
                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    </div>

                    <div class="eventDescription">
                        <textarea style="resize:none" rows="12" cols="50" placeholder="Description"></textarea>
                    </div>

                    <div class="inscriptionButton">
                        <input type="submit" value="Publier !" />
                    </div>


            </div>

    </fieldset>


    </form>

            <div><p class="bar">Dernières Idées</p>
            </div>



             <form class="addNewEvent" action="scriptNewEvent.php" method="post">
            <fieldset class="event">
                <legend class="eventNumber">Idée</legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title">
                        <input   type="text" name="title"  maxlength="20"  placeholder="Titre"/>
                    </div>

                    <div class="photo">
                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    </div>

                    <div class="eventDescription">
                        <textarea style="resize:none" rows="12" cols="50" placeholder="Description"></textarea>
                    </div>

                    <div class="inscriptionButton">
                        <input type="submit" value="Voter !" />
                    </div>


            </div>

    </fieldset>


    </form>






         </section>




        <footer id="bas">
             <div id="logoContact">
                <img src="\projetWeb\imagePNG\www.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\mail.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\facebook.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\github.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
                <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>

        </footer>

    </body>
</html>
