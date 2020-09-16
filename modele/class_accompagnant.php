<?php

/**
 *
 */
class Accompagnant extends User
{
  private $codeVerif;

  function __construct($myId, $myName, $myFirstName, $myEmail, $myCodeVerif)
  {
    $this->codeVerif = $myCodeVerif;
    parent::__construct($myId, $myName, $myFirstName, $myEmail);
  }
}


 ?>
