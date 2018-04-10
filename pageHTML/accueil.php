<!DOCTYPE html>
<html id="top">

    <head>
        <title> accueil </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/feuilleCSS/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">




    </head>

    <body>
        <!--        <header> </header> -->

        <img id="exia" src="/imagePNG/exia.png" alt="logo exia">

        <div id="menu">
            <nav class="table">

                <a href="#" class="bouton"> <li> Boutique </li> </a>
                <a href="#" class="bouton"> <li> Boite à idées </li> </a>
                <a href="#" class="bouton"> <li>  Évènement du mois </li> </a>
                <a href="#" class="bouton"> <li>  Évènement passé </li> </a>

                <button id ="cc" onclick="document.getElementById('id01').style.display='block'">
                    <img src="/imagePNG/signIn.png" alt="signIn ">
                </button>
            </nav>
        </div>
        <section id="corps">


            <div id="id01" class="modal">
                <form class="modal-content animate" action="/action_page.php">
                    <div class="container">
                        <label for="uname"><b>Username</b></label>
                        <input type="text" placeholder="Enter Username" name="uname" required>
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="Enter Password" name="psw" required>
                        <button type="submit" class="loginbtn">Login</button>
                        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel </button>
                        <span class="psw"> Créer un compte <a href="/pageHTML/inscription.php">ici</a></span>
                    </div>
                </form>
            </div>



            <!-- Slideshow container -->
            <div class="theCarousel">

                <!-- Full-width images with number and caption text -->
                <div class="mySlides fade">
                    <img src="/imagePNG/BOUTIQUE.png" style="width:100%">
                    <div class="text">Caption 1</div>
                </div>

                <div class="mySlides fade">
                    <img src="/imagePNG/even.png" style="width:100%">
                    <div class="text">Caption 2</div>
                </div>

                <div class="mySlides fade">
                    <img src="/imagePNG/boite.png" style="width:100%">
                    <div class="text">Caption 3</div>
                </div>

                <!-- Next and previous buttons -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>
            <br>

            <!-- The dots/circles -->
            <div style="text-align:center">
                <span class="dot" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
            </div>






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






        </section>
        <!--
<aside id="side" >
<a href="#top" id="top"> <img src="/imagePNG/top.png" alt="goTop"> </a>
</aside>
-->

        <footer id="bas">
            <div id="logoContact">
                <img src="/imagePNG/www.png" alt="logo réseaux sociaux">
                <img src="/imagePNG/mail.png" alt="logo réseaux sociaux">
                <img src="/imagePNG/facebook.png" alt="logo réseaux sociaux">
                <img src="/imagePNG/github.png" alt="logo réseaux sociaux">
                <img src="/imagePNG/twitter.png" alt="logo réseaux sociaux">
            </div>
            <p> © BDE Pau - 2018</p>
            <p> Created and maintained by
                <a href=mailto:bde.pau@viacesi.fr> bde.pau@viacesi.fr </a>
            </p>
        </footer>

    </body>
</html>
