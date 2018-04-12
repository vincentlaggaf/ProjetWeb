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



<div class="filter">

    <form id="lookForEvent" action="scriptLookForEvent.php" method="post">
        <textarea style="resize:none" rows="2" cols="16.5" placeholder="Rechercher un évènement"></textarea>
    </form>


            </div>










<?php
     $getHappening=$bdd->query('SELECT NameEvent, EventDate,Description,IDEvent FROM Happenings');
    $numberOfEvent=0;
    $currentMonth=date("m");
    $eventNumber=1;
    // Events passés $currentDate=date("y-m-d");
    //echo ($currentDate);

                       while( $happening=$getHappening->fetch() AND $numberOfEvent<2 ){
                           //echo strtotime($title['EventDate']);
                          $monthOfTheEvent=explode("-",$happening['EventDate']);
                          // echo $monthOfTheEvent[1];
                           //if (strtotime($title['EventDate])<strtotime($currentDate))
                           if ($currentMonth==$monthOfTheEvent[1]){



    ?>
<form class="addNewEvent" action="scriptInscriptionEvent.php" method="post">
    <fieldset class="event">
        <legend class="eventNumber">Event <?php echo $eventNumber;?></legend>
            <div class="eventBloc">

                <div class="titleAndPhoto">
                    <div class="title">

                        <?php








                        echo $happening['EventDate'];

                        ?>



                    </div>
                    <div class="photo">

                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail"></div>
                </div>
                <div class="eventDescription">
                    <?php

                    echo $happening['Description'];



                    ?>
                </div>
 <div class="inscriptionButton">
     <input type="hidden" name="IDEvent" value="<?php echo $happening['IDEvent'];?>"/>
    <input type="submit" value="Je m'inscris !" name="test"/>
</div>


            </div>
    </fieldset>


    </form>


               <?php }
                           $eventNumber++;
                           $numberOfEvent++;}
    $getHappening->closeCursor();
    ?>

            <script>

            </script>

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
