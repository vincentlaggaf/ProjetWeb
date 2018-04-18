<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
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
echo $Login . $UserPassword;

$reponse = $bdd-> prepare("SELECT Login, UserPassword, Role, IDUser, FirstName, LastName, Mail FROM Users WHERE Login= :Login AND UserPassword= :UserPassword;");
$reponse->bindValue(':Login', $Login, PDO::PARAM_STR);
$reponse->bindValue(':UserPassword', $UserPassword, PDO::PARAM_STR);
$reponse->execute();
$identifiants= $reponse->fetch();

if($Login == $identifiants['Login'] AND $UserPassword == $identifiants['UserPassword'])
{
    $_SESSION['Login'] = $identifiants['Login'];
    $_SESSION['Role'] = $identifiants['Role'];
    $_SESSION['Id'] = $identifiants['IDUser'];
    $_SESSION['FirstName'] = $identifiants['FirstName'];
    $_SESSION['LastName'] = $identifiants['LastName'];
    $_SESSION['Mail'] = $identifiants['Mail'];
    echo '<script> document.location.replace(window.history.back());</script>';

}
else
{
    echo '<script> alert ("erreur authentification");</script>';
    echo '<script> document.location.replace(window.history.back());</script>';
}
?>

