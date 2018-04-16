<?php
    session_start();
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=projetweb;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }

?>


<!DOCTYPE html>
<html>

    <head>
        <title>Validation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-IdeaBox.css">
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






             <form class="addNewEvent" >
                <fieldset class="event">
                <legend class="eventNumber">Idée

                    </legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title">
                    </div>

                    <div class="photo">

                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    <div><p>Nombre de vote:
                        </p>
                        <input type="submit" name="validation" value="Valider" OnClick="javascript:document.location.href='IdeaBox.php'" />
                    </div>

                    </div>

                    <div class="eventDescription">
                    </div>

                    </div>
                </fieldset>
            </form>






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
