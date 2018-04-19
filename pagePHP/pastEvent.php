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
        <title> Evènements passés </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-pastEvent.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>
    <body>
        <?php include('nav.php');?>
        <section id="corps">



            <?php
            $getHappened=$bdd->query('SELECT * FROM Happenings');
            $numberOfEvent=0;
            $eventNumber=1;
            while( $happened=$getHappened->fetch()){
                if (strtotime($happened['EventDate']) < strtotime("now")){
                    $idToLookFor=$happened['IDEvent'];
                    $getPhoto=$bdd->prepare("SELECT Url FROM Photo WHERE IDEvent =:IDEvent");
                    $getPhoto->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_STR);
                    $getPhoto->execute();
                    $urlPhoto=$getPhoto->fetch();
            ?>

            <fieldset class="event">
                <legend class="eventNumber">
                    <a class="linkToEvent" href="pageOfEvent.php?name=<?php echo $happened['NameEvent'];?>">
                        <strong><?php echo $happened['NameEvent'];?></strong>
                    </a>
                </legend>
                <div class="eventBloc">
                    <?php if(isset($urlPhoto['Url'])){ ?>
                    <div class="titleAndPhoto">
                        <div class="photo"><img src="<?php echo $urlPhoto['Url'] ;?>"alt="" class="thumbnail"></div>
                    </div>
                    <?php } ?>
                    <div class="eventDescription"><?php echo $happened['Description']; ?></div>
                    <?php
                    if (isset($_SESSION['Role']) AND ($_SESSION['Role']=='BDEMember' OR $_SESSION['Role']=='Student')) {
                    ?>
                    <div class="inscriptionButton">
                        <input type="hidden" name="NameEvent" value="<?php echo $happened['NameEvent']?>;">
                        <input type="hidden" name="IDEvent" value="<?php echo $happened['IDEvent'];?>"/>
                        <input type="submit" value=" + " name="test"/>
                    </div>
                    <?php } ?>
                </div>
            </fieldset>


        <?php }
                $eventNumber++;
                $numberOfEvent++; }
            $getHappened->closeCursor();
        ?>







        </section>
    <?php include('footer.php'); ?>

    <script>
        function openPage() {
            location.href = "pageOfEvent.php?name=<?php echo $happened['NameEvent'];?>"
        }
    </script>
    </body>
</html>
