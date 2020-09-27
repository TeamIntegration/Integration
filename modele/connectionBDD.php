<?php

/**
 *
 */
class accesBD
{
  //-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------ATTRIBUTS PRIVES--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	private $hote;
	private $login;
	private $passwd;
	private $base;
	private $bdd;
	private $port;

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//--------------------------CONSTRUCTEUR------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	public function __construct()
	{
		/*$this->hote="mysql-integration.alwaysdata.net";
		$this->port="";
		$this->login="214164";
		$this->passwd="baptiste24590";
		$this->base="integration_bdd";*/

		$this->hote="localhost";
		$this->port="";
		$this->login="root";
		$this->passwd="";
		$this->base="integration";


		$this->connexion();

	}

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-----------------------------CONNECTION A LA BASE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	private function connexion()
	{
		try
        {
			//echo "sqlsrv:server=$this->hote$this->port;Database=$this->base"." | ".$this->login." | ".$this->passwd;
			// Pour SQL Server
			//$this->conn = new PDO("sqlsrv:server=$this->hote$this->port;Database=$this->base", $this->login, $this->passwd);
			//$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            // Pour Mysql/MariaDB
            $this->bdd = new PDO("mysql:dbname=$this->base;host=$this->hote",$this->login, $this->passwd);
            $this->boolConnexion = true;
        }
        catch(PDOException $e)
        {
            die("Connexion à la base de données échouée".$e->getMessage());
        }
	}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------REQUEST DE REGISTER ET LOGIN--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------


	public function REQInscription_RegisterVerif_Email($email){

		$success = 0;

		$request = $this->bdd->prepare("SELECT etudiant.emailEtudiant FROM etudiant WHERE etudiant.emailEtudiant = ?");
		if ($request->execute(array($email))) {
			if ($request->rowCount() <= 0) {
				$success = 1;
			}
		}

		return $success;
	}

//Si le success = 0 -> echec. Autrement il est égal à l'id du user.
	public function REQInscription_CreateAccount($name, $firstname, $email, $password, $promo){

		$success = 0;

		$request = $this->bdd->prepare("INSERT INTO etudiant (nomEtudiant, prenomEtudiant, emailEtudiant, passwordEtudiant) VALUES (?, ?, ?, ?)");
		if ($request->execute(array($name, $firstname, $email, $password))) {
			$request = $this->bdd->prepare("SELECT etudiant.idEtudiant FROM etudiant WHERE etudiant.emailEtudiant = ?");
			if ($request->execute(array($email))) {
				$result = $request->fetch();
				$idUser = intval($result["idEtudiant"]);
				if ($promo == "1SIO") {
					$request = $this->bdd->prepare("INSERT INTO 1sio (idEtudiant) VALUES (?)");
					if ($request->execute(array($idUser))) {
						$success = $idUser;
					}
				}else {
					$request = $this->bdd->prepare("INSERT INTO 2sio (idEtudiant) VALUES (?)");
					if ($request->execute(array($idUser))) {
						$success = $idUser;
					}
				}
			}
		}

		return $success;
	}

	public function REQConnexion_VerifAccount($email, $password){
		$success = 0;

		$request = $this->bdd->prepare("SELECT etudiant.idEtudiant FROM etudiant WHERE etudiant.emailEtudiant = ? and etudiant.passwordEtudiant = ?");
		if ($request->execute(array($email, $password))) {
			if ($request->rowCount() > 0) {
				$result = $request->fetch();
				$idEtudiant = intval($result["idEtudiant"]);
				$success = 1;
				$response = ["success" => $success, "idUser" => $idEtudiant];
			}else {
				$response = ["success" => $success];
			}
		}else {
			$response = ["success" => $success];
		}

		return $response;
	}

