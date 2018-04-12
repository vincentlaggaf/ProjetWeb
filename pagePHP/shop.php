<?php
    require 'shop\BDDInteraction.php';
?>
<!DOCTYPE html>
<html id="top">

    <head>
        <title> Boite à Idées </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-shop.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">
    </head>

    <body>
        <img id="exia" src="\ProjetWeb\imagePNG\exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">
                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="\ProjetWeb\imagePNG\Menu_icon.png" alt="signIn ">
                </button>
            </nav>
        </div>

        <section>
            <?php
                $answer = getGoodiesQuery();
                while ($data = $answer->fetch())
                {
            ?>
                    <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>" class="shop-picture"/>

                    <div class="goodies_information invisible">
                        <div class="goodies_information_part">

                            <img src="<?php echo $data['URL']; ?>" alt="<?php echo $data['NameGoodies']; ?>" title="<?php echo $data['NameGoodies']; ?>" class="goodies-picture"/>

                            <div class="info_goodies info_goodies_margin">Nom :<br/><?php echo $data['NameGoodies']; ?></div>

                            <div class="info_goodies info_goodies_margin">Catégorie :<br/><?php echo $data['NameGoodiesCategory']; ?></div>

                            <div class="info_goodies info_goodies_margin">Prix :<br/><?php echo $data['Price']; ?>€</div>

                        </div>
                        <div class="goodies_information_part">

                            <div class="info_goodies info_goodie_description info_goodies_margin">Description :<br/><?php echo $data['Description']; ?></div>

                        </div>
                        <div class="goodies_information_part goodies_information_part_position">

                            <div class="info_goodies">acheter</div>
                            <div class="info_goodies">supprimer</div>

                        </div>
                    </div>

            <?php
                }
            ?>
        </section>

        <footer id="bas">
             <div id="logoContact">
                <img src="\ProjetWeb\imagePNG\www.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\mail.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\facebook.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\github.png" alt="logo réseaux sociaux">
                <img src="\ProjetWeb\imagePNG\twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
            <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>
        </footer>

        <script src="\projetWeb\scriptsJS\script-shop.js"></script>
    </body>
</html>
