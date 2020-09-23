<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/inscription.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Integration | Inscription</title>
  </head>
  <body>
    <header>
      <h1><span>&lt/Int</span>Egration/&gt</h1>
    </header>

    <main>
      <div class="title_container">
        <h2>Créer ton Compte</h2>
        <hr>
      </div>
      <div class="form_container">
        <p>Sélectionner votre Promo.</p>

        <div class="wrapper_icon">
          <div class="container_icon" id="1SIO" onclick="Select_1SIO(this)">
            <img src="assets/icons/baby-bottle.png" alt="">
            <p>1SIO</p>
          </div>
          <div class="container_icon" id="2SIO" onclick="Select_2SIO(this)">
            <img src="assets/icons/student.png" alt="">
            <p>2SIO</p>
          </div>
        </div>
        <input type="text" name="code" id="code" class="inputCode" maxlength="6" placeholder="Code Verification">
        <button type="submit" onclick="SendInscription()" class="sender">Valider</button>
        <script type="text/javascript" src="assets/js/verifInscription_second.js"></script>
      </div>
      <div class="footer">
        <p>Vous avez déjà un compte? <a href="connexion.php">Connectez-vous.</a></p>
      </div>
    </main>
  </body>
</html>
