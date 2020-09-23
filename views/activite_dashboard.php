<?php
session_start();

include '../modele/connectionBDD.php';
//on Recupere le tour.
$myConnexion = new AccesBd();
$ready = false;
$error = false;

$myUser = unserialize($_SESSION['user']);
$idActivite = $myUser->GET_IdActivite();

$resultTour = ["success" => 1, "tour" => 1];
//$resultTour = $myConnexion->REQTour_tour();
if ($resultTour["success"] == 1) {
  $tour = $resultTour["tour"];

  $resultIdEquipe = $myConnexion->REQActiviteDash_IdEquipeActivite($idActivite, $tour);
  if ($resultIdEquipe["success"] == 1) {
    if (isset($resultIdEquipe["message"]) == false) {
      $idEquipe = $resultIdEquipe["idEquipe"];

      $resultScoreEquipe = $myConnexion->REQActiviteDash_ScoreEquipe($idEquipe);
      if ($resultScoreEquipe["success"] == 1) {
        $score = $resultScoreEquipe["score"];
        $ready = true;
      }
    }else {
      $error = true;
      //PAS DACTIVITE RESTANTE
    }
  }
}
//recup info by id Activite;

//Button valider update set avec la valeur de l'input.

//Button terminer dans gerer update set activite finis a 1. et effectuer de participer a 1.

if ($ready == true) {
  $html = '<div class="page_title">
    <h1>Gestion<span>Activite</span></h1>
  </div>

  <div class="score_container">
    <h2 id="scoreTotal">'.$score.'</h2>
  </div>
  <div class="switcher_score_container">
    <div class="switcher_container">
      <div class="selector-left" id="selector_add">
        <img src="../assets/icons/triangle_arrow_127px.png" onclick="IncrementScore('less')">
      </div>
      <div class="switcher_score">
        <input type="number" name="score" id="score" value="0">
      </div>
      <div class="selector-right" id="selector_remove">
        <img src="../assets/icons/triangle_arrow_127px.png" onclick="IncrementScore('more')">
      </div>
    </div>
    <div class="switcher_validate">
      <input type="button" name="score_sender" value="VALIDER" onclick="ValiderScore()">
    </div>
  </div>
  <div class="final_validate">
    <input type="button" name="final_sender" value="TERMINER">
  </div>
  <script type="text/javascript" src="../assets/js/activiteDashboard.js"></script>';
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
