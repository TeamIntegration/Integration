<?php

//INCLUDE CONNECTION BDD.
include 'connectionBDD.php';

/**
 *
 */
class Inscription
{
  private $name;
  private $firstname;
  private $email;
  private $password;
  private $promo;
  private $bdd;

  function __construct($myName, $myFirstName, $myEmail, $myPassword, $myPromo)
  {
    $this->name = $myName;
    $this->firstname = $myFirstName;
    $this->email = $myEmail;
    $this->password = $myPassword;
    $this->promo = $myPromo;
    $this->bdd = new accesBD;
  }

  private function Verif_Email(){
    $success = 0;
    if ($this->bdd->REQInscription_RegisterVerif_Email($this->email) == 1) {
      $success = 1;
    }
    return $success;
  }

  public function Create_Account(){
    $success = 0;

    if ($this->Verif_Email() == 1) {
      $createAccountResult = $this->bdd->REQInscription_CreateAccount($this->name, $this->firstname, $this->email, $this->password, $this->promo);
      if ($createAccountResult != 0) {
        $success = 1;
        $message = "Vous avez bien été inscrit.";
        $response = ["success" => $success, "message" => $message, "idUser" => $createAccountResult];
      }else {
        $message = "Une erreur s'est produite lors de la création du compte.";
        $response = ["success" => $success, "message" => $message];
      }
    }else {
      $message = "Votre email n'est pas valide.";
      $response = ["success" => $success, "message" => $message];
    }


    return $response;
  }


}


 ?>
