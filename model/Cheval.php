<?php
class Cheval{

    // connection a la base et définition du nom de la tablee
    private $conn;
    private $table_name = "cheval";

    // proprietes de la classe Cheval
    public $id;
    public $nom;
    public $sexe;
    public $prixDepart;

    // constructeur prenant en paramètre la connection a la base
    public function __construct($db){
        $this->conn = $db;
    }


     // recuperation de la liste des chevaux
     function readAll(){

		$query = "SELECT * FROM " . $this->table_name ."";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

  function getChevauxByClient($id) {
    $query = "SELECT * FROM " . $this->table_name ." WHERE clientID = ?";
		$stmt = $this->conn->prepare($query);

    // affecte la valeur de l id au paramètre de la requete
		$stmt->bindParam(1, $id);

		$stmt->execute();
		return $stmt;
  }

  // consulter un cheval en fonction de son id
	function getChevalById(){


		$query = "SELECT * from ". $this->table_name . " WHERE id = ? ";
		$stmt = $this->conn->prepare( $query );

		// affecte la valeur de l id au paramètre de la requete
		$stmt->bindParam(1, $this->id);

		// execute la requete
		$stmt->execute();

		// recupere la ligne
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

    // valorise les proprietes de cheval
		$this->id = $row['id'];
		$this->nom = $row['nom'];
		$this->sexe = $row['sexe'];
		$this->prixDepart = $row['prixDepart'];

	}

    // creer cheval
  function create(){

      //requete sql
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                  id=:id, nom=:nom, sexe=:sexe, prixDepart=:prixDepart";

      $stmt = $this->conn->prepare($query);

      // "hydratation" de l'objet cheval
      $this->id=htmlspecialchars(strip_tags($this->id));
      $this->nom=htmlspecialchars(strip_tags($this->nom));
      $this->sexe=htmlspecialchars(strip_tags($this->sexe));
      $this->prixDepart=htmlspecialchars(strip_tags($this->prixDepart));


      // valorisation des paramètres de la requete avec les valeurs de l'objet cheval
      $stmt->bindParam(":id", $this->id);
      $stmt->bindParam(":nom", $this->nom);
      $stmt->bindParam(":sexe", $this->sexe);
      $stmt->bindParam(":prixDepart", $this->prixDepart);

      // execution de la requete
      if($stmt->execute()){
          return true;
      }

      return false;
  }
}
