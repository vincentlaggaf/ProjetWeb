<?php

session_start();

if(isset($_POST['eventID']))
{
    try
    {
        $bdd = new PDO('mysql:host=178.62.4.64;dbname=BDDWeb;charset=utf8', 'Administrateur', 'maxime1', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        $getIDParticipant=$bdd->prepare('SELECT IDUser FROM Interest WHERE IDEvent= :IDEvent;');
        $getIDParticipant->bindValue(':IDEvent',$_POST['eventID'],PDO::PARAM_INT);
        $getIDParticipant->execute();

        while ($IDParticipant=$getIDParticipant->fetch()){

            $getNameParticipant=$bdd->prepare('SELECT LastName, FirstName FROM Users WHERE IDUser= :IDUser;');
            $getNameParticipant->bindValue(':IDUser',$IDParticipant['IDUser'],PDO::PARAM_INT);
            $getNameParticipant->execute();
            $listParticipants=$getNameParticipant->fetchAll(PDO::FETCH_ASSOC);

            // Set the Content-Type and Content-Description headers to force the download,
            // the list of the participants will be an atttachment called test.csv.
            header('Content-Description: File Transfer');
            header('Content-Type: application/csv');
            header("Content-Disposition: attachment; filename='test.csv'");

            // open up the file pointer
            $fp = fopen('php://output', 'w');

            //Then, loop through the rows and write them to the CSV file.
            foreach ($listParticipants as $listParticipants) {
                fputcsv($fp, $listParticipants);
            }
            //Close the file pointer.
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
