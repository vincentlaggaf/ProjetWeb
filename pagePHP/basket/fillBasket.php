<?php
    function getBasket($IDUser){
        $basket = getBasketQuery($IDUser);
        $price = displayBasket($basket);
        $basket->closeCursor();
        return $price;
    }

    function setBasket($IDUser, $NameGoodies, $Quantity){
        $setBasket = setBasketQuery($IDUser, $NameGoodies, $Quantity);
        $setBasket->closeCursor();
    }

    function deleteBasket($IDUser){
        $deleteBasket = deleteBasketQuery($IDUser);
        $deleteBasket->closeCursor();
    }

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
