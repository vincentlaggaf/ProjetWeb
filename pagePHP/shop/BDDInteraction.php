<?php
//get a goodies in the basket of the visitor
function checkBasketQuery($IDUser, $NameGoodie){
    $bdd = getBDD();

    $checkBasketQuery = $bdd->prepare('CALL `CheckBasket`(:IDUser, :NameGoodies)') or die(print_r($bdd->errorInfo()));

    $checkBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
    $checkBasketQuery->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);

    $checkBasketQuery->execute();

    return $checkBasketQuery;
}

//change the quantity of a goodie in a basket
function changeQuantityOnBasketGoodies($IDUser, $NameGoodie, $Quantity){
    $bdd = getBDD();

    $changeQuantityOnBasketGoodies = $bdd->prepare('CALL `ChangeQuantityOnBasketGoodies`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

    $changeQuantityOnBasketGoodies->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
    $changeQuantityOnBasketGoodies->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);
    $changeQuantityOnBasketGoodies->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

    $changeQuantityOnBasketGoodies->execute();

    return $changeQuantityOnBasketGoodies;
}

//add a goodie in a basket
function addGoodieToBasketQuery($IDUser, $NameGoodie, $Quantity){
    $bdd = getBDD();

    $addGoodieToBasketQuery = $bdd->prepare('CALL `AddGoodieToBasket`(:IDUser, :NameGoodies, :Quantity)') or die(print_r($bdd->errorInfo()));

    $addGoodieToBasketQuery->bindValue(':IDUser', $IDUser, PDO::PARAM_STR);
    $addGoodieToBasketQuery->bindValue(':NameGoodies', $NameGoodie, PDO::PARAM_STR);
    $addGoodieToBasketQuery->bindValue(':Quantity', $Quantity, PDO::PARAM_STR);

    $addGoodieToBasketQuery->execute();

    return $addGoodieToBasketQuery;
}

//gets all the goodies
function getGoodiesQuery(){
    $bdd = getBDD();
    $goodiesQuery = $bdd->prepare('CALL `GoodiesQuery`()') or die(print_r($bdd->errorInfo()));
    $goodiesQuery->execute();
    return $goodiesQuery;
}

//gets the three most popular goodies
function getPopularGoodiesQuery(){
    $bdd = getBDD();
    $getPopulargoodiesQuery = $bdd->prepare('CALL `PopularGoodiesQuery`()') or die(print_r($bdd->errorInfo()));
    $getPopulargoodiesQuery->execute();
    return $getPopulargoodiesQuery;
}

//delete a goodie in the database
function deleteGoodieQuery($goodie){
    $bdd = getBDD();
    $deleteGoodieQuery = $bdd->prepare('CALL `DeleteGoodie`(:goodie)') or die(print_r($bdd->errorInfo()));
    $deleteGoodieQuery->bindValue(':goodie', $goodie, PDO::PARAM_STR);
    $deleteGoodieQuery->execute();
    return $deleteGoodieQuery;
}

//gets the goodies corresponding to the research
function getGoodiesByResearch($research){
    $bdd = getBDD();
    $goodiesQuery = $bdd->prepare('CALL `GoodiesByResearch`(:research)') or die(print_r($bdd->errorInfo()));
    $goodiesQuery->bindValue(':research', $research, PDO::PARAM_STR);
    $goodiesQuery->execute();
    return $goodiesQuery;
}

//gets the goodies sorted by category
function getGoodiesByCategory(){
    $bdd = getBDD();
    $goodiesQuery = $bdd->prepare('CALL `GoodiesByCategory`()') or die(print_r($bdd->errorInfo()));
    $goodiesQuery->execute();
    return $goodiesQuery;
}

//gets the goodies sorted by price
function getGoodiesByPrice(){
    $bdd = getBDD();
    $goodiesQuery = $bdd->prepare('CALL `GoodiesByPrice`()') or die(print_r($bdd->errorInfo()));
    $goodiesQuery->execute();
    return $goodiesQuery;
}

//gets the goodies sorted by popularity
function getGoodiesByPopularityQuery(){
    $bdd = getBDD();
    $getGoodiesByPopularityQuery = $bdd->prepare('CALL `GoodiesByPopularity`()') or die(print_r($bdd->errorInfo()));
    $getGoodiesByPopularityQuery->execute();
    return $getGoodiesByPopularityQuery;
}
?>
