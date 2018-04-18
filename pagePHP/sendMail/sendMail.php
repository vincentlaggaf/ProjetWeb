<?php
function fillOrderMail($basket, $destinationEmail, $firstName, $lastName, $totalPrice){
    $text = "Une commande a été effectué par ".$firstName." ".$lastName.".\n\nCette personne à commandé :\n";

    while($data = $basket->fetch()){
        $text = $text.$data['Quantity']." ".$data['NameGoodies']." au prix de ".$data['Price']."€.\n";
    }

    $text = $text."\nPour un prix total de ".$totalPrice."€\n\nCette personne a pour adresse mail : ".$destinationEmail;
    sendMail("bde.exia.pau@gmail.com", $text);
}

function sendMail($destination, $text){
    ini_set( 'display_errors', 1 );

    error_reporting( E_ALL );

    $from = "bde.exia.pau@gmail.com";

    $to = $destination;

    $subject = "Vérification PHP mail";

    $message = $text;

    $headers = "From:" . $from;

    mail($to, $subject, $message, $headers);
}
?>
