<?php
try
{
    $bdd = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$Login = $_POST['Login'];
$UserPassword = $_POST['UserPassword'];
$Mail =  $_POST['Mail'];
$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];

$reponse = $bdd->prepare("SELECT Login FROM Users WHERE Login= :Login");
$reponse->bindValue(':Login', $Login, PDO::PARAM_STR);
$reponse->execute();
$pseudo = $reponse->fetch();

if($Login == $pseudo['Login']){
    echo '<script> alert ("pseudo déjà utilisé");</script>';
    echo '<script> document.location.replace(window.history.back());</script>';
}

else {
    $requete = $bdd->prepare("INSERT INTO Users (Login, UserPassword, Mail, LastName, FirstName, Role) VALUES(:Login, :UserPassword, :Mail, :LastName, :FirstName, 'Student');");
    $requete->bindValue(':Login', $Login, PDO::PARAM_STR);
    $requete->bindValue(':UserPassword', $UserPassword, PDO::PARAM_STR);
    $requete->bindValue(':Mail', $Mail, PDO::PARAM_STR);
    $requete->bindValue(':LastName', $LastName, PDO::PARAM_STR);
    $requete->bindValue(':FirstName', $FirstName, PDO::PARAM_STR);
    $requete->execute();
    echo '<script> document.location.replace(window.history.back());</script>';
}
?>
