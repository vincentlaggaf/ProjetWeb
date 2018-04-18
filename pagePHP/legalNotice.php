<?php
session_start();
?>
<!DOCTYPE html>
<html>

    <head>
        <title> Boutique </title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="\ProjetWeb\feuilleCSS\style-legalNotice.css">
    </head>

    <body>
        <?php include 'nav.php';?>
        <div id="legalNoticeDiv">
            <section>
                <h1 class="mention_titre">Mentions légales</h1>
                <h5 class="mention_titre">En vigueur au 18/04/2018</h5>
                <article class="mention_txt">
                    Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la Confiance dans l'économie numérique, dite L.C.E.N., il est porté à la connaissance des Utilisateurs du site BDE Exia Pau les présentes mentions légales.
                    <br>
                    <br>
                    La connexion et la navigation sur le site BDE Exia Pau par l'Utilisateur implique acceptation intégrale et sans réserve des présentes mentions légales.
                    <br>
                    Ces dernières sont accessibles sur le site à la rubrique « Mentions légales ».
                </article>
                <h3 class="mention_titre">ARTICLE 1 : L'EDITEUR</h3>
                <article class="mention_txt">
                    L'édition du site BDE Exia Pau est assurée par Alexandre Sadoun, Emma Laroudie, Maxime Lavergne et Xavier Gistau, dont l'adresse e-mail est grp.projet.2@viacesi.fr
                </article>
                <h3 class="mention_titre">ARTICLE 2 : L'HEBERGEUR</h3>
                <article class="mention_txt">
                    L'hébergeur du site BDE Exia Pau est WAMP, dont le siège social est situé à Localhost, avec le numéro de téléphone : 8888
                </article>
                <h3 class="mention_titre">ARTICLE 3 : ACCES AU SITE</h3>
                <article class="mention_txt">
                    Le site est accessible seulement pour les utilisateurs, 7j/7, 24h/24 sauf cas de force majeure, interruption programmée ou non pouvant mener à une maintenance.
                </article>
            </section>
        </div>

        <?php include 'footer.php';  ?>
    </body>
</html>
