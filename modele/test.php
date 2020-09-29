<?php

include 'connectionBDD.php';
//include 'connexion.php';

$mydb = new accesBD();
//$connexion = new Connexion("baptistte.lecat44@gmail.com", hash('sha256', "ert"));

var_dump($mydb->REQActiviteDash_GetNomEquipe(110));

 ?>
