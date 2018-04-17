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

      <?php include('nav.php');?>


        <section id="corps">


            <form action="IdeaBox.php" method="post">
            <fieldset class="event">
                <legend class="eventNumber">Validation de l'Idée </legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title">
                        <input   type="text" name="title"  value=""  />
                    </div>

                    <div class="photo">
                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    <div>
                        <input type="date" name="dateValidaiton">
                    </div>
                    </div>

                    <div class="eventDescription">
                        <textarea style="resize:none" name="description" rows="12" cols="50" value=""></textarea>
                        <div>
                        <input class="buttonValidation" type="submit" name="Validate" value="Valider" />
                        </div>
                    </div>


                </div>

            </fieldset>
            </form>




         </section>

        <footer id="bas">
               <?php
        include('footer.php');
        ?>
        </footer>

    </body>
</html>
