<?php

include_once('class_user.php');

/**
 *
 */
class Gerant extends User
{
  private $idActivite;

  function __construct($myId, $myName, $myFirstName, $myEmail, $myIdActivite)
  {
    $this->idActivite = $myIdActivite;
    parent::__construct($myId, $myName, $myFirstName, $myEmail);
  }

  public function GET_IdActivite(){
    return $this->idActivite;
  }
}


 ?>
