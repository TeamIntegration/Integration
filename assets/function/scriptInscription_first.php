<?php
session_start();

$name = htmlspecialchars(strip_tags($_POST['nom']));
$firstname = htmlspecialchars(strip_tags($_POST['prenom']));
$email = $_POST['email'];
$password = hash('sha256', $_POST['motDePasse']);

//On fait passer dans la session le contenu du premier formulaire.
//Pour pouvoir la récuperer lors de la seconde étape du formulaire.
$form_first = ["name" => $name, "firstname" => $firstname, "email" => $email, "password" => $password];
$_SESSION["form_first"] = serialize($form_first);

$response = ["success" => 1];

echo json_encode($response);

?>
