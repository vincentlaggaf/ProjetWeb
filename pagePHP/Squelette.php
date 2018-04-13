<!DOCTYPE html>
<html id="top">

    <head>
        <title> Boite à Idées </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style-Squelette.css">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">




    </head>

    <body>
        <!--        <header> </header> -->

        <img id="exia" src="\projetWeb\imagePNG\exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">


                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="\projetWeb\imagePNG\Menu_icon.png" alt="signIn ">
                </button>
            </nav>
        </div>



        <section id="corps">

            <form id="conteneur">
                <fieldset class="Boite">
                    <legend>Proposez votre idée</legend>

                    <div class="Element 2">
                        <input   type="text" name="Titre" id="Titre" maxlength="20"  placeholder="Titre"/>
                    </div>

                    <div class="Element 3">
                        <textarea style="resize:none" rows="5" cols="50" placeholder="Description"></textarea>
                    </div>


                    <button>Publier</button>

            </fieldset>
            </form>

            <div><p class="bar">Dernières Idées</p>
            </div>

            <script>

            </script>

        </section>


        <footer id="bas">
             <div id="logoContact">
                <img src="\projetWeb\imagePNG\www.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\mail.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\facebook.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\github.png" alt="logo réseaux sociaux">
                <img src="\projetWeb\imagePNG\twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
                <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>

        </footer>

    </body>
</html>
