<?php
//gets and display the basket of a visitor
function getAndDisplayBasket($IDUser){
    $basket = getBasketQuery($IDUser);
    displayBasket($basket);
    $basket->closeCursor();
}

//gets the basket of a visitor and return it
function getBasket($IDUser){
    $getBasket = getBasketQuery($IDUser);
    $basketContent = $getBasket;
    $getBasket->closeCursor();
    return $basketContent;
}

//change the quantity of a goodie
function setBasket($IDUser, $NameGoodies, $Quantity){
    $setBasket = setBasketQuery($IDUser, $NameGoodies, $Quantity);
    $setBasket->closeCursor();
}

//delete the whole basket of a visitor
function deleteBasket($IDUser){
    $deleteBasket = deleteBasketQuery($IDUser);
    $deleteBasket->closeCursor();
}

//First fill the order table with the basket then delete the basket from the basket table
function validateBasket($IDUser){
    $validateBasket = getBasketQuery($IDUser);
    while ($data = $validateBasket->fetch())
    {
        $insertOrder = validateBasketQuery($IDUser, $data['NameGoodies'], $data['Quantity']);
        $insertOrder->closeCursor();
    }
    $validateBasket->closeCursor();

    $validateBasket = deleteBasketQuery($IDUser);

    $validateBasket->closeCursor();
}

//check if the basket is empty
function checkBasket($IDUser){
    $checkBasket = getBasketQuery($IDUser);
    $row = $checkBasket->rowCount();
    if($row == 0)
    {
        return false;
    }
    else
    {
        return true;
    }
}

//get the price of all the goodies in the basket
function getTotalPrice($IDUser){
    $getTotalPrice = getTotalPriceQuery($IDUser);
    $price = 0;
    while($data = $getTotalPrice->fetch())
    {
        $price = $price + $data['Price'] * $data['Quantity'];
    }
    $getTotalPrice->closeCursor();

    return $price;
}

//display the basket
function displayBasket($answer){
    while ($data = $answer->fetch())
    {
        ?>
        <div class="basket_information">
            <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>"  class="basket_picture"/>
            <div class="info_goodies"><?php echo $data['NameGoodies']; ?></div>
            <div class="info_goodies">Description :<br/><?php echo $data['Description']; ?></div>
            <div class="info_goodies">Prix unitaire : <?php echo $data['Price']; ?>€</div>

            <form action="\projetWeb\pagePHP\basket.php" method="post">
                <input type="hidden" name="changed" value="<?php echo $data['NameGoodies']; ?>">
                <input type="number" name="quantity" min="1" value="<?php echo $data['Quantity']; ?>">
                <input type="submit" value="Changer" class="change">
            </form>
        </div>
        <?php
    }
}
?>
