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
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-addNewEventOfTheMonth.css">

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











<form class="addNewEvent" action="scriptAddEventOfTheMonth.php" method="post" enctype="multipart/form-data">
    <fieldset class="event">
        <legend class="">Nouvel évènement</legend>
            <div class="eventBloc">

                <div class="titleAndPhoto">

                          <textarea style="resize:none" rows="2" placeholder="Nom de l'évènement" name="eventName"></textarea>



                    <div class="photo">
                        <input type="file" name="photoOfTheEvent" />

                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail"></div>
                </div>
                <div class="eventDescription">

                                                        <textarea style="resize:none" rows="15" cols="51" placeholder="Description de l'évènement" name="eventDescription" ></textarea>
                </div>
                <div id="test">
                    <div>
                    <label class="textOfSelect" for="choiceFreeOrNotFree">Cet évènement est gratuit ou payant? </label>
     <select id="choiceFreeOrNotFree" name="freeOrNot">
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

                    <div><p class="textOfSelect">Date de l'évènement</p>
                    <input type="date" name="dateOfTheEvent">
                </div>

                </div>

 <div class="inscriptionButton">
     <input type="hidden" name="IDEvent" value=""/>
    <input type="submit" value="Je m'inscris !" name="test"/>
</div>


            </div>
    </fieldset>


    </form>


















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
