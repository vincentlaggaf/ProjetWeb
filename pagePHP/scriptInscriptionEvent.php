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

//get the variable sent by the post method from the form
$IDEvent= $_POST['IDEvent'];
$NameEvent=$_POST['NameEvent'];
$EventPath=str_replace(';','',$NameEvent);


//check if the variables are correctly set
if(isset($_POST['IDEvent'])AND isset($_POST['NameEvent'])){


    if(isset($_SESSION['Id']) AND isset($IDEvent)){

        //Check if the user is already participating to the event
        $IDUser=$_SESSION['Id'];
        $check=$bdd->prepare("SELECT * FROM Interest WHERE IDEvent= :IDEvent AND IDUser= :IDUser");
        $check->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
        $check->bindValue(':IDUser',$IDUser,PDO::PARAM_INT);
        $check->execute();
        $IDUserFromBDD=$check->fetch();

        //If he is
        if($IDUser==$IDUserFromBDD['IDUser'] )
        {
            $removeUserFromEvent=$bdd->prepare("DELETE FROM Interest  WHERE IDUser=:IDUser AND IDEvent = :IDEvent;");
            $removeUserFromEvent->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
            $removeUserFromEvent->bindValue(':IDUser',$IDUser,PDO::PARAM_INT);
            $removeUserFromEvent->execute();
           // header ('Location:http://localhost/projetWeb/pagePhp/eventOfTheMonth.php');
            echo "<script>alert('Vous n êtes plus inscrit !');
                window.location.replace('eventOfTheMonth.php');</script>";
        }
        //If he is not
        else {
            $addUserToEvent=$bdd->prepare("INSERT INTO Interest (IDUser,Participate,IDEvent) VALUES(:IDUser,1,:IDEvent)");
            $addUserToEvent->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
            $addUserToEvent->bindValue(':IDUser',$IDUser,PDO::PARAM_INT);
            $addUserToEvent->execute();
            echo "<script>alert('Vous venez de vous inscrire !');
                window.location.replace('eventOfTheMonth.php');</script>";
            //header('Location:http://localhost/projetWeb/pagePHP/pageOfEvent.php?name='.$EventPath);
        }
    }
    else{
        echo "<script>alert('Vous n\'êtes pas connectés !');</script>";
        echo '<script> document.location.replace(/projetWeb/pagePHP/eventOfTheMonth.php);</script>';


    }
}else{

    header('Location:http://localhost/projetWeb/pagePHP/eventOfTheMonth.php');

}

?>
