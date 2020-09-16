<?php

//$liste_activite = unserialize($_SESSION["liste_activite"]);

//include 'activite.php';
$liste_activite = null;
$html = '<h1>Aucune activités!<h1>';

if ($liste_activite != null) {
  if (count($liste_activite) > 0) {
    $html = "";
    foreach ($liste_activite as $activite => $value) {
      $html .= '<div class="wrapper_activite">
        <div class="container_activite">
          <h2>'.$value->GET_Nom().'</h2>
          <h6>'.$value->GET_Lieu().'</h6>
        </div>';
    }
  }
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
