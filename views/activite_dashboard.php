<?php
session_start();

include '../modele/connectionBDD.php';
include '../modele/class_gerant.php';
include_once('../modele/class_user.php');
//on Recupere le tour.
$myConnexion = new AccesBd();
$ready = false;
$error = false;

$myUser = unserialize($_SESSION['user']);
$idActivite = $myUser->GET_IdActivite();


$resultTour = $myConnexion->REQTour_tour();
if ($resultTour["success"] == 1) {
  $tour = $resultTour["tour"];
  if ($tour > 0) {
    $resultIdEquipe = $myConnexion->REQActiviteDash_IdEquipeActivite($idActivite, $tour);
    if ($resultIdEquipe["success"] == 1) {
      //Condition pour le nomAccompagnant.
      if ($resultIdEquipe["message"] != "noActivite") {
        $idEquipe = $resultIdEquipe["idEquipe"];

        $resultScoreEquipe = $myConnexion->REQActiviteDash_ScoreEquipe($idEquipe);
        if ($resultScoreEquipe["success"] == 1) {
          $score = $resultScoreEquipe["score"];
          if ($myConnexion->REQActiviteDash_VerifActive($idEquipe, $idActivite) == 1) {
            $html = '<h4 class="successMessage">Vous avez terminé votre tour.</h4>';
          }else {
            if ($myConnexion->REQActiviteDash_GetNomEquipe($idEquipe)) {
              // code...
            }
            $ready = true;
            $_SESSION['idEquipe'] = serialize($idEquipe);
          }
        }
      }else {
        $html = '<h4 class="errorMessage">Aucune activité disponible!</h4>';
      }
    }else {
      $html = '<h4 class="errorMessage">Une erreur s\'est produite!</h4>';
    }
  }else {
    $html = '<h4 class="errorMessage">Les activités n\'ont pas encore débuté!</h4>';
  }
}
//recup info by id Activite;

//Button valider update set avec la valeur de l'input.

//Button terminer dans gerer update set activite finis a 1. et effectuer de participer a 1.

if ($ready == true) {
  $html = '<div class="page_title">
    <h1>Gestion<span>Activite</span></h1>
  </div>
  <div class="equipe_info_container">
    <h2>Nom Accompagnant:'.$nomAccompagnant.'</h2>
  </div>
  <div class="score_container">
    <h2 id="scoreTotal">'.$score.'</h2>
  </div>
  <div class="switcher_score_container">
    <div class="switcher_container">
      <div class="selector-left" id="selector_add">
        <img src="assets/icons/triangle_arrow_127px.png" onclick="IncrementScore(\'less\')">
      </div>
      <div class="switcher_score">
        <input type="number" name="score" id="score" value="0">
      </div>
      <div class="selector-right" id="selector_remove">
        <img src="assets/icons/triangle_arrow_127px.png" onclick="IncrementScore(\'more\')">
      </div>
    </div>
    <div class="switcher_validate">
      <input type="button" name="score_sender" value="VALIDER" onclick="ValiderScore()">
    </div>
  </div>
  <div class="final_validate">
    <input type="button" name="final_sender" value="TERMINER" onclick="Terminer()">
  </div>';
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
