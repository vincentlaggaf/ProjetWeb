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

        <?php include ('nav.php'); ?>

        <section id="corps">



                <?php include ('modalInscription.php'); ?>
                <?php include ('modalLogin.php'); ?>


                <div class="theCarousel">
                    <div class="mySlides fade">
                        <img src="/projetWeb/imagePNG/boutique.png" style="width:100%">
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

            <?php include ('footer.php'); ?>


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
