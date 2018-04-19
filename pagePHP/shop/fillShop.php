<?php
//return the role of the visitor
function roleCheck(){
    if(isset($_SESSION['Role']) AND $_SESSION['Role'] == "BDEMember")
    {
        $role = "BDEMember";
    }
    else if(isset($_SESSION['Role']) AND $_SESSION['Role'] == "CESIMember")
    {
        $role = "CESIMember";
    }
    else if(isset($_SESSION['Role']) AND $_SESSION['Role'] == "Inactif")
    {
        $role = "Inactif";
    }
    else if(isset($_SESSION['Role']))
    {
        $role = "Student";
    }
    else
    {
        $role = "Visitor";
    }
    return $role;
}

//add the goodie to the basket, if this goodie was already in it, it increase the quantity
function addGoodieToBasket($IDUser, $NameGoodie, $Quantity){
    $addGoodieToBasket = checkBasketQuery($IDUser, $NameGoodie);
    $row = $addGoodieToBasket->rowCount();
    $addGoodieToBasket->closeCursor();
    if($row >= 1){
        changeQuantityOnBasketGoodies($IDUser, $NameGoodie, $Quantity);
    }
    else{
        $addGoodieToBasket = addGoodieToBasketQuery($IDUser, $NameGoodie, $Quantity);
    }
    $addGoodieToBasket->closeCursor();
}

//delete a goodie
function deleteGoodie($NameGoodie){
    $deleteGoodie = deleteGoodieQuery($NameGoodie);
    $deleteGoodie->closeCursor();
}

//get and display all the goodies
function normalShop(){
    $normalShop = getGoodiesQuery();
    displayGoodies($normalShop);
    $normalShop->closeCursor();
}

//get the three most popular goodies and display them
function getPopularGoodies(){
    $getPopularGoodies = getPopularGoodiesQuery();
    displayGoodies($getPopularGoodies);
    $getPopularGoodies->closeCursor();
}

//get and display the goodies by popularity
function getGoodiesByPopularity(){
    $getGoodiesByPopularity = getGoodiesByPopularityQuery();
    displayGoodies($getGoodiesByPopularity);
    $getGoodiesByPopularity->closeCursor();
}

//look if the research had a response
function researchCheck($research){
    $researchedShop = getGoodiesByResearch($research);
    $row = $researchedShop->rowCount();
    if($row == 0)
    {
        ?>
        <p>Votre recherche ne donne rien, veuillez essayer quelque chose d'autre.</p>
        <?php
        $check = false;
    }
    else
    {
        $check = true;
    }
    $researchedShop->closeCursor();
    return $check;
}

//get the results of the research and display them
function researchedShop($research){
    $researchedShop = getGoodiesByResearch($research);
    displayGoodies($researchedShop);
    $researchedShop->closeCursor();
}

//get and display the goodies by category
function categorisedShop(){
    $categorisedShop = getGoodiesByCategory();
    displayGoodies($categorisedShop);
    $categorisedShop->closeCursor();
}

//get and display the goodies by price
function priceShop(){
    $priceShop = getGoodiesByPrice();
    displayGoodies($priceShop);
    $priceShop->closeCursor();
}

//display the selected goodies
function displayGoodies($answer){
    while ($data = $answer->fetch())
    {
?>
<div class="shop">
    <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>" class="shop-picture"/>

    <div class="goodies_information">
        <div class="goodies_information_part">

            <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>" class="goodies-picture"/>

            <div class="info_goodies">Nom :<br/><?php echo $data['NameGoodies']; ?></div>


            <div class="info_goodies">Catégorie :<br/><?php echo $data['NameGoodiesCategory']; ?></div>

            <div class="info_goodies">Prix :<br/><?php echo $data['Price']; ?>€</div>

        </div>
        <div class="goodies_information_part">

            <div class="info_goodies info_goodie_description">Description :<br/><?php echo $data['Description']; ?></div>
            <?php
             if(isset($_SESSION['Role']) AND $_SESSION['Role'] != "Inactif")
             {
                ?>
                <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="hidden" name="buy" value="<?php echo $data['NameGoodies']; ?>">
                    <input type="number" name="quantity" min="1" value="1" class="inputNumber">
                    <input type="submit" value="Acheter">
                </form>
             <?php
             }
             if(roleCheck() == "BDEMember")
             {
             ?>
                <form action="\projetWeb\pagePHP\shop.php" method="post">
                    <input type="hidden" name="delete" value="<?php echo $data['NameGoodies']; ?>">
                    <input type="submit" value="Supprimer">
                </form>
             <?php
             }
             ?>
        </div>
    </div>
</div>
<?php
    }
}
?>
