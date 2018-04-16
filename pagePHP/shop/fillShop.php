<?php
    function roleCheck(){
        if(isset($_SESSION['Role']) AND $_SESSION['Role'] == "BDEMember")
        {
            $role = "BDEMember";
        }
        else
        {
            $role = "Student";
        }
        return $role;
    }

    function addGoodieToBasket($goodie, $quantity){
        $addGoodieToBasket = addGoodieToBasket($goodie, $quantity);
        $addGoodieToBasket->closeCursor();
    }

    function deleteGoodie($goodie){
        $deleteGoodie = deleteGoodieQuery($goodie);
        $deleteGoodie->closeCursor();
    }

    function normalShop(){
        $normalShop = getGoodiesQuery();
        displayGoodies($normalShop);
        $normalShop->closeCursor();
    }

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

    function researchedShop($research){
        $researchedShop = getGoodiesByResearch($research);
        displayGoodies($researchedShop);
        $researchedShop->closeCursor();
    }

    function categorisedShop(){
        $categorisedShop = getGoodiesByCategory();
        displayGoodies($categorisedShop);
        $categorisedShop->closeCursor();
    }

    function priceShop(){
        $priceShop = getGoodiesByPrice();
        displayGoodies($priceShop);
        $priceShop->closeCursor();
    }

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

                        <div class="info_goodies info_goodie_description info_goodies_margin">Description :<br/><?php echo $data['Description']; ?></div>

                        <form action="\projetWeb\pagePHP\shop.php" method="post">
                            <input type="hidden" name="buy" value="<?php echo $data['NameGoodies']; ?>">
                            <input type="number" min="1" value="1">
                            <input type="submit" value="Acheter">
                        </form>

                        <?php
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
