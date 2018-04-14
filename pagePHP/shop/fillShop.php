<?php
    function normalShop(){
        $normalShop = getGoodiesQuery();
        displayGoodies($normalShop);
        $normalShop->closeCursor();
    }

    function researchedShop($research){
        $researchedShop = getGoodiesByResearch($research);
        $row = $researchedShop->rowCount();
        if($row == 0)
        {
            $researchedShop->closeCursor();
            normalShop();
            echo '<script> alert ("Votre recherche ne donne rien, veuillez essayer quelque chose d\'autre.");</script>';
        }
        else
        {
            displayGoodies($researchedShop);
            $researchedShop->closeCursor();
        }

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

                        <div class="info_goodies">acheter</div>

                        <div class="info_goodies">supprimer</div>

                    </div>
                </div>
        </div>
<?php
    }
}
?>
