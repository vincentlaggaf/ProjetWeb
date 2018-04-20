<?php
session_start();
try{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die ('Erreur : ' . $e->getMessage());
}

$eventName = $_POST['eventName'];
$idUser=$_SESSION['Id'];
$eventCategory=str_replace('_',' ',$_POST['eventCategory']);
$eventDescription = $_POST['eventDescription'];
$eventFreeOrNot=$_POST['freeOrNot'];
$eventRecurrentOrNot=$_POST['recurrentOrNot'];
$eventDate=$_POST['dateOfTheEvent'];
$check = $bdd->prepare("SELECT NameEvent FROM Happenings WHERE NameEvent= :eventName");
$check->bindValue(':eventName',$eventName, PDO::PARAM_STR);
$check->execute();
$create=$check->fetch();





//If an event with the same name already exists
if($eventName==$create['NameEvent'])
{
    echo "Cet évènement existe déjà";
}

else
{
    //Insert all the relative infos about the event in the table
    $requete = $bdd->prepare("INSERT INTO Happenings (Validate,NameEvent,Free,Recurrent, Description,IDUser,NameEventCategory,EventDate) VALUES( 1,:eventName,:eventFreeOrNot,:eventRecurrentOrNot,:eventDescription,:idUser,:nameEventCategory,:dateOfTheEvent)");


    $requete->bindValue(':eventName', $eventName, PDO::PARAM_STR);
    $requete->bindValue(':eventDescription', $eventDescription, PDO::PARAM_STR);
    $requete->bindValue(':eventFreeOrNot',$eventFreeOrNot,PDO::PARAM_INT);
    $requete->bindValue(':eventRecurrentOrNot',$eventRecurrentOrNot,PDO::PARAM_INT);
    $requete->bindValue(':dateOfTheEvent',$eventDate,PDO::PARAM_STR);
    $requete->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $requete->bindValue(':nameEventCategory',$eventCategory,PDO::PARAM_STR);
    $requete->execute();


    //Check if a file is attached to it
    if(isset($_FILES['photoOfTheEvent']) AND $_FILES['photoOfTheEvent']['error']==0)
    {
        //check its size
        if($_FILES['photoOfTheEvent']['size']<=10000000)
        {
            $infosPhoto = pathinfo($_FILES['photoOfTheEvent']['name']);
            $namePhoto=str_replace(' ','_',($_FILES['photoOfTheEvent']['name']));





            $extensionPhoto = $infosPhoto['extension'];
            $extensionsAllowed = array('jpg', 'jpeg', 'png','PNG','JPG','JPEG');
            //check if the file is a photo
            if (in_array($extensionPhoto, $extensionsAllowed))
            {
                //Get the ID of the event from above
                $getId=$bdd->prepare("SELECT IDEvent FROM Happenings WHERE NameEvent= :eventName");
                $getId->bindValue(':eventName',$eventName,PDO::PARAM_STR);
                $getId->execute();
                $id=$getId->fetch();
                $idToLookFor=$id['IDEvent'];
                echo $idToLookFor;
                $urlPhoto='../imagePNG/events/'.'1-'.basename($namePhoto);
                $sent=0;




                while($sent==0)
                {
                    //Check if a photo with the same name is already existing
                    $checkUrl=$bdd->prepare("SELECT Url FROM Photo WHERE Url=:UrlNewPhoto");
                    $checkUrl->bindValue(':UrlNewPhoto',$urlPhoto,PDO::PARAM_STR);
                    $checkUrl->execute();
                    $getUrl=$checkUrl->fetch();
                    $numberPhoto = 0;
                    //if so explode the url to get the name and add a variable that will be incremented
                    if($urlPhoto==$getUrl['Url'])
                    {
                        $nameOfPhotoFromBdd=explode('/',$getUrl['Url']);

                        $numberPhoto=explode('-', $nameOfPhotoFromBdd[(count($nameOfPhotoFromBdd)-1)]);

                        $numberPhoto=$numberPhoto[0]+1;
                        $urlPhoto='../imagePNG/events/'.$numberPhoto.'-'.basename($namePhoto);

                    }
                    //else set the sent variable to 1 allowing the photo to be inserted in the DB
                    else
                    {
                        $sent=1;
                    }
                }
                //move the file in the folder of the events
                move_uploaded_file($_FILES['photoOfTheEvent']['tmp_name'],'../imagePNG/events/'.$numberPhoto.'-'.basename($namePhoto));
            }

            //insert the infos in the DB
            $saveUrl=$bdd->prepare("INSERT INTO Photo (Url,IDEvent)VALUES (:url,:IDEvent) ");
            $saveUrl->bindValue(':url',$urlPhoto,PDO::PARAM_STR);
            echo $idToLookFor;
            $saveUrl->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_INT);
            $saveUrl->execute();
        }
    }
    else
    {
        echo "<script>alert('Une erreur s'est produite lors de l'envoi de la photo,veuillez réduire la taille de celle-ci!');</script>";
        echo '<script> document.location.replace(/projetWeb/pagePHP/addNewEventOfTheMonth.php);</script>';
    }
}


//header('Location:eventOfTheMonth.php');
?>
