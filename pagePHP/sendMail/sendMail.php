<?php
//fill a string with the informations of the customer and the informations about the order
function fillOrderMail($basket, $destinationEmail, $firstName, $lastName, $totalPrice){
    $text = "Une commande a été effectué par ".$firstName." ".$lastName.".\n\nCette personne à commandé :\n";

    while($data = $basket->fetch()){
        $text = $text.$data['Quantity']." ".$data['NameGoodies']." au prix de ".$data['Price']."€.\n";
    }

    $text = $text."\nPour un prix total de ".$totalPrice."€\n\nCette personne a pour adresse mail : ".$destinationEmail;
    sendMail("bde.exia.pau@gmail.com", $text, "Commande");
}


//fill a string with information about the content that has been reported by the cesi member
function writeReport($contentId, $contentName, $contentCategory, $lastName, $firstName){
    $text = "Le contenu suivant a été signalé par ".$firstName .$lastName ." : \n\n Id correspondant :".$contentId ."\n\n Nom du contenu : ".$contentName."\n\n Il s'agit de : ".$contentCategory;

    sendMail("bde.exia.pau@gmail.com",$text, "Contenu signalé");

}
//send a mail to the BDE member with all the informations filled above
function sendMail($destination, $text, $title){
    ini_set( 'display_errors', 1 );

    error_reporting( E_ALL );

    $from = "bde.exia.pau@gmail.com";

    $to = $destination;

    $subject = $title;

    $message = $text;

    $headers = "From:" . $from;

    mail($to, $subject, $message, $headers);
}


?>
