<?php
header("Access-Control-Allow-Headers: content-type");
// entetes
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
header("Content-Type: application/x-www-form-urlencoded");

// connection a la base
// inclusion de la classe metier Client
include_once '../config/database.php';
include_once '../model/client.php';

// creation ou recuperation de la connection a la bdd
$database = new Database();
$db = $database->getConnection();

// instantiation d'un client
$client = new Client($db);

// requete sur les clients
$stmt = $client->readAll();
$num = $stmt->rowCount();

// verifie si au moins un enregistrement est trouve
if($num>0){
	 $clients = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $client=array(
            "id" => $id,
            "nom" => $nom,
           "mail" => $mail,
     		);
   $clients[] = $client;
   }
 // valorise la response : code - 200 OK
   http_response_code(200);

 // affiche les données des chevaux au format json
  echo json_encode($clients);
}
else{

   //  valorise la response : code - 404 Not found
   http_response_code(404);

   // message d'erreur
   echo json_encode(
       array("message" => "pas de client trouve.")
   );
}