	public function REQConnexion_SearchRank($idUser){
		$success = 0;

		$request = $this->bdd->prepare("SELECT 1sio.idEtudiant FROM 1sio WHERE 1sio.idEtudiant = ?");
		if ($request->execute(array($idUser))) {
			if ($request->rowCount() > 0) {
				//C'est un 1sio
				$success = 1;
				$response = ["success" => $success, "rank" => "1sio"];
			}else {
				$request = $this->bdd->prepare("SELECT accompagner.idEtudiant FROM accompagner WHERE accompagner.idEtudiant = ?");
				if ($request->execute(array($idUser))) {
					if ($request->rowCount() > 0) {
						//C'est un accompagnant
						$success = 1;
						$response = ["success" => $success, "rank" => "accompagnant"];
					}else {
						$request = $this->bdd->prepare("SELECT gerer.idEtudiant FROM gerer WHERE gerer.idEtudiant = ?");
						if ($request->execute(array($idUser))) {
							if ($request->rowCount() > 0) {
								//C'est un gerant
								$success = 1;
								$response = ["success" => $success, "rank" => "gerant"];
							}else {
								$request = $this->bdd->prepare("SELECT admin.idAdmin FROM admin WHERE admin.idAdmin = ?");
								if ($request->execute(array($idUser))) {
									if ($request->rowCount() > 0) {
										//C'est un Admin
										$success = 1;
										$response = ["success" => $success, "rank" => "admin"];
									}else {
										$success = 0;
									}
								}
							}
					}
				}
			}
		}
 	}

		if ($success == 0) {
			$response = ["success" => $success];
		}

		return $response;
	}

	public function REQConnexion_LoadInfo($rank, $idUser){
		$success = 0;

		switch ($rank) {
			case "1sio":
				$request = $this->bdd->prepare("SELECT 1sio.idEquipe, etudiant.nomEtudiant, etudiant.prenomEtudiant, etudiant.emailEtudiant FROM 1sio, etudiant WHERE etudiant.idEtudiant = 1sio.idEtudiant and etudiant.idEtudiant = ?");
				if ($request->execute(array($idUser))) {
					if ($request->rowCount() > 0) {
						$result = $request->fetch();
						$success = 1;
						$response = ["success" => $success, "nomEtudiant" => $result["nomEtudiant"], "prenomEtudiant" => $result["prenomEtudiant"], "emailEtudiant" => $result["emailEtudiant"], "idEquipe" => $result["idEquipe"]];
					}
				}

				if ($success == 0) {
					$response = ["success" => $success];
				}
				break;
			case "accompagnant":
				$request = $this->bdd->prepare("SELECT accompagner.idEquipe, etudiant.nomEtudiant, etudiant.prenomEtudiant, etudiant.emailEtudiant FROM accompagner, etudiant WHERE etudiant.idEtudiant = accompagner.idEtudiant and etudiant.idEtudiant = ?");
				if ($request->execute(array($idUser))) {
					if ($request->rowCount() > 0) {
						$result = $request->fetch();
						$success = 1;
						$response = ["success" => $success, "nomEtudiant" => $result["nomEtudiant"], "prenomEtudiant" => $result["prenomEtudiant"], "emailEtudiant" => $result["emailEtudiant"], "idEquipe" => $result["idEquipe"]];
					}
				}

				if ($success == 0) {
					$response = ["success" => $success];
				}
				break;
			case "gerant":
				$request = $this->bdd->prepare("SELECT gerer.idActivite, etudiant.nomEtudiant, etudiant.prenomEtudiant, etudiant.emailEtudiant FROM gerer, etudiant WHERE etudiant.idEtudiant = gerer.idEtudiant and etudiant.idEtudiant = ?");
				if ($request->execute(array($idUser))) {
					if ($request->rowCount() > 0) {
						$result = $request->fetch();
						$success = 1;
						$response = ["success" => $success, "nomEtudiant" => $result["nomEtudiant"], "prenomEtudiant" => $result["prenomEtudiant"], "emailEtudiant" => $result["emailEtudiant"], "idActivite" => $result["idActivite"]];
					}
				}

				if ($success == 0) {
					$response = ["success" => $success];
				}
				break;
		}

		return $response;
	}

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------REQUEST EQUIPE--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function REQLeaderBoard_LoadEquipe(){
		$success = 0;
		$errorMessage = "";
		$i = 0;
		$j = -1;
		$flag = false;
//liste de liste
		$request = $this->bdd->prepare("SELECT etudiant.nomEtudiant, equipe.nomEquipe, equipe.scoreEquipe FROM equipe, etudiant, 1sio WHERE equipe.idEquipe = 1sio.idEquipe and etudiant.idEtudiant = 1sio.idEtudiant and equipe.scoreEquipe IS NOT NULL ORDER BY equipe.scoreEquipe DESC, equipe.nomEquipe ASC");
		if ($request->execute()) {
			//Pour chaque Row -> etudiant 1SIO qui sont dans une équipe qui a joué.
			if ($request->rowCount() > 0) {
				while ($result = $request->fetch()) {
					if ($i > 0) {
						foreach ($liste_nomEquipe as $key => $value) {
							if ($result["nomEquipe"] == $value) {
								$flag = true;
							}
						}
					}
					//On a une nouvelle équipe donc on l'ajoute à la liste et on remet j=0 pour inserer le premier étudiant.
					if ($flag == false) {
						$j = 0;
						$liste_nomEquipe[$i] = $result["nomEquipe"];
						$liste_score[$i] = $result["scoreEquipe"];
						$i++;
					}
					//On a une equipe déja créer donc on ajoute uniquement l'étudiant.
					$liste_nomEtudiant[$i - 1][$j] = $result["nomEtudiant"]; //Liste des étudiants par rapport au equipe.
					$flag = false;
					$j++;
				}
				$success = 1;
				$response = ["liste_nomEquipe" => $liste_nomEquipe, "liste_nomEtudiant" => $liste_nomEtudiant, "liste_score" => $liste_score, "success" => $success];

			}else {
				$success = 0;
				$errorMessage = "Le classement n'est pas encore disponible.";
				$response = ["errorMessage" => $errorMessage, "success" => $success];
			}
		}else {
			$response = ["success" => $success, "errorMessage" => $errorMessage];
		}
		return $response;
	}

	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------REQUEST ACTIVITE--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	//SELECT activite.libelleActivite, activite.lieuActivite, participer.tour, participer.effectuer FROM activite, participer, 1SIO, etudiant WHERE activite.idActivite = participer.idActivite AND participer.idEquipe = 1sio.idEquipe AND 1sio.idEtudiant = etudiant.idEtudiant AND etudiant.emailEtudiant = "baptiste.lecat44@gmail.com";

