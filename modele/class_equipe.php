<?php

/**
 *
 */
class Equipe
{
  private $id;
  private $name;
  private $nbMember;

  function __construct($myId, $myName, $myNbMember)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->$nbMember = $myNbMember;
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
}


 ?>
