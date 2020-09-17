<?php

/**
 *
 */
class Equipe
{
  private $id;
  private $name;
  private $nbMember;
  private $pointGlobal;
  private $liste_pointActivite;

  function __construct($myId, $myName, $myNbMember, $myPointGlobal, $myListe_pointActivite)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->nbMember = $myNbMember;
    $this->pointGlobal = $myPointGlobal;
    $this->liste_pointActivite = $myListe_pointActivite;
  }

  public function GET_Id(){
    return $this->id;
  }

  public function GET_Name(){
    return $this->name;
  }

  public function GET_NbMember(){
    return $this->$nbMember;
  }

  public function GET_PointGlobal(){
    return $this->pointGlobal;
  }
}


 ?>
