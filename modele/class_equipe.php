<?php

/**
 *
 */
class Equipe
{
  private $id;
  private $score;

  function __construct($myName, $myListe_nomEtudiant, $myPoint)
  {
    $this->name = $myName;
    $this->liste_nomEtudiant = $myListe_nomEtudiant;
    $this->point = $myPoint;
  }

  public function GET_Name(){
    return $this->name;
  }

  public function GET_ListeNomEtudiant(){
    return $this->liste_nomEtudiant;
  }

  public function GET_Point(){
    return $this->point;
  }
}


 ?>
