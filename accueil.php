<?php
session_start();
session_destroy();
session_start();

 ?>


<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="assets/css/accueil.css">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Integration | Accueil</title>
</head>
  <body>
    <header>
      <h1><span>&lt/Int</span>Egration/&gt</h1>
    </header>

    <main>
      <div class="title_container">
        <h2>Bienvenue sur IntEgration!</h2>
        <hr>
      </div>
      <div class="form_container">
        <p>Inscrit toi pour participer à la journée d'intégration. Le jour venu tu auras accès aux différentes activités.</p>
        <button type="button" name="buttonInscription" onclick="document.location.href='inscription_first.php'">Inscription</button>
      </div>
      <div class="footer">
        <p>Vous avez déjà un compte? <a href="connexion.php">Connectez-vous.</a></p>
      </div>
    </main>
  </body>
</html>
