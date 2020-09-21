<?php

/**
 *
 */
class Activite
{

  private $id;
  private $name;
  private $lieu;
  //private $tour;
  private $effectuer;

  function __construct($myId, $myName, $myLieu, $myEffectuer)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->lieu = $myLieu;
    //$this->tour = $myTour;
    $this->effectuer = $myEffectuer;
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

/*  public function GET_Tour(){
    return $this->tour;
  }*/

  public function GET_Effectuer(){
    return $this->effectuer;
  }

  public function SET_Effectuer(){
    $this->effectuer = true;
  }
}


 ?>
