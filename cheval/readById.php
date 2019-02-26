<?php
header("Access-Control-Allow-Headers: content-type");
header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/x-www-form-urlencoded");


include_once '../config/database.php';
include_once '../model/cheval.php';

$database = new Database();
$db = $database->getConnection();

$cheval = new Cheval($db);

// valorise l id passe en parametre de l url
$cheval->id = isset($_GET['id']) ? $_GET['id'] : die();


$cheval->getChevalById();

if($cheval->nom!=null){

    $cheval_arr = array(
        "id" =>  $cheval->id,
        "nom" => $cheval->nom,
        "sexe" => $cheval->sexe,
        "prixDepart" => $cheval->prixDepart,


    );

    http_response_code(200);
    echo json_encode($cheval_arr);
}
