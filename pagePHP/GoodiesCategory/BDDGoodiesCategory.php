<?php
function getGoodiesCategory(){
    $bdd = getBDD();

    $getGoodiesCategory = $bdd->prepare('CALL `GetGoodiesCategory`()') or die(print_r($bdd->errorInfo()));

    $getGoodiesCategory->execute();

    displayGoodiesCategory($getGoodiesCategory);

    $getGoodiesCategory->closeCursor();
}

function insertNewCategory($newCategory){
    $bdd = getBDD();

    $insertNewCategory = $bdd->prepare('CALL `InsertNewGoodiesCategory`(:newCategory)') or die(print_r($bdd->errorInfo()));

    $insertNewCategory->bindValue(':newCategory', $newCategory, PDO::PARAM_STR);

    $insertNewCategory->execute();

    $insertNewCategory->closeCursor();
}

function checkCategory($newCategory){
    $bdd = getBDD();

    $insertNewCategory = $bdd->prepare('CALL `CheckGoodiesCategory`(:newCategory)') or die(print_r($bdd->errorInfo()));

    $insertNewCategory->bindValue(':newCategory', $newCategory, PDO::PARAM_STR);

    $insertNewCategory->execute();

    $row = $insertNewCategory->rowCount();

    if($row == 0)
    {
        $insertNewCategory->closeCursor();
        return true;
    }
    else
    {
        $insertNewCategory->closeCursor();
        return false;
    }
}

function displayGoodiesCategory($Categories){
    while($data = $Categories->fetch())
    {
?>
<p class="nameGoodiesCategory"><?php echo $data['NameGoodiesCategory'] ?>
    <?php
    }
}
    ?>
