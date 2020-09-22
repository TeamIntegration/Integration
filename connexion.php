<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="assets/css/inscription.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Integration | Connexion</title>
  </head>
  <body>
    <header>
      <h1><span>&lt/Int</span>Egration/&gt</h1>
    </header>

    <main>
      <div class="title_container">
        <h2>Connecte-toi</h2>
        <hr>
      </div>
      <div class="form_container">
        <p>Entrez vos informations de connexion.</p>
        <form id="form">
          <input type="email" name="email" id="email" class="input" placeholder="Email">
          <input type="password" name="motDePasse" id="password" class="input" placeholder="Mot de Passe">
          <input type="submit" id="sender" class="sender" value="Valider">
        </form>

        <script type="text/javascript" src="assets/js/verifConnexion.js"></script>
      </div>
      <div class="footer">
        <p>Vous n'avez pas encore de compte? <a href="inscription_first.php">Enregistrez-vous.</a></p>
      </div>
    </main>
  </body>
</html>
