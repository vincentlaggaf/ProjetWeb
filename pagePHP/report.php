<?php
require 'sendMail\sendMail.php';
require 'BDDConnection.php';
$bdd=getBdd();

if (isset($_POST['category'])){

    switch($_POST['category'])


}


$bdd->prepare('SELECT :contentName FROM :contentCategory WHERE ')

?>
