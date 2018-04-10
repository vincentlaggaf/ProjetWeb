<!DOCTYPE html>
<html id="top">

    <head>
        <title> accueil </title>
        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link rel="stylesheet" href="/projetWeb/feuilleCSS/style.css">
    </head>

    <body>
        <!--        <header> </header> -->
        <img id="exia" src="/projetWeb/imagePNG/exia.png" alt="logo exia">





        <nav class="table">
            <a href="#" class="bouton"> <li> Boutique </li> </a>
            <a href="#" class="bouton"> <li> Boite à idées </li> </a>
            <a href="#" class="bouton"> <li> Évènement du mois </li> </a>
            <a href="#" class="bouton"> <li> Évènements passés </li> </a>

            <button id ="authentificationBtn" onclick="document.getElementById('id02').style.display='block'">
                <img src="/projetWeb/imagePNG/logIn.png" alt="logIn ">
            </button>

            <button id ="authentificationBtn" onclick="document.getElementById('id01').style.display='block'">
                <img src="/projetWeb/imagePNG/signIn.png" alt="signIn ">
            </button>
        </nav>





        <section id="corps">

            <div id="id01" class="modal">
                <form class="modal-content animate">
                    <div class="container">

                        <label for="name"><b>Nom</b></label>
                        <input type="text">
                        <label for="firstname"><b>Prénom</b></label>
                        <input type="text">
                        <label for="uname"><b>Nom d'utilisateur</b></label>
                        <input type="text">
                        <label for="psw"><b>Mot de passe</b></label>
                        <input type="text">

                        <button type="submit" class="loginbtn"> S'inscrire </button>
                        <button type="button" class="cancelbtn" onclick="document.getElementById('id01').style.display='none'"> Annuler </button>

                        <!--                        <span class="psw"> Déjà un compte ? <a href="#id02"> Go </a></span>-->

                    </div>
                </form>
            </div>

            <div id="id02" class="modal">
                <form class="modal-content animate" action="/action_page.php">
                    <div class="container">

                        <label for="uname"><b>Nom d'utilisateur</b></label>
                        <input type="text">
                        <label for="psw"><b>Mot de passe</b></label>
                        <input type="text">


                        <button type="submit" class="loginbtn"> Se connecter</button>


                        <button type="button" class="cancelbtn" onclick="document.getElementById('id02').style.display='none'"> Annuler </button>


                        <!--
<span class="psw"> Créer un compte
<a href="#id02">ici</a>
</span>
-->
                    </div>
                </form>
            </div>




            <div class="theCarousel">
                <div class="mySlides fade">
                    <img src="/projetWeb/imagePNG/BOUTIQUE.png" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="/projetWeb/imagePNG/even.png" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="/projetWeb/imagePNG/boite.png" style="width:100%">
                </div>
            </div>

            <div id="pass">
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

        </section>

        <footer id="bas">
            <div id="logoContact">

                <a href=mailto:bde.pau@viacesi.fr>
                    <img src="/projetWeb/imagePNG/mail.png" alt="logo réseaux sociaux">
                </a>

                <a href="https://exia.cesi.fr/ecole-informatique-pau">
                    <img src="/projetWeb/imagePNG/www.png" alt="logo réseaux sociaux">
                </a>




                <img src="/projetWeb/imagePNG/facebook.png" alt="logo réseaux sociaux">
                <img src="/projetWeb/imagePNG/github.png" alt="logo réseaux sociaux">
                <img src="/projetWeb/imagePNG/twitter.png" alt="logo réseaux sociaux">




            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
                <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>
            </p>
        </footer>



        <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            // Next/previous controls
            function plusSlides(n) {
                showSlides(slideIndex += n);
            }

            // Thumbnail image controls
            function currentSlide(n) {
                showSlides(slideIndex = n);
            }

            function showSlides(n) {
                var i;
                var slides = document.getElementsByClassName("mySlides");
                var dots = document.getElementsByClassName("dot");
                if (n > slides.length) {slideIndex = 1}
                if (n < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex-1].style.display = "block";
                dots[slideIndex-1].className += " active";
            }
        </script>
    </body>
</html>
