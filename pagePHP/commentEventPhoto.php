<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
try
{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die ('Erreur : ' . $e->getMessage());
}

if(isset($_POST['IDphotoClicked'])){

    $addComment=$bdd->prepare('INSERT INTO Comments (CommentContent,IDUser,IDPhoto) VALUES(:commentaire,:IDUser,:IDPhoto)');
    $addComment->bindValue(':commentaire', $_POST['comment'], PDO::PARAM_INT);
    $addComment->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
    $addComment->bindValue(':IDPhoto', $_POST['IDphotoClicked'], PDO::PARAM_INT);
    $addComment->execute();
    $addComment->closeCursor();
    echo "votre commentaire a été pris en compte :)";
}

?>
