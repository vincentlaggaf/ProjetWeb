<?php
    function chooseCategory(){
        $bdd = getBDD();
        $chooseCategory = $bdd->prepare('CALL `GetGoodiesCategory`()') or die(print_r($bdd->errorInfo()));

        $chooseCategory->execute();

        while($data = $chooseCategory->fetch())
        {
            ?>
            <option value="<?php echo $data[' NameGoodiesCategory'] ?>"><?php echo $data['NameGoodiesCategory'] ?></option>
            <?php
        }

        $chooseCategory->closeCursor();
    }

?>
