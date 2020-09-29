<?php

include '../../modele/connectionBDD.php';

$myConnexion = new AccesBD();
$success = 0;

$tableau22 = $myConnexion->REQAdmin_IdEtudiant1SIO();

if ($tableau22['success']==1) // c'est un tableau donc la il
// regarde si tout les valeurs de la colonne success sont à 1 ?
{
  $liste_Id1SIO=$tableau22['liste_idEtudiant'];
  //Requete count 1SIO -> $nbParticipant
  $nbParticipant = count($liste_Id1SIO);

  $reste = $nbParticipant % 4;

  $nbEquipe = 0;
  $nbEquipeA3=0;
  $nbEquipeA4=0;

  if ($nbParticipant > 48)
  {
    $nbEquipe = 13;
    switch ($reste)
    {
      case '1'://49
      $nbEquipeA3=3;
      break;

      case '2'://50
      $nbEquipeA3=2;
      break;

      case '3'://51
      $nbEquipeA3=1;
      break;

      default://52
      break;

    }
  }
  else
  {
    if ($nbParticipant > 44)
    {
      $nbEquipe = 12;
      switch ($reste)
      {
        case '1'://45
        $nbEquipeA3=3;
        break;

        case '2'://46
        $nbEquipeA3=2;
        break;

        case '3'://47
        $nbEquipeA3=1;
        break;

        default://48
        break;
      }
    }
    else
    {
      if ($nbParticipant > 40)
      {
        $nbEquipe = 11;
        switch ($reste)
        {
          case '1'://41
            $nbEquipeA3=3;
            break;

          case '2'://42
            $nbEquipeA3=2;
            break;

          case '3'://43
            $nbEquipeA3=1;
            break;

          default://44
            break;
        }
      }
      else
      {
        if ($nbParticipant > 36)
        {
          $nbEquipe = 10;
          switch ($reste)
          {
            case '1'://37
              $nbEquipeA3=3;
              break;

            case '2'://38
              $nbEquipeA3=2;
              break;

            case '3'://39
              $nbEquipeA3=1;
              break;

            default://40
              break;
          }
        }
      }
    }
  }
  $nbEquipeA4=$nbEquipe-$nbEquipeA3;

  // $nbEquipe
  // $nbEquipeA4
  // $nbEquipeA3
  $nbFirstEquipe=0;
  switch ($nbEquipe)
  {
    case 13:
      $nbFirstEquipe=1;
      break;

    case 12:
      $nbFirstEquipe=101;
      break;

    case 11:
      $nbFirstEquipe=201;
      break;

    case 10:
      $nbFirstEquipe=301;
      break;

    default:
      # code...
      break;
  }
// $nbEquipe
// $nbEquipeA4
// $nbEquipeA3
// $nbFirstEquipe

$listeIdMelange=melangeEtudiant($liste_Id1SIO);
$listeEquipe = array();


for ($j=0; $j < $nbEquipeA4; $j++)
{
  for ($k=0; $k <4 ; $k++)
  {
    array_push($listeEquipe, $nbFirstEquipe);
  }
  $nbFirstEquipe++;
}
for ($j=0; $j <$nbEquipeA3 ; $j++)
{
  for ($k=0; $k <3 ; $k++)
  {
    array_push($listeEquipe, $nbFirstEquipe);
  }
  $nbFirstEquipe++;
}
$tableEquipe=['listeIdEtudiant' =>$listeIdMelange,'listeIdEquipe'=>$listeEquipe];
$myConnexion->REQAdmin_SetIdEquipe($tableEquipe);

$resultatInit = $myConnexion->REQAdmin_InitScore($tableEquipe);
$resultatSetAccompagnant = $myConnexion->REQAdmin_SetAccompagnantEquipe($tableEquipe);
if ($resultatSetAccompagnant == 1) {
  if ($myConnexion->REQAdmin_SetEquipeNom() == 1) {
    $success = 1;
  }
}

}

//random_int ( int $min , int $max ) : int
function melangeEtudiant($liste)
{
  shuffle($liste);
  return $liste;
}

$response = ["success" => $success];

echo json_encode($response);


 ?>
