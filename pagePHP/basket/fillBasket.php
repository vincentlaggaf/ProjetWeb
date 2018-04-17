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
                <div class="info_goodies">Prix : <?php echo $data['Price']; ?></div>

                <form action="\projetWeb\pagePHP\basket.php" method="post">
                    <input type="hidden" name="changed" value="<?php echo $data['NameGoodies']; ?>">
                    <input type="number" name="quantity" min="1" value="<?php echo $data['Quantity']; ?>">
                    <input type="submit" value="Changer">
                </form>
            </div>
        <?php
        }
    }
?>
