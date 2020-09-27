<?php

/**
 *
 */
class Activite
{

  private $id;
  private $libelle;
  private $lieu;
  private $tour;
  private $effectuer;

  function __construct($myId, $myLibelle, $myLieu, $myTour, $myEffectuer)
  {
    $this->id = $myId;
    $this->libelle = $myLibelle;
    $this->lieu = $myLieu;
    $this->tour = $myTour;
    $this->effectuer = $myEffectuer;
  }

  public function GET_Id(){
    return $this->id;
  }

  public function GET_libelle(){
    return $this->libelle;
  }

  public function GET_Lieu(){
    return $this->lieu;
  }

  public function GET_Tour(){
    return $this->tour;
  }

  public function GET_Effectuer(){
    return $this->effectuer;
  }
}


 ?>
