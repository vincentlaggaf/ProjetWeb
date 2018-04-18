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


            <form action="" method="post">
            <fieldset class="event">
                <legend class="eventNumber">Validation de l'Idée </legend>

                    <div class="eventBloc">

                    <div class="titleAndPhoto">

                    <div class="title">
                        <input   type="text" name="titleval"  value=""  />
                    </div>

                    <div class="photo">
                    <img src="/projetWeb/imagePNG/" alt="" class="thumbnail">
                    </div>

                    <div>
                        <input type="date" name="dateValidaiton">
                    </div>
                    </div>

                    <div class="eventDescription">
                        <textarea style="resize:none" name="descriptionval" rows="12" cols="50" value=""></textarea>
                       <div class="buttonValidation"> <label for="eventCategory">Quel est le type de l'événement?</label>

                        <select  name="eventCategory">
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
                        </select></div>

                        <div class="buttonValidation">
                            <label class="textOfSelect" for="choiceFreeOrNotFree">Cet évènement est gratuit ou payant? </label>
                            <select class="choices" name="freeOrNot">
                            <option value="1">Gratuit</option>
                            <option value="0">Payant</option>
                            </select>
                        </div>


                    <div class="buttonValidation">
                        <label class="buttonValidation" for="choiceRecurrentOrNot">Sera t-il récurrent?</label>
                        <select id="choiceRecurrentOrNot" name="recurrentOrNot">
                        <option value="1">Oui</option>
                        <option value="0">Non</option>
                        </select>
                    </div>

                        <div class="buttonValidation">
                        <input type="submit" name="Validate" value="Valider" /> </div>

                    </div>


                </div>

            </fieldset>
            </form>






            <?php

                echo $_POST['freeOrNot'];

                if(isset($_POST['Validate'])){

              $validation = $bdd->prepare('UPDATE Happenings SET EventDate=:Date, NameEvent=:Name, Description=:description, NameEventCategory=:Category, Validate=1 WHERE IDEvent=50');
              $validation->bindValue(':Date',$_POST['dateValidaiton'],PDO::PARAM_STR);
              $validation->bindValue(':Name',$_POST['titleval'],PDO::PARAM_STR);
              $validation->bindValue(':description',$_POST['descriptionval'],PDO::PARAM_STR);
              $validation->bindValue(':Category',$_POST['eventCategory'],PDO::PARAM_STR);



              $validation->execute();
              echo $_POST['dateValidaiton'];

          }


            ?>


         </section>

        <footer id="bas">
               <?php
        include('footer.php');
        ?>
        </footer>

    </body>
</html>
