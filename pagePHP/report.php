<?php
session_start();

require 'sendMail\sendMail.php';
require 'BDDConnection.php';
require 'getInfoReport.php';

//
//echo $_POST['category'];
//echo $_POST['IDElement'];
//echo $_POST['IDUser'];

if (isset($_POST['category']) AND isset($_POST['contentId'])){

    switch($_POST['category']){

        case 'photo':
            $photo= getPhotoInfos($_POST['contentId']);
            break;

        case'event' :
            $happening= getHappeningInfos($_POST['contentId']);
            echo $happening['NameEvent'];
            writeReport($happening['IDEvent'], $happening['NameEvent'], $_POST['category'], $_SESSION['LastName'],  $_SESSION['FirstName']);
            break;

        case 'comment':
            $comment= getCommentInfos($_POST['contentId']);

            break;

    }


}
else{

}

//header('Location:home.php');

?>
