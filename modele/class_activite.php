<?php

/**
 *
 */
class Activite
{

  private $id;
  private $name;
  private $lieu;
  private $participer;

  function __construct($myId, $myName, $myLieu, $myParticiper)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->lieu = $myLieu;
    $this->participer = $myParticiper;
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

  public function GET_Participer(){
    return $this->participer;
  }

  public function SET_Participer(){
    $this->participer = true;
  }
}


 ?>
