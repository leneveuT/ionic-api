<?php
header("Access-Control-Allow-Headers: content-type");
// entetes
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: application/x-www-form-urlencoded");

// connection a la base
// inclusion de la classe metier Cheval
include_once '../config/database.php';
include_once '../model/cheval.php';

// creation ou recuperation de la connection a la bdd
$database = new Database();
$db = $database->getConnection();

//instantiation d'un cheval
$cheval = new Cheval($db);

// requete sur les chevaux
$stmt = $cheval->readAll();
$num = $stmt->rowCount();

// verifie si au moins un enregistrement est trouve
if($num>0){
	 $chevaux = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cheval=array(
            "id" => $id,
            "nom" => $nom,
           "sexe" => html_entity_decode($sexe),
     "prixDepart" => $prixDepart

       );
   $chevaux[] = $cheval;
   }
 // valorise la response : code - 200 OK
   http_response_code(200);

 // affiche les données des chevaux au format json
  echo json_encode($chevaux);
}
else{

   //  valorise la response : code - 404 Not found
   http_response_code(404);

   // message d'erreur
   echo json_encode(
       array("message" => "pas de cheval trouve.")
   );
}
