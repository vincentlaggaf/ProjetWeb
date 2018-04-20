<?php
    session_start();
require 'BDDConnection.php';

$bdd = getBDD();


$eventFreeOrNot=$_POST['freeOrNot'];
$recurrentOrNot=$_POST['recurrentOrNot'];
$eventCategory=$_POST['eventCategory'];
$photo="../imagePNG/events/".$_POST['photo'];
$idevent= $_SESSION['idevent'];



                  // Update the idea
        $validation = $bdd->prepare('UPDATE Happenings SET EventDate=:Date, NameEvent=:Name, Description=:description, NameEventCategory=:Category, Free=:IdeaFreeOrNot, Recurrent=:recurrent, Validate=1 WHERE IDEvent=:IDEvent');

                    $validation->bindValue(':IDEvent',$idevent,PDO::PARAM_INT);
                    $validation->bindValue(':Name',$_POST['titleval'],PDO::PARAM_STR);
                    $validation->bindValue(':Date',$_POST['dateValidaiton'],PDO::PARAM_STR);
                    $validation->bindValue(':IdeaFreeOrNot',$eventFreeOrNot,PDO::PARAM_INT);
                    $validation->bindValue(':recurrent',$recurrentOrNot,PDO::PARAM_INT);
                    $validation->bindValue(':description',$_POST['descriptionval'],PDO::PARAM_STR);
                    $validation->bindValue(':Category',$eventCategory,PDO::PARAM_STR);
                    $validation->execute();
                    $validation->closeCursor();

                    $addPhoto = $bdd->prepare('INSERT INTO Photo (Url,IDEvent) VALUES(:photo,:IDEvent)');
                    $addPhoto->bindValue(':photo',$photo,PDO::PARAM_STR);
                    $addPhoto->bindValue(':IDEvent',$idevent,PDO::PARAM_INT);
                    $addPhoto->execute();
          ?>
            <?php
            header('Location:http://localhost/projetWeb/pagePHP/IdeaBox.php');
            exit();

            ?>

