<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../assets/css/app.css">
    <link rel="stylesheet" href="../assets/css/activite_dashboard.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title></title>
  </head>
  <body>
    <div class="page_title">
      <h1>Gestion<span>Activite</span></h1>
    </div>

    <div class="score_container">
      <h2>1345 pts</h2>
    </div>
    <div class="switcher_score_container">
      <div class="switcher_container">
        <div class="selector-left" id="selector_add">
          <img src="../assets/icons/triangle_arrow_127px.png" onclick="IncrementScore('less')">
        </div>
        <div class="switcher_score">
          <h3 id="score">123</h3>
        </div>
        <div class="selector-right" id="selector_remove">
          <img src="../assets/icons/triangle_arrow_127px.png" onclick="IncrementScore('more')">
        </div>
      </div>
      <div class="switcher_validate">
        <input type="button" name="score_sender" value="VALIDER">
      </div>
    </div>
    <div class="final_validate">
      <input type="button" name="final_sender" value="TERMINER">
    </div>
    <script type="text/javascript" src="../assets/js/activiteDashboard.js"></script>
    <div class="container_menu">
      <div class="wrapper_menu">
          <img src="../assets\icons\joystickGrey_127px.png" id="activite" class="menu-link" style="display: none;" onclick="displayActivite()">
          <img src="../assets\icons\jerseyGrey_127px.png" id="accompagnant" class="menu-link" onclick="displayEquipe()">
          <img src="../assets\icons\trophyGrey_127px.png" id="leaderBoard" class="menu-link" onclick="displayLeaderBoard()">
          <!--<script type="text/javascript" src="displayer.js"></script>
          <script type="text/javascript">displayEquipe();</script>-->

      </div>
    </div>

  </body>
</html>
