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


$IDEvent= $_POST['IDEvent'];
$NameEvent=$_POST['NameEvent'];
$EventPath=str_replace(';','',$NameEvent);

if(isset($_POST['IDEvent'])AND isset($_POST['NameEvent'])){



    if(isset($_SESSION['Id']) AND isset($IDEvent)){

        $IDUser=$_SESSION['Id'];
        $check=$bdd->prepare("SELECT IDUser FROM Interest WHERE IDEvent= :IDEvent AND IDUser= :IDUser");
        $check->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
        $check->bindValue(':IDUser',$IDUser,PDO::PARAM_INT);
        $check->execute();
        $IDUserFromBDD=$check->fetch();
        echo $IDUser;

        // echo $IDUserFromBDD['IDUser'];

        if($IDUser==$IDUserFromBDD['IDUser'])
        {
            echo "<script>alert('Vous êtes déjà inscrit à l\'évènement !');
                window.location.replace('eventOfTheMonth.php');</script>";
        }
        else {
            $addUserToEvent=$bdd->prepare("INSERT INTO Interest (IDUser,Participate,IDEvent) VALUES(:IDUser,1,:IDEvent)");
            $addUserToEvent->bindValue(':IDEvent',$IDEvent,PDO::PARAM_INT);
            $addUserToEvent->bindValue(':IDUser',$IDUser,PDO::PARAM_INT);
            $addUserToEvent->execute();
            header('Location:http://localhost/projetWeb/pagePHP/pageOfEvent.php?name='.$EventPath);
        }
    }
    else{
        echo "<script>alert('Vous n\'êtes pas connectés !');</script>";
        echo '<script> document.location.replace(/projetWeb/pagePHP/eventOfTheMonth.php);</script>';
        //        header('Location: /projetWeb/pagePHP/eventOfTheMonth.php');
        //    exit();

        //    include ('modalInscription.php');
        //    document.getElementById('id01').style.display='block';
        // include('modalLogin.php');

        //
        //    include ('modalInscription.php');
        //    document.getElementById('id01').style.display='block';

        //include('modalLogin.php');

        //echo '<script> document.location.replace(window.history.back());</script>';
        //    echo "<script>alert('Vous n\'êtes pas connectés !');</script>";
        //echo "<script>alert(document.referer);</script>";

        //include ('modalInscription.php');
        //     "<script> document.getElementById('id01').style.display='block';</script>";
        //"<script> document.getElementById('id01').style.display='block';</script>"
        //  header('Location:http://localhost/projetWeb/pagePHP/eventOfTheMonth.php');

    }
}else{

    header('Location:http://localhost/projetWeb/pagePHP/eventOfTheMonth.php');

}

?>
