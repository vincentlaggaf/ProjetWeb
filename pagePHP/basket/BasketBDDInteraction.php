<?php
    function getBasketQuery($IDUser){
        $bdd = getBDD();
        $basketQuery = $bdd->prepare('CALL `BasketQuery`(:IDUser)') or die(print_r($bdd->errorInfo()));

        $basketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);

        $basketQuery->execute();

        return $basketQuery;
    }
?>
