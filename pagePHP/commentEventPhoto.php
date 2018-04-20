<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
require 'BDDConnection.php';

$bdd = getBDD();

// insert the comment according to the id of the photo
if(isset($_POST['IDphotoClicked'])){
    $addComment=$bdd->prepare('INSERT INTO Comments (CommentContent,IDUser,IDPhoto) VALUES(:commentaire,:IDUser,:IDPhoto)');
    $addComment->bindValue(':commentaire', $_POST['comment'], PDO::PARAM_INT);
    $addComment->bindValue(':IDUser', $_SESSION['Id'], PDO::PARAM_INT);
    $addComment->bindValue(':IDPhoto', $_POST['IDphotoClicked'], PDO::PARAM_INT);
    $addComment->execute();
    $addComment->closeCursor();
}

?>
