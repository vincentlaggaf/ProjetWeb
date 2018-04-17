<?php
    function getBasketQuery($IDUser){
        $bdd = getBDD();
        $basketQuery = $bdd->prepare('CALL `BasketQuery`(:IDUser)') or die(print_r($bdd->errorInfo()));

        $basketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);

        $basketQuery->execute();

        return $basketQuery;
    }

    function deleteBasketQuery($IDUser){
        $bdd = getBDD();
        $deleteBasketQuery = $bdd->prepare('CALL `DeleteBasket`(:IDUser)') or die(print_r($bdd->errorInfo()));

        $deleteBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);

        $deleteBasketQuery->execute();

        return $deleteBasketQuery;
    }

    function validateBasketQuery($IDUser, $NameGoodies, $Quantity){
        $bdd = getBDD();
        $validateBasketQuery = $bdd->prepare('CALL `InsertOrderQuery`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

        $validateBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
        $validateBasketQuery->bindValue(':NameGoodies', $NameGoodies, PDO::PARAM_STR);
        $validateBasketQuery->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

        $validateBasketQuery->execute();

        return $validateBasketQuery;
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
