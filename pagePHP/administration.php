<!DOCTYPE html>
<html>
    <body>
        <form action="updateUser.php" method="post">
            <table>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Role</th>
                    <th>Modifier</th>
                </tr>

                <?php
                try
                {
                    $bdd = new PDO('mysql:host=178.62.4.64:3306;dbname=BDDWeb', 'Administrateur', 'maxime1');
                }
                catch (Exception $e)
                {
                    die('Erreur : ' . $e->getMessage());
                }

                $reponse = $bdd-> prepare("SELECT LastName, FirstName, Role FROM Users;");
                $reponse->execute();
                while($donnees = $reponse->fetch())
                {
                ?>
                <tr>
                    <td><input type="text" name="LastName" value="<?php echo $donnees['LastName'];?>"/><br/></td>
                    <td><input type="text" name="FirstName" value="<?php echo $donnees['FirstName'];?>"/><br/></td>
                    <td><input id="role" type="text" name="Role" value="<?php echo $donnees['Role'];?>"/></td>
                    <td>
                        <select onchange="changeRole(this.value)">
                        <?php $level = $bdd->query('SELECT Role FROM UserRole');
                    while($niveaux = $level->fetch()){
                        ?>
                        <option value="<?php echo $niveaux['Role'];?>">
                            <?php echo $niveaux['Role'];?>
                        </option>
                        <?php
                    }
                }
                $reponse->closeCursor();
                        ?>
                        </select>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit" />
        </form>
        <script>
            function changeRole(val) {
                var chosenRole = val;
                document.getElementById("role").value = chosenRole;

            }
        </script>

    </body>
</html>
