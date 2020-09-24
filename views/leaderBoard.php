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

  $html = '<div class="page_title">
          <h1>Leader<span>Board</span></h1>
        </div><div class="wrapper_leaderBoard">';
  foreach ($liste_equipe as $key => $value) {
    $uneliste_nomEtudiant = $value->GET_ListeNomEtudiant();
    $stringEtudiant = '';
    foreach ($uneliste_nomEtudiant as $key2 => $value2) {
      $stringEtudiant .= $value2.', ';
    }
    $stringEtudiantLenght = strlen($stringEtudiant);
    $stringEtudiant =  substr($stringEtudiant, 0, $stringEtudiantLenght - 2);
    if ($key % 2 == 1 && $key >= 3) {
      $html .= '<div class="container_equipe" style="background-color: #253644;">
          <div class="container_icon">
            <img src="assets\icons\leaderboard_icon.png">
          </div>
          <div class="container_information">
            <h2>'.$value->GET_Name().'</h2>
            <p>'.$stringEtudiant.'</p>
          </div>
          <div class="container_score">
            <h5>'.$value->GET_Point().' pts</h5>
          </div>
        </div>';
    }else {
      switch ($key) {
        case 2:
        $html .= '<div class="container_equipe" style="background-color: #B5242E;">
            <div class="container_icon">
            <img src="assets\icons\leaderboard_third.png">
            </div>
            <div class="container_information">
              <h2>'.$value->GET_Name().'</h2>
              <p>'.$stringEtudiant.'</p>
            </div>
            <div class="container_score">
              <h5>'.$value->GET_Point().' pts</h5>
            </div>
          </div>';
          break;
        case 1:
        $html .= '<div class="container_equipe" style="background-color: #D62E3A;">
            <div class="container_icon">
              <img src="assets\icons\leaderboard_second.png">
            </div>
            <div class="container_information">
              <h2>'.$value->GET_Name().'</h2>
              <p>'.$stringEtudiant.'</p>
            </div>
            <div class="container_score">
              <h5>'.$value->GET_Point().' pts</h5>
            </div>
          </div>';
          break;
        case 0:
        $html .= '<div class="container_equipe" style="background-color: #F03A47; border-top-right-radius: 8px; border-top-left-radius: 8px;">
            <div class="container_icon">
              <img src="assets\icons\leaderboard_first.png">
            </div>
            <div class="container_information">
              <h2>'.$value->GET_Name().'</h2>
              <p>'.$stringEtudiant.'</p>
            </div>
            <div class="container_score">
              <h5>'.$value->GET_Point().' pts</h5>
            </div>
          </div>';
          break;

        default:
        $html .= '<div class="container_equipe" style="background-color: #1E2E3B;">
            <div class="container_icon">
              <img src="assets\icons\leaderboard_icon.png">
            </div>
            <div class="container_information">
              <h2>'.$value->GET_Name().'</h2>
              <p>'.$stringEtudiant.'</p>
            </div>
            <div class="container_score">
              <h5>'.$value->GET_Point().' pts</h5>
            </div>
          </div>';
          break;
      }
    }
  }
  $html .= '<div>';

}else {
  if ($liste_load["errorMessage"] != "") {
    $html = '<h4 class="errorMessage">'.$liste_load["errorMessage"].'<h4>';
  }
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
