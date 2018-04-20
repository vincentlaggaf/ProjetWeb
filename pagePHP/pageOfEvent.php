<?php
session_start();

require 'BDDConnection.php';
require 'addEventPicture/scriptAddEventPicture.php';

$bdd = getBDD();

if(isset($_GET['name']))
{

    $eventName=$_GET['name'];

    $getInfoEvent=$bdd->prepare('SELECT * FROM Happenings WHERE NameEvent= :nameEvent');
    $getInfoEvent->bindValue(':nameEvent',$eventName,PDO::PARAM_STR);
    $getInfoEvent->execute();
    $InfoEvent=$getInfoEvent->fetch();

    if(isset($_POST['validation']))
    {
        getFile($InfoEvent['IDEvent']);
    }

    $getPhotoEvent=$bdd->prepare('SELECT * FROM Photo WHERE IDEvent =:IDEvent');
    $getPhotoEvent->bindValue(':IDEvent',$InfoEvent['IDEvent'],PDO::PARAM_INT);
    $getPhotoEvent->execute();
    $photoEvent=$getPhotoEvent->fetch();

    $getDone=$bdd->prepare('SELECT EventDate FROM Happenings WHERE NameEvent= :nameEvent');
    $getDone->bindValue(':nameEvent',$eventName,PDO::PARAM_STR);
    $getDone->execute();
    $IsItPassed=$getDone->fetch();



?>

<!DOCTYPE html>
<html id="top">

    <head>
        <title> <?php echo $_GET['name'];?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-pastEventCommentPhoto.css">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-pastEvent.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>
    <?php include ('nav.php'); ?>

    <body>
        <section id="corps">

            <fieldset class="event">
                <!-- Name of the event -->
                <legend class="eventName">
                    <strong><?php echo $InfoEvent['NameEvent']?></strong>
                </legend>

                <!-- content of the event -->
                <div id="eventAndParticipants">
                    <div class="eventBloc">
                        <?php if(isset($photoEvent['Url'])){?>
                        <div class="photo">
                            <img src="<?php echo $photoEvent['Url'] ;?>"alt="" class="thumbnail">
                        </div>
                        <?php } ?>
                        <div class="eventDescription"><?php echo $InfoEvent['Description'];?></div>
                    </div>
                </div>
            </fieldset>



            <!-- If the event is done we display this part of the code -->
            <?php if (strtotime($IsItPassed['EventDate']) < strtotime("now")){
                    if ((isset($_SESSION['Id'])) AND ($_SESSION['Role'] != 'Inactif')){
            ?>


            <!-- Add photo to the event -->
            <div class="photo" id="file">
                <p id="warningPhoto">Attention le fichier doit faire au maximum 10 Mo!</p>
                <form action="pageOfEvent.php?name=<?php echo $eventName; ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="eventPicture"/>
                    <input type="submit" value="Valider" name="validation">
                </form>
            </div><br/><br/>

            <?php }?>
            <!-- Div filles with the photos -->
            <div class="eventPhotos">
                <?php
        $getPhotos=$bdd->prepare('SELECT * FROM Photo WHERE IDEvent =:IDEvent');
        $getPhotos->bindValue(':IDEvent',$InfoEvent['IDEvent'],PDO::PARAM_INT);
        $getPhotos->execute();
        while($photos=$getPhotos->fetch()){ ?>
                <img class="myImg" value="<?php echo $photos['IDPhoto'];?>" src="<?php echo $photos['Url'];?>" alt="eventPhoto">
                <?php } ?>
            </div>



            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>
                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="imgModal">
                <!-- The Comment/like/report section -->
                <div class="commentaire" id="commentaires">
                    <!-- If the user is not connected/or Inactif -->
                    <?php
        if((!isset($_SESSION['Id']))||($_SESSION['Role'] == 'Inactif')){ ?>
                    <p> Connectez-vous pour pouvoir aimer et commenter! </p>
                    <?php }

        else if((isset($_SESSION['Id']))AND($_SESSION['Role'] != 'Inactif')){

            if($_SESSION['Role'] == 'CESIMember') { ?>
                    <div>
                        <p>Signaler cette photo :</p>
                        <form action="report.php" method="post">
                            <input type="hidden" id="category" value="photo"/>
                            <button type="reset" value="reset" id="signaler"> signaler </button>
                            <!--                            <button type="button" id="signaler"> signaler </button>-->
                            <!--<button type="reset" value="Reset" id="submit"> envoyer </button>-->
                        </form>
                    </div>
                    <?php
            } ?>

                    <h1>Aimer la photo : </h1>
                    <!-- <button id="btn">J'aime</button>-->
                    <input id="btn" type="image" src="/projetWeb/imagePNG/like.png"/>

                    <div>
                        <h1>Commentez :</h1>
                        <form action="commentEventPhoto.php" method="post">
                            <input type="text" id="monCommentaire"/>
                            <button type="reset" value="reset" id="submit"> envoyer </button>
                            <!--<button type="reset" value="Reset" id="submit"> envoyer </button>-->
                        </form>
                    </div>

                    <?php
        } ?>

                    <div>
                        <h1>Commentaires :</h1>
                        <p id="comments"></p>
                    </div>
                </div>
            </div>

            <?php
        $getInfoEvent->closeCursor();
        $getPhotoEvent->closeCursor();
        $getDone->closeCursor();
        $getPhotos->closeCursor();
    } ?>

            <!-- If you are a member of the CESI/BDE you can download the list of the event's participant-->
            <?php if((isset($_SESSION['Role']))AND (($_SESSION['Role'] == 'CESIMember')||($_SESSION['Role'] == 'BDEMember'))) { ?>
            <div>
                <h4> télécharger la liste des membres de l'activité : </h4>
                <form action="getList.php" method="post" >
                    <input type="hidden" name="eventID" value="<?php echo $InfoEvent['IDEvent'];?>">
                    <button type="submit" > télécharger </button>
                </form>
            </div>
            <?php } ?>

        </section>
        <?php include('footer.php');?>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <script>

            var img = document.getElementsByClassName('myImg');
            for(i=0; i<img.length; i++)
            {
                // We add an event listener to be able to display (with the right content)
                // the photo that we have clicked on
                img[i].addEventListener('click',function(e){

                    var modal = document.getElementById('myModal');
                    modal.style.display = "flex";

                    var modalImg = document.getElementById('imgModal');
                    modalImg.src = e.target.getAttribute('src');

                    var modalidPhoto = e.target.getAttribute('value');

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }

                    // Function that is called when you click on a photo
                    // It sends an ajax request to get the comments posted on the photo
                    // according to its ID
                    $.ajax({
                        url: 'alertAjax.php',
                        type : 'POST',
                        data : 'IDphotoClicked=' + modalidPhoto,
                        //we put the result inside the comment section
                        success : function(data){document.getElementById("comments").innerHTML=(data);},
                        error : function(resultat, statut, erreur){},
                        complete : function(resultat, statut){}
                    });

                    <?php
                    if(isset($_SESSION['Id'])){
                    ?>
                    // Function that is called when you clic on the like button
                    // It sends the datas (photo ID) to likePhotoEvent.php
                    btn.onclick = function (){
                        $.ajax({
                            url: 'likePhotoEvent.php',// La ressource ciblée
                            type : 'POST', // Le type de la requête HTTP.
                            data :'IDphotoClicked=' + modalidPhoto,
                            success : function(data){
                                alert (data);
                            },
                            error : function(resultat, statut, erreur){},
                            complete : function(resultat, statut){}
                        });
                    }


                    // Function that is called when you clic on the send comment button
                    // It sends the datas (content of the comment and the photo ID) to report.php
                    submit.onclick = function(){
                        var commentaire = document.getElementById('monCommentaire').value;
                        $.ajax({
                            url: 'commentEventPhoto.php',
                            type : 'POST',
                            data :
                            {"IDphotoClicked": modalidPhoto,
                             "comment": commentaire,},
                            success : function(data){getComment();},
                            error : function(resultat, statut, erreur){},
                            complete : function(resultat, statut){}
                        });
                    }

                        // Function that is called when you clic on the report button
                        // It sends the datas (photo and its ID) to report.php

                        signaler.onclick = function() {
                            var category = document.getElementById('category').value;
                            var IDUser = <?php echo $_SESSION['Id']; ?> ;
                            var contentId = modalidPhoto;
                            $.ajax({
                                url: 'report.php',
                                type : 'POST',
                                data :
                                {"contentId": contentId,
                                 "category": category,
                                 "IDUser": IDUser,},
                                success : function(data){},
                                error : function(resultat, statut, erreur){},
                                complete : function(resultat, statut){}
                            });
                        }
                    <?php
                    }
                    ?>
                });
            }
        </script>
    </body>
</html>

<?php
}
else {
    header('Location:pastEvent.php');
    exit();
}?>
