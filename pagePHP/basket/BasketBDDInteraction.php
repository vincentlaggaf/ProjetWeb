<?php
    function getBasketQuery($IDUser){
        $bdd = getBDD();
        $basketQuery = $bdd->prepare('CALL `BasketQuery`(:IDUser)') or die(print_r($bdd->errorInfo()));

        $basketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);

        $basketQuery->execute();

        return $basketQuery;
    }

    function getTotalPriceQuery($IDUser){
        $bdd = getBDD();
        $getTotalPriceQuery = $bdd->prepare('CALL `GetTotalPriceQuery`(:IDUser)') or die(print_r($bdd->errorInfo()));

        $getTotalPriceQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);

        $getTotalPriceQuery->execute();

        return $getTotalPriceQuery;
    }

    function setBasketQuery($IDUser, $NameGoodies, $Quantity){
        $bdd = getBDD();
        $setBasketQuery = $bdd->prepare('CALL `SetBasketQuery`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

        $setBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
        $setBasketQuery->bindValue(':NameGoodies', $NameGoodies, PDO::PARAM_STR);
        $setBasketQuery->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

        $setBasketQuery->execute();

        return $setBasketQuery;
    }
?>
