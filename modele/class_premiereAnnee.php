<?php

include_once('class_user.php');

/**
 *
 */
class PremiereAnnee extends User
{
  private $idEquipe;

  function __construct($myId, $myName, $myFirstName, $myEmail, $myIdEquipe)
  {
    $this->idEquipe = $myIdEquipe;
    parent::__construct($myId, $myName, $myFirstName, $myEmail);
  }

  //gerer si il a une equipe.

  public function GET_IdEquipe(){
    return $this->idEquipe;
  }
}


 ?>
