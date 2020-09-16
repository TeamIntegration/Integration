<?php
session_start();

//récupération de la premiere partie des data du formulaire.
$form_first = unserialize($_SESSION["form_first"]);

//$promo = $_POST["promo"];
$promo = "1SIO";


include '../../modele/inscription.php';
include '../../modele/class_premiereAnnee.php';

$success = 0;
$message = "";

//Instanciation d'un nouvel object Inscription.
$inscription = new Inscription($form_first["name"], $form_first["firstname"], $form_first["email"], $form_first["password"], $promo);
$resultatPushInscription = $inscription->Create_Account();//On PUSH les data.
if ($resultatPushInscription['success'] == 1) {
  $success = 1;
  $message = $resultatPushInscription['message'];
  $myUser = new PremiereAnnee($resultatPushInscription['idUser'], $form_first["name"], $form_first["firstname"], $form_first["email"]);
  $_SESSION['login'] = serialize($myUser);

}else {
  $success = 0;
  $message = $resultatPushInscription['message'];
}

$response	= ["success" => $success, "message" => $message];
echo json_encode($response);

 ?>
