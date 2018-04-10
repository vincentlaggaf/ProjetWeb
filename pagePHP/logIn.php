<?php

try
{
    //    $bdd = new PDO('mysql:host=localhost;dbname=WSProsit5', 'root', 'root');
    $bdd = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$Login = $_POST['Login'];
$UserPassword = $_POST['UserPassword'];

$reponse = $bdd-> prepare("SELECT Login FROM Users WHERE Login= :Login;");
$reponse->bindValue(':Login', $Login, PDO::PARAM_STR);
$reponse->execute();
$pseudo= $reponse->fetch();


$reponseBis = $bdd-> prepare("SELECT UserPassword FROM Users WHERE UserPassword= :UserPassword;");
$reponseBis->bindValue(':UserPassword', $UserPassword, PDO::PARAM_STR);
$reponseBis->execute();
$password= $reponseBis->fetch();


if(($Login != $pseudo['Login'])||($UserPassword != $password['UserPassword'])){
    echo '<script> alert ("erreur authentification")</script>';
}

else {
    $requete = $bdd->prepare("SELECT * FROM Users WHERE Login= :Login;");
    $requete->execute();
    echo '<script> alert ("ok")</script>';
}

?>
