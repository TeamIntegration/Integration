<?php
session_start();

//$liste_activite = unserialize($_SESSION["liste_activite"]);

include '../modele/class_activite.php';
include '../modele/connectionBDD.php';
include '../modele/class_premiereAnnee.php';
include '../modele/class_accompagnant.php';
include '../modele/class_gerant.php';
include_once('../modele/class_user.php');

$html = "";
$myConnexion = new AccesBD();
$resultActivite = $myConnexion->REQAdmin_GetLesActivites();

if ($resultActivite["success"] == 1) {
  foreach ($resultActivite["liste_activite"] as $index => $value) {
    $uneListe = $resultActivite["liste_activite"];
    $liste_activite[$index] = new Activite($uneListe[$index]["idActivite"], $uneListe[$index]["libelleActivite"], $uneListe[$index]["lieuActivite"], $uneListe[$index]["tour"], $uneListe[$index]["effectuer"]);
  }
  $success = 1;
}else {
  $success = O;
  $html = '<h4 class="errorMessage">Aucune activités!<h4>';
}

if ($liste_activite != null) {
  if (count($liste_activite) > 0) {
    $html = '<div class="wrapper_activite">';
    foreach ($liste_activite as $activite => $value) {
      if ($value->GET_Effectuer() == 1) {
        $html .= '<div class="container_activite" style="background-color: #F03A47">
        <h2>'.$value->GET_Libelle().'</h2>
        <h6>lieu: '.$value->GET_Lieu().'</h6>
        </div>';
      }else {
        $html .= '<div class="container_activite">
        <h2>'.$value->GET_Libelle().'</h2>
        <h6>lieu: '.$value->GET_Lieu().'</h6>
        </div>';
      }
    }
    $html .= '</div>';
  }
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
