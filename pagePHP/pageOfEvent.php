<?php
session_start();
try
{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die ('Erreur : ' . $e->getMessage());
}
?>

<?php

if(isset($_GET['name'])){
    $eventName=$_GET['name'];

    $getInfoEvent=$bdd->prepare('SELECT * FROM Happenings WHERE NameEvent= :nameEvent');
    $getInfoEvent->bindValue(':nameEvent',$eventName,PDO::PARAM_STR);
    $getInfoEvent->execute();
    $InfoEvent=$getInfoEvent->fetch();

    $getPhotoEvent=$bdd->prepare('SELECT Url FROM Photo WHERE IDEvent =:IDEvent');
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

<body>
    <section id="corps">
        <form class="addNewEvent" action="scriptInscriptionEvent.php" method="post" >
            <fieldset class="event">
                <legend class="eventName"><strong>
                                    <?php echo $InfoEvent['NameEvent']?>
                                </strong></legend>
                <div id="eventAndParticipants">
                    <div class="eventBloc">
                                                <?php if(isset($urlPhoto['Url'])){

            ?>
                        <div class="titleAndPhoto">

                            <div class="photo">
                                <img src="<?php echo $photoEvent['Url'] ;?>"alt="" class="thumbnail"></div>
                        </div>
                                      <?php } ?>
                        <div class="eventDescription">
                            <?php echo $InfoEvent['Description'];?>

                        </div>

                    </div>

                </fieldset>
            </form>
        </section>

        <?php include('footer.php');?>
        <?php
}
else{
    header('Location:eventOfTheMonth.php');
    exit();
}?>
