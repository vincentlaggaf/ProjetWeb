<?php
    try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=eventofthemonth;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }


    $IDEvent= $_POST['IDEvent'];
    //$IDUser=$_SESSION['IDUser'];
    //$IDUser=4;
    $reloadPage=0;


$check=$bdd->prepare("SELECT IDUser FROM interest WHERE IDEvent= :IDEvent");
$check->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
$check->execute();
$IDUserFromBDD=$check->fetch();
    if(isset($IDUser)){
    if($IDUser=$IDUserFromBDD['IDUser'])
    {
        echo "<script>alert('Vous êtes déjà inscrit à l\'évènement !');
        window.location.replace('eventOfTheMonth.php');</script>";

    }
else {
    $addUserToEvent=$bdd->prepare("INSERT INTO interest (IDUser,Participate,IDEvent) VALUES(4,1,:IDEvent)");


    $addUserToEvent->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
    $addUserToEvent->execute();
    echo "Inscription réussie";
}
    //$
    //$
    }
else{

        echo "<script>alert('Vous n\'êtes pas connectés !');
        window.location.replace('eventOfTheMonth.php');</script>";



   // header('Location:http://localhost/projetWeb/pagePHP/eventOfTheMonth.php');
}

?>
