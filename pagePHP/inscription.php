<!--

<!DOCTYPE html>
<html id="top">

    <head>
        <title> CV </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/feuilleCSS/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Devonshire" rel="stylesheet">

    </head>

    <body>
        <header> </header>
        <nav class="table">
            <a href="#" id="exi"> <img src="/imagePNG/exia.png" alt="logo exia"> </a>
            <a href="#" class="bouton"> <li> Boutique </li> </a>
            <a href="#" class="bouton"> <li> Boite à idées </li> </a>
            <a href="#" class="bouton"> <li>  Évènement du mois </li> </a>
            <a href="#" class="bouton"> <li>  Évènement passé </li> </a>
            <a href="#" class="bouton" id="signIn"> <li> <img src="/imagePNG/signIn.png" alt="signIn "> </li> </a>
        </nav>
        <section>

        </section>


    </body>
</html>

-->

<!DOCTYPE html>
<html>

    <head>
    <title> Inscription </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/feuilleCSS/registerCSS.css">
      <link rel="stylesheet" href="/feuilleCSS/style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    </head>

<body>
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>

<div id="id01" class="modal">

  <form class="modal-content" action="/action_page.php">
    <div class="container">
      <h1>Sign Up</h1>
      <p>Please fill in this form to create an account.</p>
      <hr>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>

      <label for="psw-repeat"><b>Repeat Password</b></label>
      <input type="password" placeholder="Repeat Password" name="psw-repeat" required>

      <label>
        <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
      </label>

      <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
        <button type="submit" class="signupbtn">Sign Up</button>
      </div>
    </div>
  </form>
</div>

<!--
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
-->


    <aside id="side" >
            <a href="#top" id="top"> <img src="/imagePNG/top.png" alt="goTop"> </a>
        </aside>

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

