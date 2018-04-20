<?php
  session_start();
require 'BDDConnection.php';

$bdd = getBDD();


//$IdeaFreeOrNot=$_POST['freeOrNot'];
?>

<!DOCTYPE html>
<html>



    <head>
        <title>Validation</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-IdeaValidation.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">



    </head>

    <body>

      <?php include('nav.php');

        //$idevent= $_POST['idEvent'];

        ?>


        <section id="corps">

            <!-- Display the page -->
            <form action="scriptValidationIdea.php" method="post">
            <fieldset class="event">
                <legend class="eventNumber">Validation de l'Idée <?php echo $_POST['idEvent']; $_SESSION['idevent'] = $_POST['idEvent'];?> </legend>
                    <div class="eventBloc">

                    <div class="titleAndPhoto">
                    <div class="title">
                        <textarea class="area"   style="resize:none" name="titleval"><?php echo $_POST['titleIdea']; ?></textarea>
                    </div>

                    <div class="photo">

                     <img src="/projetWeb/imagePNG/boite_intro.png"  style="width:100%" class="thumbnail">
                        <input type="file" name="photo">
                    </div>

                    <div>
                        <input type="date" name="dateValidaiton">
                    </div>

                    </div>

                    <div class="eventDescription">
                        <textarea style="resize:none" name="descriptionval" rows="12" cols="50" ><?php echo $_POST['desCription']?></textarea>
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
                        <input type="submit" name="Validate" value="Valider" />
                        </div>

                    </div>
                </div>
            </fieldset>
            </form>



            <?php


                // Check if the admin validate the idea
//                if(isset($_POST['Validate'])){
//
//                    $eventFreeOrNot=$_POST['freeOrNot'];
//                    $recurrentOrNot=$_POST['recurrentOrNot'];
//                    $eventCategory=$_POST['eventCategory'];
//                    //$idevent=$_POST['idEvent'];
//
//                  // Update the idea
//                  $validation = $bdd->prepare('UPDATE Happenings SET EventDate=:Date, NameEvent=:Name, Description=:description, NameEventCategory=:Category, Free=:IdeaFreeOrNot, Recurrent=:recurrent, Validate=1 WHERE IDEvent=51');
//
////                  $validation->bindValue(':IDEvent',$idevent,PDO::PARAM_INT);
//                    $validation->bindValue(':Name',$_POST['titleval'],PDO::PARAM_STR);
//                    $validation->bindValue(':Date',$_POST['dateValidaiton'],PDO::PARAM_STR);
//                    $validation->bindValue(':IdeaFreeOrNot',$eventFreeOrNot,PDO::PARAM_INT);
//                    $validation->bindValue(':recurrent',$recurrentOrNot,PDO::PARAM_INT);
//                    $validation->bindValue(':description',$_POST['descriptionval'],PDO::PARAM_STR);
//                    $validation->bindValue(':Category',$eventCategory,PDO::PARAM_STR);
//                    $validation->execute();

//                    $addPhoto = $bdd->prepare('INSERT INTO Photo(Url,IDEvent) VALUES(:photo,:idEvent)');
//                    $addPhoto->bindValue(':photo',$_POST['photo'],PDO::PARAM_STR);
//                    $addPhoto->bindValue(':idEvent',$_POST['idEvent'],PDO::PARAM_INT);
//                    $addPhoto->execute();


                                            //}
            ?>


         </section>

        <footer id="bas">
               <?php include('footer.php');?>
        </footer>

    </body>
</html>
