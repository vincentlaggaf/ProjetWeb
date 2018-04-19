<?php
//looks if the URL arleady exists in the database
function checkFileURL($urlPhoto){
    $bdd=getBDD();
    $checkUrl=$bdd->prepare('SELECT Url FROM Photo WHERE Url=:UrlNewPhoto') or die(print_r($bdd->errorInfo()));
    $checkUrl->bindValue(':UrlNewPhoto',$urlPhoto,PDO::PARAM_STR);
    $checkUrl->execute();
    return $checkUrl;
}

//get the file sent by the BDE member, looks for errors, the size, the extension, if a file had already the same name and finally put it in the right folder
function getFile($idToLookFor){
    if(isset($_FILES['eventPicture']) AND $_FILES['eventPicture']['error']==0)
    {
        if($_FILES['eventPicture']['size']<=10000000)
        {
            $infosPhoto = pathinfo($_FILES['eventPicture']['name']);
            $namePhoto=str_replace(' ','_',($_FILES['eventPicture']['name']));
            $namePhoto=str_replace('-','_',($_FILES['eventPicture']['name']));
            $extensionPhoto = $infosPhoto['extension'];
            $extensionsAllowed = array('jpg', 'jpeg', 'png','PNG','JPG','JPEG');
            if (in_array($extensionPhoto, $extensionsAllowed))
            {
                $newNumberPhoto = 0;
                $urlPhoto='../imagePNG/events/'.$newNumberPhoto.'-'.basename($namePhoto);
                $sent=0;

                while($sent==0)
                {
                    $checkUrl = checkFileURL($urlPhoto);
                    $getUrl=$checkUrl->fetch();
                    if($urlPhoto==$getUrl['Url'])
                    {
                        $nameOfPhotoFromBdd=explode('/',$getUrl['Url']);
                        $numberPhoto=explode('-', $nameOfPhotoFromBdd[(count($nameOfPhotoFromBdd)-1)]);
                        $newNumberPhoto=$numberPhoto[0]+1;
                        $urlPhoto='../imagePNG/events/'.$newNumberPhoto.'-'.basename($namePhoto);
                    }
                    else
                    {
                        $sent=1;
                    }
                    $checkUrl->closeCursor();

                }
                move_uploaded_file($_FILES['eventPicture']['tmp_name'],'../imagePNG/events/'.$newNumberPhoto.'-'.basename($namePhoto));

                $bdd=getBDD();
                $saveUrl=$bdd->prepare("INSERT INTO Photo (Url,IDEvent)VALUES (:url,:IDEvent) ");
                $saveUrl->bindValue(':url',$urlPhoto,PDO::PARAM_STR);
                $saveUrl->bindValue(':IDEvent',$idToLookFor,PDO::PARAM_INT);
                $saveUrl->execute();
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
