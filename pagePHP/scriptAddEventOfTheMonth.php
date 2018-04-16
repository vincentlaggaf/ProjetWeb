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

  else{  $requete = $bdd->prepare("INSERT INTO Happenings (Validate,NameEvent,Free,Recurrent, Description,IDUser,NameEventCategory,EventDate) VALUES( 1,:eventName,:eventFreeOrNot,:eventRecurrentOrNot,:eventDescription,:idUser,:nameEventCategory,:dateOfTheEvent)");


    $requete->bindValue(':eventName', $eventName, PDO::PARAM_STR);
    $requete->bindValue(':eventDescription', $eventDescription, PDO::PARAM_STR);
    $requete->bindValue(':eventFreeOrNot',$eventFreeOrNot,PDO::PARAM_INT);
    $requete->bindValue(':eventRecurrentOrNot',$eventRecurrentOrNot,PDO::PARAM_INT);
    $requete->bindValue(':dateOfTheEvent',$eventDate,PDO::PARAM_STR);
    $requete->bindValue(':idUser',$idUser,PDO::PARAM_INT);
    $requete->bindValue(':nameEventCategory',$eventCategory,PDO::PARAM_STR);

    $requete->execute();
      echo "Création d'évènement réussie !";


       if(isset($_FILES['photoOfTheEvent']) AND $_FILES['photoOfTheEvent']['error']==0)
        {
            if($_FILES['photoOfTheEvent']['size']<=1000000)
            {
                $infosPhoto = pathinfo($_FILES['photoOfTheEvent']['name']);
                $extensionPhoto = $infosPhoto['extension'];
                $extensionsAllowed = array('jpg', 'jpeg', 'png');
                if (in_array($extensionPhoto, $extensionsAllowed))
                {


                    $getId=$bdd->prepare("SELECT IDEvent FROM Happenings WHERE NameEvent= :eventName");
                    $getId->bindValue(':eventName',$eventName,PDO::PARAM_STR);
                    $getId->execute();
                    $id=$getId->fetch();

                    $idToLookFor=$id['IDEvent'];
                    echo $idToLookFor;

                    move_uploaded_file($_FILES['photoOfTheEvent']['tmp_name'],'../imagePNG/events/'.basename($_FILES['photoOfTheEvent']['name']));

                    $urlPhoto='../imagePNG/events/'.basename($_FILES['photoOfTheEvent']['name']);
                    echo "Photo bien reçue";

                    $saveUrl=$bdd->prepare("INSERT INTO Photo (Url,IDEvent)VALUES (:url,:IDEvent) ");
                    $saveUrl->bindValue(':url',$urlPhoto,PDO::PARAM_STR);
                    $saveUrl->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_INT);
                    $saveUrl->execute();

                }


            }

      }




        }






header('Location:eventOfTheMonth.php');
?>
