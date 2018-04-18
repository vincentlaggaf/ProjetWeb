<?php
//initialize a connection with the database
function getBDD(){
    try
    {
        $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        return $bdd;
    }
    catch (Exception $e)
    {
        die ('Erreur : ' . $e->getMessage());
    }
}
?>
