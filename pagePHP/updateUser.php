<?php

try
{
    $bdd = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$LastName = $_POST['LastName'];
$FirstName = $_POST['FirstName'];
$Role = $_POST['Role'];
$ChooseRole = $_POST['ChooseRole'];

echo $LastName;
echo $FirstName;
echo $Role;
echo $ChooseRole;

try
{
    $bdd2 = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
    $request = $bdd2-> prepare("UPDATE Users SET Role= :Role WHERE LastName= :LastName, FirstName= :FirstName;");
    $request->bindValue(':LastName', $LastName, ':FirstName', $FirstName, ':Role', $ChooseRole, PDO::PARAM_STR);
    $request->execute();
    $request->closeCursor();
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

?>
