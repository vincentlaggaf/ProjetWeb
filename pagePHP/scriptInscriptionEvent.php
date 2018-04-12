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


$check=$bdd

else {
    $addUserToEvent=$bdd->prepare("INSERT INTO interest (IDUser,Participate,IDEvent) VALUES(4,1,:IDEvent)");


    $addUserToEvent->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
    $addUserToEvent->execute();
    echo "Inscription réussie";
}
    //$
    //$

?>
