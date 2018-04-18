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

<?php

if(isset($_GET['name'])){
    $eventName=$_GET['name'];

    $getInfoEvent=$bdd->prepare('SELECT * FROM Happenings WHERE NameEvent= :nameEvent');
    $getInfoEvent->bindValue(':nameEvent',$eventName,PDO::PARAM_STR);
    $getInfoEvent->execute();
    $InfoEvent=$getInfoEvent->fetch();

    $getPhotoEvent=$bdd->prepare('SELECT Url FROM Photo WHERE IDEvent =:IDEvent');
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
        <link rel="stylesheet" href="\projetWeb\feuilleCSS\style-eventOfTheMonth.css">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-pastEventCommentPhoto.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">

        <style>
            table img {
                width: 100%;
                height: auto;
            }


        </style>
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
                        <div class="titleAndPhoto">
                            <div class="photo"><img src="<?php echo $photoEvent['Url'] ;?>"alt="" class="thumbnail"></div>
                        </div>
                        <?php } ?>
                        <div class="eventDescription"><?php echo $InfoEvent['Description'];?></div>
                    </div>
                </div>
            </fieldset>

            <?php if (strtotime($IsItPassed['EventDate']) < strtotime("now"))
    { ?>
            <div>
                <table>
                    <tr>
                        <th>Galerie photo</th>
                    </tr>

                    <?php
        $nbOfPhoto=0;
        $getPhotos=$bdd->prepare('SELECT Url FROM Photo WHERE IDEvent =:IDEvent');
        $getPhotos->bindValue(':IDEvent',$InfoEvent['IDEvent'],PDO::PARAM_INT);
        $getPhotos->execute();
                    ?>
                    <tr>
                        <?php while($photos=$getPhotos->fetch()AND $nbOfPhoto<4){
                        ?>
                        <!-- <form action="" method="post">-->
                        <td><img class="myImg" src="<?php echo $photos['Url'];?>" alt="oui"></td>
                        <!-- </form>-->
                        <?php
                        $nbOfPhoto++;
                    }
                        ?>
                    </tr>
                    <?php
        // $nbOfPhoto=0;
        $getInfoEvent->closeCursor();
        $getPhotoEvent->closeCursor();
        $getDone->closeCursor();
        $getPhotos->closeCursor();
                    ?>
                </table>
            </div>

            <!-- The Modal -->
            <div id="myModal" class="modal">
                <!-- The Close Button -->
                <span class="close">&times;</span>
                <!-- Modal Content (The Image) -->
                <img class="modal-content" id="img02">
                <!-- Modal Caption (Image Text) -->
                <div class="commentaire" id="commentaires">
                    <h1>Aimer la photo : </h1>
                    <button onclick="likePhoto()" class="btn">J'aime</button>
                    <form action="">
                        <h1>Commentaires :</h1>
                        <input type="text" name="comment">
                        <button type="submit" class="btn">Envoyer</button>
                    </form>
                    <p> récupérer commentaires blablabla</p>
                </div>
            </div>
            <?php
    } ?>
        </section>
        <?php include('footer.php');?>




        <script>

            var img = document.getElementsByClassName('myImg');
            for(i=0; i<img.length; i++){
                img[i].addEventListener('click',function(e){

                    var modal = document.getElementById('myModal');
                    modal.style.display = "flex";

                    var modalImg = document.getElementById('img02');
                    modalImg.src = e.target.getAttribute('src');
                    // alert(e.target.getAttribute('src'));

                    // Get the <span> element that closes the modal
                    var span = document.getElementsByClassName("close")[0];
                    // When the user clicks on <span> (x), close the modal
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                });
            }

            //            function displayModalCommentaire(this){
            //                var modal = document.getElementById('myModal');
            //                modal.style.display = "flex";
            //                var modalImg = document.getElementById('img02');
            //                // Get the image and insert it inside the modal
            //                //                var img = document.getElementById(idImg);
            //                //                alert($i);
            ////                                modalImg.src = this.src;
            //                //                    "../imagePNG/events/cochon.png"
            //                //                    this.src;
            //
            //                //                captionText.innerHTML = this.alt;
            //                //                commentaires.display = "block";
            //                // Get the <span> element that closes the modal
            //                var span = document.getElementsByClassName("close")[0];
            //                // When the user clicks on <span> (x), close the modal
            //                span.onclick = function() {
            //                    modal.style.display = "none";
            //                }
            //            }

            function likePhoto() {
                alert ("il faut encore faire la gestion des likes.");
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
