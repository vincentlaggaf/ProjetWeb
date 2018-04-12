<?php

try{
$bdd = new PDO('mysql:host=localhost;dbname=eventofthemonth;charset=utf8', 'root', '',array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
            {
                die ('Erreur : ' . $e->getMessage());
            }

$eventName = $_POST['eventName'];
$eventDescription = $_POST['eventDescription'];
$check = $bdd->prepare("SELECT NameEvent FROM happenings WHERE NameEvent= :eventName");
$check->bindValue(':eventName',$eventName, PDO::PARAM_STR);
$check->execute();
$create=$check->fetch();




if(isset($_FILES['photoOfTheEvent']) AND $_FILES['photoOfTheEvent']['error']==0)
        {
            if($_FILES['photoOfTheEvent']['size']<=1000000)
            {
                $infosPhoto = pathinfo($_FILES['photoOfTheEvent']['name']);
                $extensionPhoto = $infosPhoto['extension'];
                $extensionsAllowed = array('jpg', 'jpeg', 'png');
                if (in_array($extensionPhoto, $extensionsAllowed))
                {



                    move_uploaded_file($_FILES['photoOfTheEvent']['tmp_name'],'../imagePNG/events/'.basename($_FILES['photoOfTheEvent']['name']));

                    $name='../imagePNG/events/'.basename($_FILES['photoOfTheEvent']['name']);
                    echo "Photo bien reçue";

                }


            }

        }
// Requête préparée pour empêcher les injections SQL

    if($eventName==$create['eventName'])
    {
        echo "Cet évènement existe déjà";
    }

  else{  $requete = $bdd->prepare("INSERT INTO Happenings (NameEvent, Description,IDUser,NameEventCategory) VALUES( :eventName,:eventDescription,2,'incroyable')");

    $requete->bindValue(':eventName', $eventName, PDO::PARAM_STR);
    $requete->bindValue(':eventDescription', $eventDescription, PDO::PARAM_STR);

    $requete->execute();
      echo "Création d'évènement réussie !";

      }









//header('Location:eventOfTheMonth.php');
?>
