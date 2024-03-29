<?php
session_start();
require 'BDDConnection.php';

$bdd = getBDD();
?>


<!DOCTYPE html>
<html id="top">

    <head>
        <title> Evènement du mois </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-addNewEventOfTheMonth.css">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">

    </head>

    <body>
        <!--        <header> </header> -->
        <?php  include('nav.php');?>

        <section id="corps">
            <form class="addNewEvent" action="scriptAddEventOfTheMonth.php" method="post" enctype="multipart/form-data">
                <fieldset class="event">
                    <legend class="">Nouvel évènement</legend>
                    <div class="eventBloc">

                        <div class="titleAndPhoto">
                            <textarea style="resize:none" rows="2" placeholder="Nom de l'évènement" name="eventName"></textarea>
                            <div class="photo">
                                <p id="warningPhoto">Attention le nom de fichier doit faire au maximum 10 Mo</p>
                                <input type="file" name="photoOfTheEvent" id="choosePhoto"/>
                            </div>
                        </div>

                        <div class="eventDescription">
                            <textarea style="resize:none" rows="15" cols="51" placeholder="Description de l'évènement" name="eventDescription" ></textarea>
                        </div>

                        <div id="test">
                            <div class="payant">
                                <label class="textOfSelect" for="choiceFreeOrNotFree">Cet évènement est gratuit ou payant? </label>
                                <select class="choices" name="freeOrNot">
                                    <option value="1">Gratuit</option>
                                    <option value="0">Payant</option>
                                </select>
                            </div>
                            <div>
                                <label class="textOfSelect" for="choiceRecurrentOrNot">Sera t-il récurrent?</label>
                                <select id="choiceRecurrentOrNot" name="recurrentOrNot">
                                    <option value="1">Oui</option>
                                    <option value="0">Non</option>
                                </select>
                            </div>

                            <div>
                                <label class="textOfSelect" for="eventCategory">Quel est le type de l'événement?</label>
                                <select id="eventCategory" name="eventCategory">
                                    <?php
                                    $getCategory=$bdd->prepare("SELECT * FROM EventCategory");
                                    $getCategory->execute();
                                    while(   $category=$getCategory->fetch()){
                                        $eventCategoryWithNoSpace=str_replace(' ','_',$category['NameEventCategory']);

                                    ?>
                                    <option value="<?php echo $eventCategoryWithNoSpace;?>"><?php echo $category['NameEventCategory'];?></option>
                                    <?php
                                    }

                                    ?>
                                </select>
                            </div>

                            <div>
                                <p class="textOfSelect">Date de l'évènement</p>
                                <input type="date" name="dateOfTheEvent">
                            </div>

                            <div class="inscriptionButton">
                                <input type="hidden" name="IDEvent" value=""/>
                                <input type="submit" value="Ajouter l'événement" name="test"/>
                            </div>

                        </div>
                    </div>
                </fieldset>


            </form>


        </section>


        <?php include('footer.php');?>

    </body>
</html>
