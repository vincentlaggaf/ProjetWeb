<?php
session_start();
require 'BDDConnection.php';

$bdd = getBDD();

if(isset($_POST['IDphotoClicked'])){

    // get info about the "likeOrNot" state for the photo liked and the user that liked it
    $getLikes=$bdd->prepare('SELECT * FROM Likes WHERE IDPhoto =:IDPhoto AND IDUser = :IDUser');
    $getLikes->bindValue(':IDPhoto',$_POST['IDphotoClicked'],PDO::PARAM_INT);
    $getLikes->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
    $getLikes->execute();
    $likes=$getLikes->fetch();


    // If it is to 0 (no like) it will pass to 1 (like)
    if ($_SESSION['Id']==$likes['IDUser']){
        if ($likes['LikeOrNot']==0){
            $Like = $bdd-> prepare("UPDATE Likes SET LikeOrNot=1 WHERE IDUser = :IDUser;");
            $Like->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
            $Like->execute();
            $Like->closeCursor();
            echo "Vous aimez!";
        }
        //the inverse happens if it is already to 1 (pass to 0)
        else if ($likes['LikeOrNot']==1){
            $LikeNot = $bdd-> prepare("UPDATE Likes SET LikeOrNot=0 WHERE IDUser = :IDUser;");
            $LikeNot->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
            $LikeNot->execute();
            $LikeNot->closeCursor();
            echo "Vous n'aimez plus!";
        }
        else{
            echo "erreur 1";
        }
    }
    else {

        // if the user never liked the photo, the like is added to the table
        $addLike=$bdd->prepare('INSERT INTO Likes (LikeOrNot,IDUser,IDPhoto) VALUES (1, :IDUser, :IDPhoto);');
        $addLike->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
        $addLike->bindValue(':IDPhoto', $_POST['IDphotoClicked'], PDO::PARAM_INT);
        $addLike->execute();
        $addLike->closeCursor();
        echo "Vous aimez!";
    }

}
?>
