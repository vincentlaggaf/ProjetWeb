<?php
    session_start();
    require 'shop\BDDInteraction.php';
?>
<!DOCTYPE html>
<html>

    <head>
        <title> Boutique </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
    </head>

    <body>
        <?php include 'nav.php'; ?>
        <div id="shopDiv">
            <section>
            </section>
        </div>

        <?php include 'footer.php';  ?>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
