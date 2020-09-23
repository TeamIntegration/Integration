<?php
session_start();

//récupération de la premiere partie des data du formulaire.
$form_first = unserialize($_SESSION["form_first"]);

$code = $_POST["code"];
$promo = $_POST["promo"];
$code1SIO = "efj78a";
$code2SIO = "oj78nf";


include '../../modele/inscription.php';
include '../../modele/class_premiereAnnee.php';

$success = 0;
$message = "";

if ($code == $code1SIO || $code == $code2SIO) {
  //Instanciation d'un nouvel object Inscription.
  $inscription = new Inscription($form_first["name"], $form_first["firstname"], $form_first["email"], $form_first["password"], $promo);
  $resultatPushInscription = $inscription->Create_Account();//On PUSH les data.
  if ($resultatPushInscription['success'] == 1) {
    $success = 1;
    $message = $resultatPushInscription['message'];
  }else {
    $success = 0;
    $message = $resultatPushInscription['message'];
  }
}else {
  $success = 0;
  $message = "Code de verification incorrect!";
}

$response	= ["success" => $success, "message" => $message];
echo json_encode($response);

 ?>
