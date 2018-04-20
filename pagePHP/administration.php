<!DOCTYPE html>
<html>
    <body>

        <!--  We create a table to make the list of all the users -->
        <table>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Role</th>
                <th>Modifier</th>
            </tr>
            <?php
           require 'BDDConnection.php';

            $bdd = getBDD();
            $reponse = $bdd-> prepare("SELECT LastName, FirstName, Role FROM Users;");
            $reponse->execute();
            while($donnees = $reponse->fetch()) {
            ?>
            <tr>
                <!--    for each line of answer we insert it in a row of the table - in the td  -->
                <form action="updateUser.php" method="post">
                    <td><input type="text" name="LastName" value="<?php echo $donnees['LastName'];?>"/><br/></td>
                    <td><input type="text" name="FirstName" value="<?php echo $donnees['FirstName'];?>"/><br/></td>
                    <td><input id="role" type="text" name="Role" value="<?php echo $donnees['Role'];?>"/></td>
                    <td><select name="ChooseRole" onchange="changeRole(this.value)">

                        <!-- We create a dropdown menu to select the role we want to give to the user -->
                        <?php $level = $bdd->query('SELECT Role FROM UserRole');
                while($niveaux = $level->fetch()){
                        ?>
                        <option  value="<?php echo $niveaux['Role'];?>">
                            <?php echo $niveaux['Role'];?>
                        </option>
                        <?php }
                        ?> </select>
                    </td>
                    <!--    the submit button will send the datas of the same row -->
                    <td><input type="submit" value="Submit"/></td>
                </form>
            </tr>
            <?php }
            $reponse->closeCursor();
            ?>
        </table>
        <button onclick="history.back()">Go Back</button>
    </body>
</html>
