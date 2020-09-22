<?php

include_once('class_user.php');

/**
 *
 */
class Accompagnant extends User
{
  private $idEquipe;

  function __construct($myId, $myName, $myFirstName, $myEmail, $myIdEquipe)
  {
    $this->idEquipe = $myIdEquipe;
    parent::__construct($myId, $myName, $myFirstName, $myEmail);
  }

  public function GET_IdEquipe(){
    return $this->idEquipe;
  }
}


 ?>
