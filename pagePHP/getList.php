<?php

session_start();

if(isset($_POST['eventID']))
{
    try
    {
        $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // echo $_POST['eventID'];
        $getIDParticipant=$bdd->prepare('SELECT IDUser FROM Interest WHERE IDEvent= :IDEvent;');
        $getIDParticipant->bindValue(':IDEvent',$_POST['eventID'],PDO::PARAM_INT);
        $getIDParticipant->execute();

        while ($IDParticipant=$getIDParticipant->fetch()){

            $getNameParticipant=$bdd->prepare('SELECT LastName, FirstName FROM Users WHERE IDUser= :IDUser;');
            $getNameParticipant->bindValue(':IDUser',$IDParticipant['IDUser'],PDO::PARAM_INT);
            $getNameParticipant->execute();
            $listParticipants=$getNameParticipant->fetchAll(PDO::FETCH_ASSOC);
            //            $columnNames = array();
            //            if(!empty($listParticipants))
            //            {
            //                $firstRow = $listParticipants[0];
            //                foreach($firstRow as $colName => $val)
            //                {
            //                    $columnNames[] = $colName;
            //                }
            //            }
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header("Content-Disposition: attachment; filename='test.csv'");
            $fp = fopen('php://output', 'w');
            //            fputcsv($fp, $columnNames);
            foreach ($listParticipants as $listParticipants) {
                fputcsv($fp, $listParticipants);
            }
            fclose($fp);
            $getNameParticipant->closeCursor();

        }
        $getIDParticipant->closeCursor();
    }
    catch (Exception $e)
    {
        die ('Erreur : ' . $e->getMessage());
    }

}
