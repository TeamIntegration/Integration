<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Activite</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/activite.css">
    <link rel="stylesheet" href="assets/css/leaderBoard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  </head>
  <body>
    <main>
    </main>

    <div class="container_menu">
      <div class="wrapper_menu">
        <!-- plus ou moins de menu-link avec un id en fonction du grade.-->
        <?php
        include 'modele/class_premiereAnnee.php';
        include 'modele/class_accompagnant.php';

        $myUser = new PremiereAnnee(1, "lecat", "baptiste", "qsqsd", 5);
        $nomClass = get_class($myUser);

        switch ($nomClass) {
          case 'PremiereAnnee':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" onclick="displayActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" style="display: none;" onclick="displayEquipe()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayActivite();</script>';
          echo $html;
            break;

          case 'Accompagnant':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" style="display: none;" onclick="displayActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" onclick="displayEquipe()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayEquipe();</script>';
          echo $html;
            break;
        }
         ?>

      </div>
    </div>
  </body>
</html>
