<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';
include_once '../model/cheval.php';

$database = new Database();
$db = $database->getConnection();

$cheval = new Cheval($db);

// verifie que les donnees existent
if(
    !empty($_POST['id']) &&
	!empty($_POST['nom']) &&
	!empty($_POST['sexe']) &&
    !empty($_POST['prixDepart'])

){

    // valorisation de l'objet cheval avec les donnes postees
    $cheval->id = $_POST['id'];
    $cheval->nom = $_POST['nom'];
    $cheval->sexe = $_POST['sexe'];
    $cheval->prixDepart = $_POST['prixDepart'];

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
