<?php
try
{
    $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
    die ('Erreur : ' . $e->getMessage());
}


if(isset($_POST['IDphotoClicked'])){

    $getComments=$bdd->prepare('SELECT CommentContent FROM Comments WHERE IDPhoto =:IDPhoto');
    $getComments->bindValue(':IDPhoto',$_POST['IDphotoClicked'],PDO::PARAM_INT);
    $getComments->execute();
      while($comments=$getComments->fetch())
        {?>
                        <fieldset class="comment">
                            <?php echo $comments['CommentContent'];?>
                        </fieldset>
                        <?php
        }
}

?>
