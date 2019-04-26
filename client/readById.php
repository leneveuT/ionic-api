<?php
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/x-www-form-urlencoded");


include_once '../config/database.php';
include_once '../model/client.php';
include_once '../model/cheval.php';

$database = new Database();
$db = $database->getConnection();

$client = new Client($db);

// valorise l id passe en parametre de l url
$id = isset($_GET['id']) ? $_GET['id'] : die();
$client->id = $id;


$cheval = new Cheval($db);

$chevaux = array();

// requete sur les chevaux
$stmt = $cheval->getChevauxByClient($id);
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
}

$client->getClientById();

if($client->nom!=null){

    $client = array(
        "id" =>  $client->id,
        "nom" => $client->nom,
        "mail" => $client->mail,
        "chevaux" => $chevaux
      );

    http_response_code(200);
    echo json_encode($client);
}
