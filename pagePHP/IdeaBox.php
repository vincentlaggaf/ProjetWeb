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


        <?php include('nav.php');?>

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

             <form class="addIdea" action="IdeaBox.php" method="post" >
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
                 <div class="buttonvali" >
                    <input type="submit" name="validation" value="Valider"  />
                    <input type="hidden" name="idValidate" value="1"  />
                 </div>

             </form>



                <?php   } $gethappenings->closeCursor();?>

                  <?php

                        if(isset($_POST['vote'])){


                           $vote =  $bdd->prepare('UPDATE interest SET Vote = 1 WHERE IDEvent =:IdEvent  AND IDUser =:IDUser  ');

                            $vote->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
                            $vote->bindValue(':IDEvent',$_POST['IDEvent'],PDO::PARAM_INT);
                            $vote->execute();

                                }
            ?>



         </section>
        <?php
        include('footer.php');
        ?>

    </body>
</html>
