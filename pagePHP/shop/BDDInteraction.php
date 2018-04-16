<?php

    function getGoodiesQuery(){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('CALL `GoodiesQuery`()') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

    function deleteGoodieQuery($goodie){
        $bdd = getBDD();
        $deleteGoodieQuery = $bdd->prepare('CALL `DeleteGoodie`(:goodie)') or die(print_r($bdd->errorInfo()));
        $deleteGoodieQuery->bindValue(':goodie', $goodie, PDO::PARAM_STR);
        $deleteGoodieQuery->execute();
        return $deleteGoodieQuery;
    }

    function getGoodiesByResearch($research){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('CALL `GoodiesByResearch`(:research)') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->bindValue(':research', $research, PDO::PARAM_STR);
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

    function getGoodiesByCategory(){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('CALL `GoodiesByCategory`()') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

    function getGoodiesByPrice(){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('CALL `GoodiesByPrice`()') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

    function getGoodiesByPopularity(){
        $bdd = getBDD();
        $goodiesQuery = $bdd->prepare('CALL `GoodiesByPopularity`()') or die(print_r($bdd->errorInfo()));
        $goodiesQuery->execute();
        return $goodiesQuery;
    }

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
