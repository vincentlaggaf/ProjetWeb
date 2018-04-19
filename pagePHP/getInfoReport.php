<?php
function getHappeningInfos($idReturned){
    $bdd=getBdd();
    $getInfoEvent=$bdd->prepare('SELECT * FROM Happenings WHERE IDEvent =:IDEvent');
    $getInfoEvent->bindValue(':IDEvent',$idReturned,PDO::PARAM_INT);
    $getInfoEvent->execute();
    return $infoEvent=$getInfoEvent->fetch();


}


 function getPhotoInfos($idReturned){
//    $getInfoPhoto=$bdd->prepare('SELECT NameEvent FROM Happenings WHERE IDEvent =:IDEvent');
//    $getInfoPhoto->bindValue(':IDEvent',$idReturned,PDO::PARAM_INT);
//    $getInfoPhoto->execute();
//    return $infoPhoto=$getInfoPhoto->fetch();
}


?>
