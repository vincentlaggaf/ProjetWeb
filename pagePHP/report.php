<?php
session_start();

require 'sendMail/sendMail.php';
require 'BDDConnection.php';
require 'getInfoReport.php';



//two variables that indicate which type of content has been reported along with its ID
if (isset($_POST['category']) AND isset($_POST['contentId'])){
    //regarding the category we call different fonctions
    switch($_POST['category']){

        case 'photo':
            $photo= getPhotoInfos($_POST['contentId']);
            writeReport($photo['IDPhoto'], $photo['Url'], $_POST['category'], $_SESSION['LastName'], $_SESSION['FirstName']);
            break;

        case'event' :
            $happening= getHappeningInfos($_POST['contentId']);
            writeReport($happening['IDEvent'], $happening['NameEvent'], $_POST['category'], $_SESSION['LastName'],  $_SESSION['FirstName']);
            header('Location:eventOfTheMonth.php');
            exit();



            break;


        case 'comment':
            $comment= getCommentInfos($_POST['contentId']);

            writeReport($comment['IDComment'], $comment['CommentContent'], $_POST['category'], $_SESSION['LastName'],  $_SESSION['FirstName']);
            header('Location:pastEvent.php');
            exit();
            break;

    }
}
else{

}

header('Location:home.php');

?>
