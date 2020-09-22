<?php

$email = $_POST['email'];
$password = $_POST['motDePasse'];

include '../../modele/inscription.php';
include '../../modele/connectionBDD.php';
include '../../modele/class_premiereAnnee.php';

$myConnexion = new accesBD();

 ?
