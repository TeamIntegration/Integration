<?php
session_start();

$score = $_POST["score"];

require '../../modele/connectionBDD.php';
include '../../modele/class_gerant.php';
include_once('../../modele/class_user.php');

$myConnexion = new AccesBD();
$myUser = unserialize($_SESSION['user']);
$idActivite = $myUser->GET_IdActivite();
$idUser = $myUser->GET_IdUser();
$idEquipe = unserialize($_SESSION['idEquipe']);

$resultSetScore = $myConnexion->REQActiviteDash_Finish($score, $idEquipe, $idUser, $idActivite);
if ($resultSetScore == 1) {
  $html = '<h4 class="successMessage">Le score à bien été ajouté.</h4>';
}else {
  $html = '<h4 class="errorMessage">Une erreur s\'est produite.</h4>';
}

$response = ["html" => $html];

echo json_encode($response);

 ?>
