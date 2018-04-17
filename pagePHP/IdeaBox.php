<?php
    session_start();
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }

?>


<!DOCTYPE html>
<html>

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






            <form class="addNewEvent" action="IdeaBox.php" method="post">
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
                        <textarea style="resize:none" name="description" rows="12" cols="50" placeholder="Description"></textarea>
                    </div>

                    <div class="inscriptionButton">
                        <input type="submit" name="go" value="Publier" />
                    </div>


                    </div>

            </fieldset>
            </form>


            <?php


            $requete = $bdd->prepare('INSERT INTO happenings(NameEvent, Description, Validate) VALUES(?,?,?)');

                if(isset($_POST['go'])){

                    $requete->execute(array($_POST['title'],$_POST['description'],0));
                                        }

                ?>



            <div><p class="bar">Dernières Idées</p>
            </div>


            <?php
            $gethappenings = $bdd->query('SELECT NameEvent,Description,IDEvent FROM happenings WHERE Validate=0');
                while( $happenings = $gethappenings->fetch()){

                ?>

             <form class="addNewEvent" action="ideaValidation.php" method="post" >
                <fieldset class="event">
                <legend class="eventNumber" name="idevent">Idée <?=
                     $happenings['IDEvent'];
                    ?>
                    </legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title"><?php
                    echo $happenings['NameEvent'];?>
                    </div>

                    <div class="photo">

                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    <div><p>Nombre de vote:<!--<?php
                    echo $happenings['Vote'];
                    ?>-->
                        </p>

                    </div>
                    </div>

                    <div class="eventDescription"><?php
                    echo $happenings['Description'];?>
                    </div>


                    <div class="voteButton">
                        <input type="hidden" name="idEvent" value="<?php $happenings['IDEvent'];?>">
                        <input type="submit" name="vote" value="Voter !" />
                    </div>

                    </div>
                </fieldset>
            </form>

                        <form action="IdeaValidation.php" method="post">
                        <input type="submit" name="validation" value="Valider"  />
                        <input type="hidden" name="idValidate" value="1"  />
                        </form>



                <?php   } $gethappenings->closeCursor();?>

                  <?php

                        if(isset($_POST['vote'])){

                            //$getvote = $bdd->query('SELECT IDEvent,IDUser FROM interest'); $vote = $getvote->fetch();
                            $bdd->exec('UPDATE interest SET Vote = 1 WHERE IDEvent = 3 AND IDUser = 2 ');


                                }

                            ?>



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
