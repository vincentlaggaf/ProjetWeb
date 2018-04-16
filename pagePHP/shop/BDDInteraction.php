<?php

    function checkBasketQuery($IDUser, $NameGoodie){
        $bdd = getBDD();

        $checkBasketQuery = $bdd->prepare('CALL `CheckBasket`(:IDUser, :NameGoodies)') or die(print_r($bdd->errorInfo()));

        $checkBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
        $checkBasketQuery->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);

        $checkBasketQuery->execute();

        return $checkBasketQuery;
    }

    function changeQuantityOnBasketGoodies($IDUser, $NameGoodie, $Quantity){
        $bdd = getBDD();

        $changeQuantityOnBasketGoodies = $bdd->prepare('CALL `ChangeQuantityOnBasketGoodies`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

        $changeQuantityOnBasketGoodies->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
        $changeQuantityOnBasketGoodies->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);
        $changeQuantityOnBasketGoodies->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

        $changeQuantityOnBasketGoodies->execute();

        return $changeQuantityOnBasketGoodies;
    }

    function addGoodieToBasketQuery($IDUser, $NameGoodie, $Quantity){
        $bdd = getBDD();

        $addGoodieToBasketQuery = $bdd->prepare('CALL `AddGoodieToBasket`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

        $addGoodieToBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
        $addGoodieToBasketQuery->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);
        $addGoodieToBasketQuery->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

        $addGoodieToBasketQuery->execute();

        return $addGoodieToBasketQuery;
    }

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
?>
