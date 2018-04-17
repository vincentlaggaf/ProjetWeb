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


<!DOCTYPE html>
<html id="top">

    <head>
        <title> Evènement du mois </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-eventOfTheMonth.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">

    </head>

    <body>

        <?php include('nav.php');?>

        <section id="corps">
            <div id="sidebar">
                <form action="" method="post">
                    <input type="text" name="research" placeholder="Recherche"/>
                    <input type="submit" value="Valider" />
                </form>
                <p>Filtres :</p>
                <form action="" method="post">
                    <input type="hidden" name="category" value="1">
                    <input type="submit" value="Catégorie">
                </form>
                <form action="" method="post">
                    <input type="hidden" name="price" value="1">
                    <input type="submit" value="Prix">
                </form>
                <form action="" method="post">
                    <input type="hidden" name="popularity" value="1">
                    <input type="submit" value="Popularité">
                </form>
                <?php if (isset($_SESSION['Role']) AND $_SESSION['Role']=='BDEMember'){
                ?>

                <form action="addNewEventOfMonth.php">
                    <input type="submit" value="Ajouter un nouvel événement">
                </form>
                <?php } ?>
            </div>









            <?php
            $getHappening=$bdd->query('SELECT * FROM Happenings');
            $numberOfEvent=0;
            $currentMonth=date("m");
            $eventNumber=1;


            // Events passés $currentDate=date("y-m-d");
            //echo ($currentDate);

            while( $happening=$getHappening->fetch() AND $numberOfEvent<19 ){

                //echo strtotime($title['EventDate']);
                $monthOfTheEvent=explode("-",$happening['EventDate']);
                // echo $monthOfTheEvent[1];
                //if (strtotime($title['EventDate])<strtotime($currentDate))
                if ($currentMonth==$monthOfTheEvent[1]){
                    $idToLookFor=$happening['IDEvent'];
                    $getPhoto=$bdd->prepare("SELECT Url FROM Photo WHERE IDEvent =:IDEvent");
                    $getPhoto->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_STR);
                    $getPhoto->execute();
                    $urlPhoto=$getPhoto->fetch();

            ?>
            <form class="addNewEvent" action="scriptInscriptionEvent.php" method="post" >
                <fieldset class="event">
                    <legend class="eventNumber"><a class="linkToEvent" href="pageOfEvent.php?name=<?php echo $happening['NameEvent'];?> ">Event <?php echo $eventNumber;?></a></legend>
                    <div class="eventBloc">

                        <div class="titleAndPhoto">
                            <div class="title">
                                <strong>
                                    <?php


                    echo $happening['NameEvent'];

                                    ?>
                                </strong>


                            </div>
                            <div class="photo">

                                <img src="<?php echo $urlPhoto['Url'] ;?>"alt="" class="thumbnail"></div>
                        </div>
                        <div class="eventDescription">
                            <?php

                    echo $happening['Description'];

                            ?>
                        </div>
                        <?php
                    if (isset($_SESSION['Role']) AND ($_SESSION['Role']=='BDEMember' OR $_SESSION['Role']=='Student')) {

                        ?>
                        <div class="inscriptionButton">
                            <input type="hidden" name="NameEvent" value="<?php echo $happening['NameEvent']?>;">
                            <input type="hidden" name="IDEvent" value="<?php echo $happening['IDEvent'];?>"/>
                            <input type="submit" value="Je m'inscris !" name="test"/>
                        </div>

                        <?php }
                        ?>

                    </div>

                </fieldset>
            </form>
            <?php }
                $eventNumber++;
                $numberOfEvent++;}
            $getHappening->closeCursor();
            ?>
        </section>

        <?php
        include('footer.php');
        ?>

    </body>

</html>
