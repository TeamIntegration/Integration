<?php

require('connectionBDD.php');

/**
 *
 */
class Connexion
{
  private $email;
  private $password;
  private $bdd;

  function __construct($myEmail, $myPassword)
  {
    $this->email = $myEmail;
    $this->password = $myPassword;
    $this->bdd = new AccesBD();
  }

  public function Load_Account(){
    $success = 0;

    $resultVerifAccount = $this->bdd->REQConnexion_VerifAccount($this->email, $this->password);
    if ($resultVerifAccount["success"] == 1) {
      $idUser = $resultVerifAccount["idUser"];
      $success = 1;
      $response = ["success" => $success, "idUser" => $idUser];
    }else {
      $response = ["success" => $success];
    }
    return $response;
  }

  public function Recup_Info($idUser){
    $success = 0;

    $resultSearchRank = $this->bdd->REQConnexion_SearchRank($idUser);
    if ($resultSearchRank["success"] == 1) {
      $resultLoadInfo = $this->bdd->REQConnexion_LoadInfo($resultSearchRank["rank"], $idUser);
      switch ($resultSearchRank["rank"]) {
        case "1sio":
          if ($resultLoadInfo["success"] == 1) {
            $success = 1;
            $response = ["success" => $success, "rank" => $resultSearchRank["rank"], "nomEtudiant" => $resultLoadInfo["nomEtudiant"], "prenomEtudiant" => $resultLoadInfo["prenomEtudiant"], "emailEtudiant" => $resultLoadInfo["emailEtudiant"], "idEquipe" => $resultLoadInfo["idEquipe"]];
          }else {
            $success = 2;
            $response	= ["success" => $success];
          }
          break;
        case "accompagnant":
        if ($resultLoadInfo["success"] == 1) {
          $success = 1;
          $response = ["success" => $success, "rank" => $resultSearchRank["rank"], "nomEtudiant" => $resultLoadInfo["nomEtudiant"], "prenomEtudiant" => $resultLoadInfo["prenomEtudiant"], "emailEtudiant" => $resultLoadInfo["emailEtudiant"], "idEquipe" => $resultLoadInfo["idEquipe"]];
        }
          break;
        case "gerant":
        if ($resultLoadInfo["success"] == 1) {
          $success = 1;
          $response = ["success" => $success, "rank" => $resultSearchRank["rank"], "nomEtudiant" => $resultLoadInfo["nomEtudiant"], "prenomEtudiant" => $resultLoadInfo["prenomEtudiant"], "emailEtudiant" => $resultLoadInfo["emailEtudiant"], "idActivite" => $resultLoadInfo["idActivite"]];
        }
          break;
      }
    }else {
      $success = 2;
      $response = ["success" => $success];

    }

    if ($success == 0) {
      $response = ["success" => $success];
    }

    return $response;
  }
}


 ?>
