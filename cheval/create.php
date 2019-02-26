<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';
include_once '../model/cheval.php';

$database = new Database();
$db = $database->getConnection();

$cheval = new Cheval($db);

// recuperation des donnees json "postees"
$data = json_decode(file_get_contents("php://input"));

// verifie que les donnees existent
if(
    !empty($data->id) &&
	!empty($data->nom) &&
	!empty($data->sexe) &&
    !empty($data->prixDepart)

){

    // valorisation de l'objet cheval avec les donnes postees
    $cheval->id = $data->id;
    $cheval->nom = $data->nom;
    $cheval->sexe = $data->sexe;
    $cheval->prixDepart = $data->prixDepart;

    // insertion du cheval en bdd
    if($cheval->create()){

        // valorisation de la response : code - 201 created
        http_response_code(201);

        // message de retour encodé en json
        echo json_encode(array("message" => "cheval créé."));
    }

    // message d'erreur en cas d'échec de la requete sql
    else{

        // response code - 503 service unavailable
        http_response_code(503);

        // message d'erreur
        echo json_encode(array("message" => "Insertion cheval en bdd impossible"));
    }
}

// message de retour si donnees postees incorrectes
else{

    // response code - 400 bad request
    http_response_code(400);

    // message d'erreur de retour
    echo json_encode(array("message" => "Impossible de creer un cheval. Les donnes sont incompletes."));
}