	function REQActivite_Load($idEquipe){
		$success = 0;
		$i = 0;

		$request = $this->bdd->prepare("SELECT participer.tour, participer.effectuer, participer.idActivite FROM participer WHERE participer.idEquipe = ? ORDER BY participer.tour ASC");
		if ($request->execute(array($idEquipe))) {
			while ($result = $request->fetch()) {
				$liste_activite[$i] = ["idActivite" => $result["idActivite"], "tour" => $result["tour"], "effectuer" => $result["effectuer"]];
				$i++;
			}
			foreach ($liste_activite as $index => $value) {
				$request = $this->bdd->prepare("SELECT activite.libelleActivite, activite.lieuActivite FROM activite WHERE activite.idActivite = ?");
				if ($request->execute(array($value["idActivite"]))) {
					$result = $request->fetch();
					$liste_activite[$index] = ["idActivite" => $value["idActivite"], "libelleActivite" => $result["libelleActivite"], "lieuActivite" => $result["lieuActivite"], "tour" => $value["tour"], "effectuer" => $value["effectuer"]];
					$success = 1;
				}
			}
			if ($success == 1) {
				$response = ["success" => $success, "liste_activite" => $liste_activite];
			}
		}

		if ($success == 0) {
			$response = ["success" => $success];
		}

		return $response;
	}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------REQUEST ACTIVITE_DASHBOARD--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function REQTour_tour(){
		$success = 0;

		$request = $this->bdd->prepare("SELECT tour.nbTour FROM tour");
		if ($request->execute()) {
			$success = 1;
			$result = $request->fetch();
			$response = ["success" => $success, "tour" => intval($result["nbTour"])];
		}else {
			$response = ["success" => $success];
		}

		return $response;
	}

