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
        <p>Entrez vos informations d'inscription.</p>
        <form id="form">
          <input type="text" name="nom" id="name" class="input" placeholder="Nom" autocomplete="off">
          <input type="text" name="prenom" id="firstname" class="input" placeholder="Prénom" autocomplete="off">
          <input type="email" name="email" id="email" class="input" placeholder="Email">
          <input type="password" name="motDePasse" id="password" class="input" placeholder="Mot de Passe">
          <input type="submit" id="sender" class="sender" onclick="Inscription_First()" value="Valider">
        </form>

        <script type="text/javascript" src="assets/js/verifInscription_first.js"></script>
      </div>
      <div class="footer">
        <p>Vous avez déjà un compte? <a href="">Connectez-vous.</a></p>
      </div>
    </main>
  </body>
</html>
