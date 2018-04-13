<?php

$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];
$Role = $_POST['Role'];
$ChooseRole = $_POST['ChooseRole'];

//echo $LastName;
//echo $FirstName;
//echo $Role;
//echo $ChooseRole;

try
{
    $bdd = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
    $request = $bdd-> prepare("UPDATE Users SET Role= :Role WHERE LastName = :LastName;");
    $request->bindValue(':Role', $ChooseRole, PDO::PARAM_STR);
    $request->bindValue(':LastName', $LastName, PDO::PARAM_STR);
    $request->execute();
    $request->closeCursor();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$url = '/projetWeb/pagePHP/administration.php';
header( "Location: $url" );

?>
