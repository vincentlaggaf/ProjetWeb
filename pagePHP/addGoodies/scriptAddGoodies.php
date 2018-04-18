<?php
function chooseCategory(){
    $bdd = getBDD();
    $chooseCategory = $bdd->prepare('CALL `GetGoodiesCategory`()') or die(print_r($bdd->errorInfo()));

    $chooseCategory->execute();

    while($data = $chooseCategory->fetch())
    {
        ?>
        <option value="<?php echo $data['NameGoodiesCategory'] ?>"><?php echo $data['NameGoodiesCategory'] ?></option>
        <?php
    }

    $chooseCategory->closeCursor();
}

function checkNewGoodieName ($name){
    $bdd = getBDD();
    $checkNewGoodieName = $bdd->prepare('CALL `CheckNewGoodieName`(:NameGoodies)') or die(print_r($bdd->errorInfo()));

    $checkNewGoodieName->bindValue(':NameGoodies', $name, PDO::PARAM_STR);

    $checkNewGoodieName->execute();

    $row = $checkNewGoodieName->rowCount();

    if($row == 0)
    {
        $checkNewGoodieName->closeCursor();
        return true;
    }
    else
    {
        $checkNewGoodieName->closeCursor();
        return false;
    }
}

function addNewGoodie($name, $URL, $description, $category, $price){
    $bdd = getBDD();
    $addNewGoodie = $bdd->prepare('CALL `AddNewGoodie`(:NameGoodies, :Price, :URL, :NameGoodiesCategory, :Description)') or die(print_r($bdd->errorInfo()));

    $addNewGoodie->bindValue(':NameGoodies', $name, PDO::PARAM_STR);
    $addNewGoodie->bindValue(':Price', $price, PDO::PARAM_STR);
    $addNewGoodie->bindValue(':URL', $URL, PDO::PARAM_STR);
    $addNewGoodie->bindValue(':NameGoodiesCategory', $category, PDO::PARAM_STR);
    $addNewGoodie->bindValue(':Description', $description, PDO::PARAM_STR);

    $addNewGoodie->execute();

    $addNewGoodie->closeCursor();
}

function checkFileURL($urlPhoto){
    $bdd=getBDD();
    $checkUrl=$bdd->prepare('CALL `CheckFileURL`(:UrlNewPhoto)') or die(print_r($bdd->errorInfo()));
    $checkUrl->bindValue(':UrlNewPhoto',$urlPhoto,PDO::PARAM_STR);
    $checkUrl->execute();
    return $checkUrl;
}

function getFile(){
    if(isset($_FILES['photoOfTheGoodie']) AND $_FILES['photoOfTheGoodie']['error']==0)
    {
        if($_FILES['photoOfTheGoodie']['size']<=10000000)
        {
            $infosPhoto = pathinfo($_FILES['photoOfTheGoodie']['name']);
            $namePhoto=str_replace(' ','_',($_FILES['photoOfTheGoodie']['name']));

            $extensionPhoto = $infosPhoto['extension'];
            $extensionsAllowed = array('jpg', 'jpeg', 'png','PNG','JPG','JPEG');
            if (in_array($extensionPhoto, $extensionsAllowed))
            {
                $newNumberPhoto = 1;
                $urlPhoto='../imagePNG/boutique/'.$newNumberPhoto.'-'.basename($namePhoto);
                $sent=0;

                while($sent==0)
                {
                    $checkUrl = checkFileURL($urlPhoto);
                    $getUrl=$checkUrl->fetch();
                    if($urlPhoto==$getUrl['URL'])
                    {
                        $nameOfPhotoFromBdd=explode('/',$getUrl['URL']);
                        $numberPhoto=explode('-', $nameOfPhotoFromBdd[(count($nameOfPhotoFromBdd)-1)]);
                        $newNumberPhoto=$numberPhoto[0]+1;
                        $urlPhoto='../imagePNG/boutique/'.$newNumberPhoto.'-'.basename($namePhoto);
                    }
                    else
                    {
                        $sent=1;
                    }
                    $checkUrl->closeCursor();
                    move_uploaded_file($_FILES['photoOfTheGoodie']['tmp_name'],$urlPhoto);
                }
            }
        }
        else
        {
            echo "Une erreur s'est produite lors de l'envoi de la photo, veuillez réduire la taille de celle-ci!";
        }
        return $urlPhoto;
    }
    else
    {
        echo "Une erreur s'est produite lors du transfert du fichier, veuillez rééssayer. Si le problème persiste veuillez choissir un autre fichier.";
    }
}
?>
