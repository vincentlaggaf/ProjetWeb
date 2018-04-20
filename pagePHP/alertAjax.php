<?php
require 'BDDConnection.php';
session_start();
function getName($IDuser){
    $bdd=getBdd();
}

//If the ID of the photo clicked on is set we select all the info about this photo
if(isset($_POST['IDphotoClicked'])){
    $bdd=getBdd();
    $getComments=$bdd->prepare('SELECT * FROM Comments WHERE IDPhoto =:IDPhoto');
    $getComments->bindValue(':IDPhoto',$_POST['IDphotoClicked'],PDO::PARAM_INT);
    $getComments->execute();
    while($comments=$getComments->fetch())
    {?>

<!--And we fill the comment section with the content comments about the photo-->
<fieldset class="comment">
    <legend class="commentAuthor">
        <strong>
            <?php
        $getUserName=$bdd->prepare('SELECT LastName ,FirstName FROM Users WHERE IDUser=:IDUser');
        $getUserName->bindValue(':IDUser',$comments['IDUser'],PDO::PARAM_INT);
        $getUserName->execute();
        $userName=$getUserName->fetch();
        echo $userName['LastName'].' '.$userName['FirstName'];
        // ;
            ?>
        </strong>
    </legend>
    <?php echo $comments['CommentContent'];
    // We  create a report comment button that will send the datas
    //(Id user, is comment, etc) to report.php
    if((isset($_SESSION['Role']))AND (($_SESSION['Role'] == 'CESIMember'))){
        ?>

    <form action="report.php" method="post">
        <input type="hidden" name="category" value="comment"/>
        <input type="hidden" name="IDUser" value="<?php echo $comments['IDUser'];?>"/>
        <input type="hidden" name="contentId" value="<?php echo $comments['IDComment'];?>"/>
        <button type="submit" value="submit"> signaler </button>
    </form>
</fieldset>



<?php
    }
    }
}
?>
