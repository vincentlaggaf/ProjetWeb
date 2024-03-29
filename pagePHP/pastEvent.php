<?php
session_start();
require 'BDDConnection.php';

$bdd = getBDD();
?>

<!DOCTYPE html>
<html id="top">
    <head>
        <title> Evènements passés </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
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
                if (strtotime($happened['EventDate']) < strtotime("now") AND $happened['Validate'] == 1){
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
