<?php

include 'connectionBDD.php';
//include 'connexion.php';

$mydb = new accesBD();
//$connexion = new Connexion("baptistte.lecat44@gmail.com", hash('sha256', "ert"));

var_dump($mydb->REQActivite_Load(110));
var_dump($mydb->REQActivite_Load(1));

 ?>
