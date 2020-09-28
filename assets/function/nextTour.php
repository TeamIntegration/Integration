<?php

include '../../modele/connectionBDD.php';

$myConnexion = new AccesBD();
$success = 0;

$resultatTour = $myConnexion->REQTour_tour();
if ($resultatTour["success"] == 1) {
  $tourActuel = $resultatTour["tour"];
  $resultatSetTour = $myConnexion->REQAdmin_SetTour($tourActuel + 1);
  if ($resultatSetTour["success"] == 1) {
    $myConnexion->REQAdmin_ResetActivite();
    $success = 1;
  }
}

$response = ["success" => $success];
echo json_encode($response);

 ?>