	public function REQActiviteDash_ScoreEquipe($idEquipe){
		$success = 0;

		$request = $this->bdd->prepare("SELECT equipe.scoreEquipe FROM equipe WHERE equipe.idEquipe = ?");
		if ($request->execute(array($idEquipe))) {
			if ($request->rowCount() > 0) {
				$result = $request->fetch();
				$success = 1;
				$response = ["success" =>$success, "score" => intval($result["scoreEquipe"])];
			}
		}

		if ($success == 0) {
			$response = ["success" => $success];
		}
		return $response;
	}

	public function REQActiviteDash_IdEquipeActivite($idActivite, $tour){
		$success = 0;

		$request = $this->bdd->prepare("SELECT participer.idEquipe FROM participer, equipe WHERE participer.idEquipe = equipe.idEquipe and participer.idActivite = ? and participer.tour = ? and equipe.scoreEquipe IS NOT NULL");
		if ($request->execute(array($idActivite, $tour))) {
			if ($request->rowCount() > 0) {
				$result = $request->fetch();
				$success = 1;
				$response = ["success" => $success, "idEquipe" => intval($result["idEquipe"]), "message" => ""];
			}else {
				$success = 1;
				$response = ["success" => $success, "message" => "noActivite"];
			}
		}else {
			$response = ["success" => $success, "message" => ""];
		}

		return $response;
	}

	public function REQActiviteDash_VerifActive($idEquipe, $idActivite){

		$request = $this->bdd->prepare("SELECT participer.effectuer FROM participer WHERE participer.idEquipe = ? and participer.idActivite = ?");
		if ($request->execute(array($idEquipe, $idActivite))) {
			$result = $request->fetch();
			$response = intval($result["effectuer"]);
		}

		return $response;
	}

	public function REQActiviteDash_Finish($score, $idEquipe, $idUser, $idActivite){
		$success = 0;

		$request = $this->bdd->prepare("SELECT equipe.scoreEquipe FROM equipe WHERE equipe.idEquipe = ?");
		if ($request->execute(array($idEquipe))) {
			$request = $this->bdd->prepare("UPDATE equipe SET equipe.scoreEquipe = ? WHERE equipe.idEquipe = ?");
			if ($request->execute(array($score, $idEquipe))) {
				$request = $this->bdd->prepare("UPDATE gerer SET gerer.activiteFini = 1 WHERE gerer.idEtudiant = ?");
				if ($request->execute(array($idUser))) {
					$request = $this->bdd->prepare("UPDATE participer SET participer.effectuer = 1 WHERE participer.idEquipe = ? and participer.idActivite = ?");
					if ($request->execute(array($idEquipe, $idActivite))) {
						$success = 1;
					}
				}
			}
		}

		return $success;
	}


	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
	//----------------------------REQUEST ADMIN TOOLS--------------------------------------------------------------------------------------------------------------------------------------------------
	//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------

	public function REQAdmin_IdEtudiant1SIO(){
		$success = 0;

  	$request = $this->bdd->prepare("SELECT idEtudiant FROM 1sio where idEquipe = 0");
		if ($request->execute()) {
			if ($request->rowCount() > 0) {
				$i=0;
				while ($result = $request->fetch()) {
					$liste_idEtudiant1SIO[$i] = $result['idEtudiant'];
					$i++;
				}
				$success = 1;
				$response = ["success" => $success, "liste_idEtudiant" => $liste_idEtudiant1SIO];
			}
		}

		if ($success == 0) {
			$response = ["success" => $success];
		}

  	return $response;
	}

	public function REQAdmin_SetIdEquipe($liste_Equipe_Etudiant){

		$liste_idEtudiant = $liste_Equipe_Etudiant["listeIdEtudiant"];
		$liste_idEquipe = $liste_Equipe_Etudiant["listeIdEquipe"];

		foreach ($liste_idEtudiant as $index => $value) {
			$request = $this->bdd->prepare("UPDATE 1sio SET 1sio.idEquipe= ? WHERE 1sio.idEtudiant = ?");
			$request->execute(array($liste_idEquipe[$index], $value));
		}
	}

	/*public function REQAdmin_InitScore($liste_Equipe_Etudiant){
		$liste
	}*/

}


 ?>
