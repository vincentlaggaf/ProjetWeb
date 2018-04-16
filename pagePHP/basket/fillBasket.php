<?php
    function basket($IDUser){
        $basket = getBasketQuery($IDUser);
        displayBasket($basket);
        $basket->closeCursor();
    }

    function displayBasket($answer){
        while ($data = $answer->fetch())
        {
        ?>
             <div class="basket_information">
                <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>"  class="basket_picture"/>
                <div class="info_goodies"><?php echo $data['NameGoodies']; ?></div>
                <div class="info_goodies">Description :<br/><?php echo $data['Description']; ?></div>

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
