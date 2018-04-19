<?php
require 'sendMail\sendMail.php';
require 'BDDConnection.php';
require 'getInfoReport.php';


if (isset($_POST['category']) AND isset($_POST['contentId'])){

    switch($_POST['category']){

        case 'photo':
            $photo= getPhotoInfos($_POST['contentId']);
            break;

        case'event' :
            $happening= getHappeningInfos($_POST['contentId']);
            echo $happening['NameEvent'];
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
