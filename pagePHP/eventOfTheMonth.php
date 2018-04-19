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
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-eventOfTheMonth.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">

    </head>

    <body>

        <?php include('nav.php');?>

        <section id="corps">
            <h1>Evénement du mois</h1>
       <?php if (isset($_SESSION['Role']) AND $_SESSION['Role']=='BDEMember'){
                ?>
                <div class="addNewEvent">
                <form action="addNewEventOfMonth.php" >
                    <input type="submit" value="Ajouter un nouvel événement" id="addEventButton">
                </form>
                </div>

                <?php } ?>

            <?php
            $getHappening=$bdd->query('SELECT * FROM Happenings');
            $numberOfEvent=0;
            $currentMonth=date("m");

            while( $happening=$getHappening->fetch() ){
                if($happening['Validate']==1){

                    $monthOfTheEvent=explode("-",$happening['EventDate']);

                    if ($currentMonth==$monthOfTheEvent[1] AND( strtotime($happening['EventDate']) >strtotime("now"))){
                        $idToLookFor=$happening['IDEvent'];
                        $getPhoto=$bdd->prepare("SELECT Url FROM Photo WHERE IDEvent =:IDEvent");
                        $getPhoto->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_STR);
                        $getPhoto->execute();
                        $urlPhoto=$getPhoto->fetch();

            ?>

                <fieldset class="event">
                    <legend class="eventNumber"><a class="linkToEvent" href="pageOfEvent.php?name=<?php echo $happening['NameEvent'];?> "><strong><?php echo $happening['NameEvent'];?></strong></a></legend>
                    <div class="eventBloc">
                        <?php if(isset($urlPhoto['Url'])){

                        ?>
                        <div class="titleAndPhoto">

                            <div class="photo">
                                <img src="<?php echo $urlPhoto['Url'] ;?>"alt="" class="thumbnail">
                            </div>

                        </div>

                        <?php } ?>

                        <div class="eventDescription">
                            <?php
                        echo $happening['Description'];
                            ?>
                        </div>

                        <?php

                        if (isset($_SESSION['Role'])){
                            if($_SESSION['Role']!='inactif')
                          {

                        ?><form>
                        <div class="inscriptionDiv">
                            <input type="hidden" name="NameEvent" value="<?php echo $happening['NameEvent']?>;">
                            <input type="hidden" name="IDEvent" value="<?php echo $happening['IDEvent'];?>"/>
                            <input type="submit" value="Je m'inscris !" name="test" class="inscriptionButton" title="Je m'inscris"/>
                        </div>
                        <?php }
                        ?>
                        <?php if ($_SESSION['Role']=='CESIMember'){

                        ?>
                        </form>
                        <form action="report.php" method="post" class="reportForm">
                            <div class="reportDiv">
                            <img src="/projetWeb/imagePNG/report.png" alt="Signaler" title="Signaler" class="report" />
                            <input type=hidden value="<?php echo $happening['IDEvent']; ?>" name="contentId">
                            <input type=hidden value="event" name="category">
                            <input type=submit value="Signaler" class="reportButton" title="Signaler l'événement"/>
                                </div>
                        </form>

                         <?php }
                        }?>
                    </div>

                </fieldset><?php
           }

                    $numberOfEvent++;}}
            $getHappening->closeCursor();
            ?>

        </section>

        <?php
        include('footer.php');
        ?>

    </body>

</html>
