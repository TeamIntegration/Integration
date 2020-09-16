<?php

/**
 *
 */
class Activite
{

  private $id;
  private $name;
  private $lieu;

  function __construct($myId, $myName, $myLieu)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->lieu = $myLieu;
  }

  public function GET_Id(){
    return $this->id;
  }

  public function GET_Name(){
    return $this->name;
  }

  public function GET_Lieu(){
    return $this->lieu;
  }
}


 ?>
