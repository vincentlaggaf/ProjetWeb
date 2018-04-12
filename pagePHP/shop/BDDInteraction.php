<?php
    session_start();

    function getGoodiesQuery(){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('SELECT * FROM Goodies') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

    function getBDD(){
        try
        {
            $bdd = new PDO('mysql:host=178.62.4.64;dbname=test_boutique_lav;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            return $bdd;
        }
        catch (Exception $e)
        {
            die ('Erreur : ' . $e->getMessage());
        }
    }


?>
