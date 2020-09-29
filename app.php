<?php
session_start();

if (isset($_SESSION["user"]) == false ) {
  header('Location: connexion.php');
}

 ?>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Activite</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/activite.css">
    <link rel="stylesheet" href="assets/css/leaderBoard.css">
    <link rel="stylesheet" href="assets/css/activite_dashboard.css">

    <link rel="stylesheet" href="assets/css/admin_settings.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <script type="text/javascript" src="assets/js/activiteDashboard.js"></script>
    <script type="text/javascript" src="assets/js/admin_settings.js"></script>
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
        include 'modele/class_gerant.php';
        include 'modele/class_admin.php';

        $myUser = unserialize($_SESSION['user']);
        $nomClass = get_class($myUser);

        switch ($nomClass) {
          case 'PremiereAnnee':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" onclick="displayActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" style="display: none;" onclick="displayEquipe()">
          <img src="assets\icons\whistleGrey_127px.png" id="gerant" class="menu-link" style="display: none;" onclick="displayActiviteDashboard()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayActivite();</script>';
          echo $html;
            break;

          case 'Accompagnant':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" style="display: none;" onclick="displayActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" onclick="displayEquipe()">
          <img src="assets\icons\whistleGrey_127px.png" id="gerant" class="menu-link" style="display: none;" onclick="displayActiviteDashboard()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayEquipe();</script>';
          echo $html;
            break;

          case 'Gerant':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" style="display: none;" onclick="displayActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" style="display: none;" onclick="displayEquipe()">
          <img src="assets\icons\whistleRed_127px.png" id="gerant" class="menu-link" onclick="displayActiviteDashboard()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayActiviteDashboard();</script>';
          echo $html;
            break;

          case 'Admin':
          $html = '<img src="assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" style="display: none;" onclick="displayActivite()">
          <img src="assets\icons\wrenchRed_127px.png" id="admin_Settings" class="menu-link" onclick="displayAdminSettings()">
          <img src="assets\icons\joystickGrey_127px.png" id="admin_Activite" class="menu-link" onclick="displayAdminActivite()">
          <img src="assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" style="display: none;" onclick="displayEquipe()">
          <img src="assets\icons\whistleRed_127px.png" id="gerant" class="menu-link" style="display: none;" onclick="displayActiviteDashboard()">
          <img src="assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayAdminSettings();</script>';
          echo $html;
            break;
        }
         ?>

      </div>
    </div>
  </body>
</html>
