<?php
function getHappeningInfos($idReturned){
    $bdd=getBdd();
    $getInfoEvent=$bdd->prepare('SELECT * FROM Happenings WHERE IDEvent =:IDEvent');
    $getInfoEvent->bindValue(':IDEvent',$idReturned,PDO::PARAM_INT);
    $getInfoEvent->execute();
    return $infoEvent=$getInfoEvent->fetch();


}


function getPhotoInfos($idReturned){
    $bdd=getBdd();
    $getInfoPhoto=$bdd->prepare('SELECT * FROM Photo WHERE IDPhoto =:IDPhoto');
    $getInfoPhoto->bindValue(':IDPhoto',$idReturned,PDO::PARAM_INT);
    $getInfoPhoto->execute();
    return $infoPhoto=$getInfoPhoto->fetch();
}



function getCommentInfos($idReturned){
    $bdd=getBdd();
    getInfoComment=$bdd->prepare('SELECT * FROM Comments WHERE IDComment =:IDComment');
    getInfoComment->bindValue(':IDComment',$idReturned,PDO::PARAM_INT);
    getInfoComment->execute();
    return $infoComment=getInfoComment->fetch();
}



?>