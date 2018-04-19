<?php
session_start();

require 'BDDConnection.php';
require 'addEventPicture/scriptAddEventPicture.php';

$bdd = getBDD();

if(isset($_GET['name'])){

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
                <legend class="eventName"><strong>
                    <?php echo $InfoEvent['NameEvent']?>
                    </strong></legend>

                <div id="eventAndParticipants">
                    <div class="eventBloc">
                        <?php if(isset($urlPhoto['Url'])){ ?>
                        <div class="photo">
                            <img src="<?php echo $photoEvent['Url'] ;?>"alt="" class="thumbnail">
                        </div>
                        <?php }

                        ?>

                        <div class="eventDescription"><?php echo $InfoEvent['Description'];?></div>
                    </div>
                </div>

            </fieldset>
            <div class="photo">
                <p id="warningPhoto">Attention le fichier doit faire au maximum 10 Mo!</p>
                <form action="pageOfEvent.php?name=<?php echo $eventName; ?>" method="post" enctype="multipart/form-data">
                    <input type="file" name="eventPicture"/>
                    <input type="submit" value="Valider" name="validation">
                </form>
            </div>
            <br/><br/>






            <?php if (strtotime($IsItPassed['EventDate']) < strtotime("now"))
                        { ?>

            <div class="eventPhotos">
                <?php
                            $getPhotos=$bdd->prepare('SELECT * FROM Photo WHERE IDEvent =:IDEvent');
                            $getPhotos->bindValue(':IDEvent',$InfoEvent['IDEvent'],PDO::PARAM_INT);
                            $getPhotos->execute();
                ?>
                <?php while($photos=$getPhotos->fetch()){
                ?>
                <img class="myImg" value="<?php echo $photos['IDPhoto'];?>" src="<?php echo $photos['Url'];?>" alt="oui">
                <?php } ?>
            </div>


            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>
                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="imgModal">
                <!-- Modal Caption (Image Text) -->
                <div class="commentaire" id="commentaires">
                    <?php
                            if((!isset($_SESSION['Id']))||($_SESSION['Role'] == 'Inactif'))
                            {
                    ?>
                    <p> Connectez-vous pour pouvoir aimer et commenter! </p>
                    <?php
                            }

                            else if(isset($_SESSION['Id']))
                            {
                    ?>

                    <h1>Aimer la photo : </h1>

                    <!-- <button id="btn">J'aime</button>-->
                    <input id="btn" type="image" src="/projetWeb/imagePNG/like.png" />

                    <div>
                        <h1>Commentez :</h1>
                        <form action="commentEventPhoto.php" method="post">
                            <input type="text" id="monCommentaire"/>
                            <button type="reset" value="reset" id="submit"> envoyer </button>
                            <!--<button type="reset" value="Reset" id="submit"> envoyer </button>-->
                        </form>
                    </div>

                    <?php }
                    ?>

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



                        }


            ?>

            <?php
    if((isset($_SESSION['Role']))AND (($_SESSION['Role'] == 'CESIMember')||($_SESSION['Role'] == 'BDEMember'))){
            ?>

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

                    $.ajax({
                        url: 'alertAjax.php',// La ressource ciblée
                        type : 'POST', // Le type de la requête HTTP.
                        data : 'IDphotoClicked=' + modalidPhoto,
                        // On désire recevoir du HTML},
                        success : function(data){
                            document.getElementById("comments").innerHTML= (data);
                        },

                        error : function(resultat, statut, erreur){
                            // alert ("erreur");
                        },
                        complete : function(resultat, statut){
                            //alert ("ca marche");
                        }
                    });



                    btn.onclick = function (){
                        $.ajax({
                            url: 'likePhotoEvent.php',// La ressource ciblée
                            type : 'POST', // Le type de la requête HTTP.
                            data :'IDphotoClicked=' + modalidPhoto,

                            // On désire recevoir du HTML},
                            success : function(data){
                                alert (data);
                            },

                            error : function(resultat, statut, erreur){
                                //                                 alert ("erreur");
                            },
                            complete : function(resultat, statut){
                                //                                alert ("ca marche");
                            }
                        });

                    }

                    submit.onclick = function(){
                        var commentaire = document.getElementById('monCommentaire').value;
                        //                        alert (commentaire);
                        $.ajax({
                            url: 'commentEventPhoto.php',
                            type : 'POST',
                            data :
                            {
                                "IDphotoClicked": modalidPhoto,
                                "comment": commentaire,
                            },

                            success : function(data){
                                alert(data);
                                getComment();
                            },
                            error : function(resultat, statut, erreur){
                                alert ("erreur");
                            },
                            complete : function(resultat, statut){
                                //                                alert ("ca marche");
                            }
                        });
                    }



                });
            }

        </script>
    </body>
</html>
<?php
    //
    //    $getInfoEvent->closeCursor();
    //    $getPhotoEvent->closeCursor();
    //    $getDone->closeCursor();
    //    $getPhotos->closeCursor();

}
else {
    header('Location:pastEvent.php');
    exit();
}?>
