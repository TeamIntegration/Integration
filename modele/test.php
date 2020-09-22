<?php

include 'connectionBDD.php';
//include 'connexion.php';

$mydb = new accesBD();
//$connexion = new Connexion("baptiste.lecat44@gmail.com", "bat");

var_dump($mydb->REQConnexion_LoadInfo("1sio", 2));

 ?>
