<?php

//$liste_activite = unserialize($_SESSION["liste_activite"]);

include '../modele/class_activite.php';

$activite1 = new Activite(12, "Rapid'Script", "004", false);
$activite2 = new Activite(14, "Baby-foot", "exterieur", true);
$activite3 = new Activite(16, "Montage PC", "001", true);

$liste_activite[0] = $activite1;
$liste_activite[1] = $activite2;
$liste_activite[2] = $activite3;
$liste_activite[3] = $activite1;
$liste_activite[4] = $activite2;
$liste_activite[5] = $activite3;

$html = '<h1>Aucune activités!<h1>';

if ($liste_activite != null) {
  if (count($liste_activite) > 0) {
    $html = '<div class="wrapper_activite">';
    foreach ($liste_activite as $activite => $value) {
      if ($value->GET_Participer() == true) {
        $html .= '<div class="container_activite" style="background-color: #F03A47">
        <h2>'.$value->GET_Name().'</h2>
        <h6>lieu: '.$value->GET_Lieu().'</h6>
        </div>';
      }else {
        $html .= '<div class="container_activite">
        <h2>'.$value->GET_Name().'</h2>
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
