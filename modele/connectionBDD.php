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

		$request = $this->bdd->prepare("SELECT user.email FROM user WHERE user.email = ?");
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

		$request = $this->bdd->prepare("INSERT INTO user (name, firstname, email, password) VALUES (?, ?, ?, ?)");
		if ($request->execute(array($name, $firstname, $email, $password))) {
			$request = $this->bdd->prepare("SELECT user.id FROM user WHERE user.email = ?");
			if ($request->execute(array($email))) {
				$result = $request->fetch();
				$idUser = intval($result["id"]);
				$success = $idUser;
			}
		}

		return $success;
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

		$request = $this->bdd->prepare("SELECT activite.libelleActivite, activite.lieuActivite, participer.tour, participer.effectuer FROM activite, participer, 1SIO, etudiant WHERE activite.idActivite = participer.idActivite AND participer.idEquipe = 1sio.idEquipe AND 1sio.idEtudiant = etudiant.idEtudiant AND etudiant.emailEtudiant = ?");
		if ($request->execute(array($emailUser))) {
			while ($result = $request->fetch()) {
				// code...
			}
		}
		}

}


 ?>
