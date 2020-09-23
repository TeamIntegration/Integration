<?php
session_start();

$email = $_POST['email'];
$password = $_POST['motDePasse'];
$success = 0;

include '../../modele/class_gerant.php';
include '../../modele/class_accompagnant.php';
include '../../modele/connexion.php';
include '../../modele/class_premiereAnnee.php';

$myConnexion = new Connexion($email, $password);
$resultConnexion = $myConnexion->Load_Account();
if ($resultConnexion["success"] == 1) {
  $idUser = $resultConnexion["idUser"];
  $resultRecupInfo = $myConnexion->Recup_Info($idUser);
  if ($resultRecupInfo["success"] == 1) {
    switch ($resultRecupInfo["rank"]) {
      case "1sio":
      $myUser = new PremiereAnnee($idUser, $resultRecupInfo["nomEtudiant"], $resultRecupInfo["prenomEtudiant"], $resultRecupInfo["emailEtudiant"], $resultRecupInfo["idEquipe"]);
        break;
      case "accompagnant":
      $myUser = new Accompagnant($idUser, $resultRecupInfo["nomEtudiant"], $resultRecupInfo["prenomEtudiant"], $resultRecupInfo["emailEtudiant"], $resultRecupInfo["idEquipe"]);
        break;
      case "gerant":
      $myUser = new Gerant($idUser, $resultRecupInfo["nomEtudiant"], $resultRecupInfo["prenomEtudiant"], $resultRecupInfo["emailEtudiant"], $resultRecupInfo["idActivite"]);
        break;
    }

    $_SESSION["user"] = serialize($myUser);
    $success = 1;
  }
}

$response = ["success" => $success];

echo json_encode($response);

?>
