<?php
try
{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die ('Erreur : ' . $e->getMessage());
}


$IDEvent= $_POST['IDEvent'];
//$IDUser=$_SESSION['IDUser'];
//$IDUser=4;
$reloadPage=0;


$check=$bdd->prepare("SELECT IDUser FROM Interest WHERE IDEvent= :IDEvent");
$check->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
$check->execute();
$IDUserFromBDD=$check->fetch();
if(isset($IDUser) AND isset($IDEvent)){
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


}
else{

    header('Location: /projetWeb/pagePHP/eventOfTheMonth.php');
    exit();

    //    include ('modalInscription.php');
    //    document.getElementById('id01').style.display='block';
    // include('modalLogin.php');

    //echo '<script> document.location.replace(window.history.back());</script>';
    //    echo "<script>alert('Vous n\'êtes pas connectés !');</script>";
    //echo "<script>alert(document.referer);</script>";

    //include ('modalInscription.php');
    //     "<script> document.getElementById('id01').style.display='block';</script>";
    //"<script> document.getElementById('id01').style.display='block';</script>"



    //
}

?>
