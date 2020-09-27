<?php

include_once('class_user.php');

/**
 *
 */
class Admin extends User
{

  function __construct($myId, $myName, $myFirstName, $myEmail)
  {
    parent::__construct($myId, $myName, $myFirstName, $myEmail);
  }

  
}


 ?>
