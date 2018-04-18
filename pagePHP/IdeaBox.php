<?php
session_start();

//initialize the connection with the database
try
{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));



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
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-IdeaBox.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">

    </head>



    <body>

        <?php include('nav.php');


        // check if the user voted for an idea
        if(isset($_POST['vote'])){


            $getEntry =  $bdd->prepare('SELECT * FROM Interest WHERE IDEvent =:IDEvent  AND IDUser =:IDUser');

            $getEntry->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
            $getEntry->bindValue(':IDEvent',$_POST['idEvent'],PDO::PARAM_INT);
            $getEntry->execute();
            $entry=$getEntry->fetch();


            if(isset($entry['IDUser'])){

                $getVoted = $bdd->prepare('SELECT Vote FROM Interest WHERE IDEvent =:IDEvent  AND IDUser =:IDUser');
                $getVoted->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
                $getVoted->bindValue(':IDEvent',$_POST['idEvent'],PDO::PARAM_INT);
                $getVoted->execute();
                $voted=$getVoted->fetch();

                if(isset($voted['Vote']) AND $voted['Vote']==1){
                    $cancelVote = $bdd->prepare('UPDATE Interest SET Vote = 0 WHERE IDEvent =:IDEvent  AND IDUser =:IDUser ');

                    $cancelVote->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
                    $cancelVote->bindValue(':IDEvent',$_POST['idEvent'],PDO::PARAM_INT);
                    $cancelVote->execute();
                }

                else{
                    $vote =  $bdd->prepare('UPDATE Interest SET Vote = 1 WHERE IDEvent =:IDEvent  AND IDUser =:IDUser ');

                    $vote->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
                    $vote->bindValue(':IDEvent',$_POST['idEvent'],PDO::PARAM_INT);
                    $vote->execute();
                }

            }

            else{
                $voteAdd =  $bdd->prepare('INSERT INTO Interest (Participate,Vote,IDUser,IDEvent) VALUES (0,1,:IDUser,:IDEvent)');

                $voteAdd->bindValue(':IDUser', $_SESSION['Id'],PDO::PARAM_INT);
                $voteAdd->bindValue(':IDEvent',$_POST['idEvent'],PDO::PARAM_INT);
                $voteAdd->execute();
            }
        }


        ?>

        <section id="corps">

            <?php

            // Prevents the inactive user from proposing an idea
            if(isset($_SESSION['Id']) AND $_SESSION['Role']!='Inactif'){


            ?>
            <form class="addNewEvent" action="IdeaBox.php" method="post">
                <fieldset class="event">
                    <legend class="eventNumber">Proposez votre idée</legend>

                    <div class="eventBloc">

                        <div class="titleAndPhoto">

                            <div class="title">
                                <input   type="text" name="title"  maxlength="20"  placeholder="Titre"/>
                            </div>

                            <div class="photo">
                                <img src="/projetWeb/imagePNG/boite_intro.png"  style="width:100%" class="thumbnail">
                            </div>

                        </div>

                        <div class="eventDescription">
                            <textarea style="resize:none" name="description" rows="12" cols="50" placeholder="Description"></textarea>
                        </div>

                        <div class="inscriptionButton">
                            <input type="submit" name="addIdea" value="Publier" />
                        </div>


                    </div>

                </fieldset>
            </form>
            <?php }

            // Warn the incative user to sing in
            else{

            ?>
            <form class="addNewEvent" action="IdeaBox.php" method="post">
                <fieldset class="event">
                    <legend class="eventNumber">Connexion requise</legend>

                    <div class="eventBloc">
                        <div>Vous devez être connecté pour pouvoir proposer une idée!
                        </div>

                    </div>

                </fieldset>
            </form>

            <?php }?>


            <div><p class="bar">Dernières Idées</p>
            </div>


            <?php


            $requete = $bdd->prepare('INSERT INTO Happenings(NameEvent, Description, Validate,IDUser,NameEventCategory) VALUES(?,?,?,?,?)');

            // Add the new idea
            if(isset($_POST['addIdea'])){


                $requete->execute(array($_POST['title'],$_POST['description'],0,$_SESSION['Id'],'Idea'));
            }

            ?>


            <?php
            // Display the page for the BDE Member
            if(isset($_SESSION['Id']) AND $_SESSION['Role']=='BDEMember'){


                $gethappenings = $bdd->query('SELECT NameEvent,Description,IDEvent FROM Happenings WHERE Validate=0');

                while( $happenings = $gethappenings->fetch()){


            ?>

            <div class="addIdea">
                <fieldset class="event">
                    <legend class="eventNumber" name="idevent">Idée <?php echo $happenings['IDEvent'];  $_SESSION['idEvent2']=$happenings['IDEvent']
                        ?>
                    </legend>

                    <div class="eventBloc">

                        <div class="titleAndPhoto">

                            <div class="title"><?php echo $happenings['NameEvent'];?>
                            </div>

                            <div class="photo">
                               <img src="/projetWeb/imagePNG/boite_intro.png"  style="width:100%" class="thumbnail">
                            </div>
                            <?php
                    $getNumberVote = $bdd->query('SELECT COUNT( Vote ) as nVote FROM Interest WHERE IDEvent ='.$happenings['IDEvent'].' AND Participate=0 AND Vote=1' );
                    $nombreVote=$getNumberVote->fetch();
                            ?>

                            <div><p>Nombre de vote: <?= $nombreVote['nVote'] ?>
                                </p>
                                <form class="addIdea" action="IdeaValidation.php" method="post">
                                    <input type="hidden" name="idEvent" value="<?php echo $happenings['IDEvent'];?>">
                                    <input type="hidden" name="desCription" value="<?php echo $happenings['Description'];?>">
                                    <input type="hidden" name="titleIdea" value="<?php echo $happenings['NameEvent'];?>">
                                    <input class="buttonVali" type="submit" value="Valider"  />
                                </form>
                            </div>
                        </div>

                        <div class="eventDescription"><?php echo $happenings['Description'];?>
                        </div>

                        <form class="addIdea" action="IdeaBox.php" method="post">
                            <div class="voteButton">
                                <input type="hidden" name="idEvent" value="<?php echo $happenings['IDEvent'];?>">
                                <input type="submit" name="vote" value="Voter !" />
                            </div>
                        </form>

                    </div>
                </fieldset>
            </div>



            <?php
                }

                //Closes the cursor allowing the query to be executed again
                $gethappenings->closeCursor();}

            // Display the page for the student and cesi member
            elseif(isset($_SESSION['Id']) AND $_SESSION['Role']=='Student' || $_SESSION['Role']=='CESIMember'){


                $gethappenings = $bdd->query('SELECT NameEvent,Description,IDEvent FROM Happenings WHERE Validate=0');

                while( $happenings = $gethappenings->fetch()){


            ?>

            <div class="addIdea">
                <fieldset class="event">
                    <legend class="eventNumber" name="idevent">Idée <?php echo $happenings['IDEvent'];  $_SESSION['idEvent2']=$happenings['IDEvent']?>
                    </legend>

                    <div class="eventBloc">

                        <div class="titleAndPhoto">
                            <div class="title"><?php echo $happenings['NameEvent'];?>
                            </div>

                            <div class="photo">
                                <img src="/projetWeb/imagePNG/boite_intro.png"  style="width:100%" class="thumbnail">
                            </div>
                            <?php
                    $getNumberVote = $bdd->query('SELECT COUNT( Vote ) as nVote FROM Interest WHERE IDEvent ='.$happenings['IDEvent'].' AND Participate=0 AND Vote=1' );
                    $nombreVote=$getNumberVote->fetch();
                            ?>

                            <div><p>Nombre de vote: <?= $nombreVote['nVote'] ?></p>
                            </div>
                        </div>

                        <div class="eventDescription"><?php echo $happenings['Description'];?>
                        </div>
                        <form class="addIdea" action="IdeaBox.php" method="post">
                            <div class="voteButton">
                                <input type="hidden" name="idEvent" value="<?php echo $happenings['IDEvent'];?>">
                                <input type="submit" name="vote" value="Voter !" />
                            </div>
                        </form>
                    </div>
                </fieldset>
            </div>
            <?php
                }
                $gethappenings->closeCursor();}

            // Display the page for the disconnected users
            else{


                $gethappenings = $bdd->query('SELECT NameEvent,Description,IDEvent FROM Happenings WHERE Validate=0');

                while( $happenings = $gethappenings->fetch()){

            ?>
            <div class="addIdea">
                <fieldset class="event">
                    <legend class="eventNumber" name="idevent">Idée <?php echo $happenings['IDEvent'];  $_SESSION['idEvent2']=$happenings['IDEvent']
                        ?>
                    </legend>

                    <div class="eventBloc">

                        <div class="titleAndPhoto">

                            <div class="title"><?php echo $happenings['NameEvent'];?>
                            </div>

                            <div class="photo">
                               <img src="/projetWeb/imagePNG/boite_intro.png"  style="width:100%" class="thumbnail">
                            </div>
                            <?php
                    $getNumberVote = $bdd->query('SELECT COUNT( Vote ) as nVote FROM Interest WHERE IDEvent ='.$happenings['IDEvent'].' AND Participate=0 AND Vote=1' );

                    $nombreVote=$getNumberVote->fetch();
                            ?>

                            <div><p>Nombre de vote: <?= $nombreVote['nVote'] ?>
                                </p>

                            </div>
                        </div>

                        <div class="eventDescription"><?php echo $happenings['Description'];?>
                        </div>



                    </div>
                </fieldset>
            </div>
            <?php
                }
                $gethappenings->closeCursor();}
            ?>


        </section>

        <?php include('footer.php');?>

    </body>
</html>
