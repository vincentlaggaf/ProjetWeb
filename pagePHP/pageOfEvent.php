<?php
    session_start();
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=eventofthemonth;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }
?>


<?php

if(isset($_GET['name'])){
    $eventName=$_GET['name'];

    $getInfoEvent=$bdd->prepare('SELECT * FROM happenings WHERE NameEvent= :nameEvent');
    $getInfoEvent->bindValue(':nameEvent',$eventName,PDO::PARAM_STR);
    $getInfoEvent->execute();
    $InfoEvent=$getInfoEvent->fetch();

    $getPhotoEvent=$bdd->prepare('SELECT Url FROM photo WHERE IDEvent =:IDEvent');
    $getPhotoEvent->bindValue(':IDEvent',$InfoEvent['IDEvent'],PDO::PARAM_INT);
    $getPhotoEvent->execute();
    $photoEvent=$getPhotoEvent->fetch();

?>
<!DOCTYPE html>
<html id="top">

    <head>
        <title> <?php echo $_GET['name'];?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-eventOfTheMonth.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">




    </head>
      <?php include ('nav.php'); ?>

                         <section id="corps">
                                     <form class="addNewEvent" action="scriptInscriptionEvent.php" method="post" >
                <fieldset class="event">
                    <legend class="eventNumber">Oui</legend>
                    <div id="eventAndParticipants">
                        <div class="eventBloc">

                            <div class="titleAndPhoto">
                                <div class="title">
                                    <strong>
                                     <?php echo $InfoEvent['NameEvent']?>
                                    </strong>


                                </div>
                                <div class="photo">

                               <img src="<?php echo $photoEvent['Url'] ;?>"alt="" class="thumbnail"></div>
                            </div>
                            <div class="eventDescription">
                               <?php echo $InfoEvent['Description']?>
                            </div>


                        </div>

                    <legend >oui</legend>
                    <div id="listOfParticipant">ezaezae</div>
                        </div>
                </fieldset>


                </form>

  <?php
    }
    else{
   // header('Location:home.php');
    //exit();

    }

    ?>
