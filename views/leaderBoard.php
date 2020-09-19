<?php

include '../modele/connectionBDD.php';
include '../modele/class_equipe.php';

$connexion = new AccesBD();
$html = "";

$liste_load = $connexion->REQLeaderBoard_LoadEquipe();
if ($liste_load["success"] == 1) {
  $liste_nomEquipe = $liste_load["liste_nomEquipe"];
  $liste_nomEtudiant = $liste_load["liste_nomEtudiant"];
  $liste_score = $liste_load["liste_score"];
  foreach ($liste_nomEquipe as $key => $value) {
    $liste_equipe[$key] = new Equipe($liste_nomEquipe[$key], $liste_nomEtudiant[$key], $liste_score[$key]);
  }

  foreach ($liste_equipe as $key => $value) {
    $uneliste_nomEtudiant = $value->GET_ListeNomEtudiant();
    $stringEtudiant = '';
    foreach ($uneliste_nomEtudiant as $key => $value2) {
      $stringEtudiant .= $value2.', ';
    }
    $html .= '<div class="container_equipe">
        <div class="container_icon">

        </div>
        <div class="container_information">
          <h2>'.$value->GET_Name().'</h2>
          <p>'.$stringEtudiant.'</p>
        </div>
      </div>';
  }

}else {
  $html = "<h1>Erreur!<h1>";
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
