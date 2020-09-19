<?php

/**
 *
 */
class User
{
  private $id;
  private $name;
  private $firstname;
  private $email;

  function __construct($myId, $myName, $myFirstName, $myEmail)
  {
    $this->id = $myId;
    $this->name = $myName;
    $this->firstname = $myFirstName;
    $this->email = $myEmail;
  }

  public function GET_Id(){
    return $this->id;
  }

  public function GET_Name(){
    return $this->name;
  }

  public function GET_FirstName(){
    return $this->firstname;
  }

  public function GET_Email(){
    return $this->email;
  }

  public function GET_Rank(){
    return $this->rank;
  }

}


 ?>
