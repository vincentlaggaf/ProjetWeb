<?php
require 'BDDConnection.php';




function getName($IDuser){
    $bdd=getBdd();


}

if(isset($_POST['IDphotoClicked'])){
    $bdd=getBdd();
    $getComments=$bdd->prepare('SELECT * FROM Comments WHERE IDPhoto =:IDPhoto');
    $getComments->bindValue(':IDPhoto',$_POST['IDphotoClicked'],PDO::PARAM_INT);
    $getComments->execute();
    while($comments=$getComments->fetch())
    {?>

<fieldset class="comment">
    <legend class="commentAuthor">
        <strong>
            <?php
        $getUserName=$bdd->prepare('SELECT LastName ,FirstName FROM Users WHERE IDUser=:IDUser');
        $getUserName->bindValue(':IDUser',$comments['IDUser'],PDO::PARAM_INT);
        $getUserName->execute();
        $userName=$getUserName->fetch();
        echo $userName['LastName'].' '.$userName['FirstName'];

//        ;
            ?>
        </strong>
    </legend>
    <?php echo $comments['CommentContent'];?>
    <form action="report.php" method="post">
        <input type="hidden" name="category" value="comment"/>
        <input type="hidden" name="IDUser" value="<?php echo $comments['IDUser'];?>"/>
        <input type="hidden" name="contentId" value="<?php echo $comments['contentId'];?>"/>
        <button type="submit" value="submit"> signaler </button>

    </form>
</fieldset>



<?php
    }
}
?>
