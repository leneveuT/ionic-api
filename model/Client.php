<?php
class Client{

    // connection a la base et définition du nom de la table
    private $conn;
    private $table_name = "client";

    // proprietes de la classe Client
    public $id;
    public $nom;
    public $mail;

    // constructeur prenant en paramètre la connection a la base
    public function __construct($db){
        $this->conn = $db;
    }


     // recuperation de la liste des clients
    function readAll(){
      $query = "SELECT * FROM " . $this->table_name ."";
		  $stmt = $this->conn->prepare($query);
		  $stmt->execute();
		  return $stmt;
	   }

  // consulter un client en fonction de son id
	function getClientById(){


		$query = "SELECT * from ". $this->table_name . " WHERE id = ? ";
		$stmt = $this->conn->prepare($query);

		// affecte la valeur de l id au paramètre de la requete
		$stmt->bindParam(1, $this->id);

		// execute la requete
		$stmt->execute();

		// recupere la ligne
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

    // valorise les proprietes de cheval
		$this->id = $row['id'];
		$this->nom = $row['nom'];
		$this->mail = $row['mail'];

	}

    // creer un client
  function create(){

      //requete sql
      $query = "INSERT INTO
                  " . $this->table_name . "
              SET
                  id=:id, nom=:nom, mail=:mail";

      $stmt = $this->conn->prepare($query);

      // "hydratation" de l'objet cheval
      $this->id=htmlspecialchars(strip_tags($this->id));
      $this->nom=htmlspecialchars(strip_tags($this->nom));
      $this->mail=htmlspecialchars(strip_tags($this->mail));


      // valorisation des paramètres de la requete avec les valeurs de l'objet cheval
      $stmt->bindParam(":id", $this->id);
      $stmt->bindParam(":nom", $this->nom);
      $stmt->bindParam(":mail", $this->mail);

      // execution de la requete
      if($stmt->execute()){
          return true;
      }

      return false;
  }
}
