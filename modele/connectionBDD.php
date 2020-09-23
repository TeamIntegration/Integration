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

		$request = $this->bdd->prepare("SELECT etudiant.emailEtudiant FROM user WHERE etudiant.emailEtudiant = ?");
		if ($request->execute(array($email))) {
			if ($request->rowCount() <= 0) {
				$success = 1;
			}
		}

		return $success;
	}

//Si le success = 0 -> echec. Autrement il est égal à l'id du user.
	public function REQInscription_CreateAccount($name, $firstname, $email, $password){

		$success = 0;

		$request = $this->bdd->prepare("INSERT INTO etudiant (nomEtudiant, prenomEtudiant, emailEtudiant, passwordEtudiant) VALUES (?, ?, ?, ?)");
		if ($request->execute(array($name, $firstname, $email, $password))) {
			$request = $this->bdd->prepare("SELECT etudiant.idEtudiant FROM user WHERE etudiant.emailEtudiant = ?");
			if ($request->execute(array($email))) {
				$result = $request->fetch();
				$idUser = intval($result["id"]);
				$success = $idUser;
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
				$success = 1;
				$response = ["success" => $success, "idUser" => intval($result["idEtudiant"])];
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
						//C'est un gérant
						$success = 1;
						$response = ["success" => $success, "rank" => "gerant"];
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

	function REQActivite_Load($emailUser){
		$success = 0;
		$i = 0;

		$request = $this->bdd->prepare("SELECT activite.libelleActivite, activite.lieuActivite, participer.tour, participer.effectuer FROM activite, participer, 1SIO, etudiant WHERE activite.idActivite = participer.idActivite AND participer.idEquipe = 1sio.idEquipe AND 1sio.idEtudiant = etudiant.idEtudiant AND etudiant.emailEtudiant = ?");
		if ($request->execute(array($emailUser))) {
			if ($request->rowCount() > 0) {
				while ($result = $request->fetch()) {
					$liste_activite[$i] = ["libelleActivite" => $result["libelleActivite"], "lieuActivite" => $result["lieuActivite"], "tour" => $result["tour"], "effectuer" => $result["effectuer"]];
				}
				$success = 1;
				$response = ["success" => $success, "liste_activite" => $liste_activite];
			}else {
				$response = ["success" => $success];
			}
		}else {
			$response = ["success" => $success];
		}

		return $response;
	}

}


 ?>
