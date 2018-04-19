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




// Requête préparée pour empêcher les injections SQL

if($eventName==$create['NameEvent'])
{
    echo "Cet évènement existe déjà";
}

else
{
    $requete = $bdd->prepare("INSERT INTO Happenings (Validate,NameEvent,Free,Recurrent, Description,IDUser,NameEventCategory,EventDate) VALUES( 1,:eventName,:eventFreeOrNot,:eventRecurrentOrNot,:eventDescription,:idUser,:nameEventCategory,:dateOfTheEvent)");


    $requete->bindValue(':eventName', $eventName, PDO::PARAM_STR);
    $requete->bindValue(':eventDescription', $eventDescription, PDO::PARAM_STR);
    $requete->bindValue(':eventFreeOrNot',$eventFreeOrNot,PDO::PARAM_INT);
    $requete->bindValue(':eventRecurrentOrNot',$eventRecurrentOrNot,PDO::PARAM_INT);
    $requete->bindValue(':dateOfTheEvent',$eventDate,PDO::PARAM_STR);
    $requete->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $requete->bindValue(':nameEventCategory',$eventCategory,PDO::PARAM_STR);
    $requete->execute();



    if(isset($_FILES['photoOfTheEvent']) AND $_FILES['photoOfTheEvent']['error']==0)
    {
        if($_FILES['photoOfTheEvent']['size']<=10000000)
        {
            $infosPhoto = pathinfo($_FILES['photoOfTheEvent']['name']);
            $namePhoto=str_replace(' ','_',($_FILES['photoOfTheEvent']['name']));





            $extensionPhoto = $infosPhoto['extension'];
            $extensionsAllowed = array('jpg', 'jpeg', 'png','PNG','JPG','JPEG');
            if (in_array($extensionPhoto, $extensionsAllowed))
            {
                $getId=$bdd->prepare("SELECT IDEvent FROM Happenings WHERE NameEvent= :eventName");
                $getId->bindValue(':eventName',$eventName,PDO::PARAM_STR);
                $getId->execute();
                $id=$getId->fetch();//Déplacer cette partie : $id=requete->fetch();
                $idToLookFor=$id['IDEvent'];
                echo $idToLookFor;
                $urlPhoto='../imagePNG/events/'.'1-'.basename($namePhoto);
                $sent=0;




                while($sent==0)
                {

                    $checkUrl=$bdd->prepare("SELECT Url FROM Photo WHERE Url=:UrlNewPhoto");
                    $checkUrl->bindValue(':UrlNewPhoto',$urlPhoto,PDO::PARAM_STR);
                    $checkUrl->execute();
                    $getUrl=$checkUrl->fetch();
                    if($urlPhoto==$getUrl['Url'])
                    {
                        $nameOfPhotoFromBdd=explode('/',$getUrl['Url']);
                        //echo $nameOfPhotoFromBdd[(count($nameOfPhotoFromBdd)-1)];
                        $newNumberPhoto=explode('-', $nameOfPhotoFromBdd[(count($nameOfPhotoFromBdd)-1)]);
                        //echo $numberPhoto[0];
                        $numberPhoto=$numberPhoto[0]+1;
                        $urlPhoto='../imagePNG/events/'.$numberPhoto.'-'.basename($namePhoto);

                    }
                    else
                    {
                        $sent=1;
                    }
                }
                move_uploaded_file($_FILES['photoOfTheEvent']['tmp_name'],'../imagePNG/events/'.$numberPhoto.'-'.basename($namePhoto));
            }

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
