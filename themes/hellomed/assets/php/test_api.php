<?php
$test_api = json_decode(file_get_contents('../json/test_api.json'), true);
$client_id= $test_api['client_id'];
$client_secret = $test_api['client_secret'];
$token_url = "https://api.blisterwuerfel.de/ext-api/token";
$token_data = array(
    "grant_type" => "client_credentials",
    "client_id" => $client_id,
    "client_secret" => $client_secret
);
$token_data_string = json_encode($token_data);
$token_headers = array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($token_data_string)
);
$token_ch = curl_init();
curl_setopt($token_ch, CURLOPT_URL, $token_url);
curl_setopt($token_ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($token_ch, CURLOPT_POSTFIELDS, $token_data_string);
curl_setopt($token_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($token_ch, CURLOPT_HTTPHEADER, $token_headers);
$token_result = curl_exec($token_ch);
$token_result = json_decode($token_result, true);
$token = $token_result['access_token'];

// $patient_url = "https://api.blisterwuerfel.de/ext-api/patient/".$id_new."/2023-01-19";

$date = date("Y-m-d");
$currentDay = date("w", strtotime($date));
// calculating monday based on the current day's week 
$monday = date("Y-m-d", strtotime("-".($currentDay-1)." days", strtotime($date)));
// taking id from POST request in /medikationsplan.php, so it will grab API based on the user 
$id_new= $_POST['id'];
// $id_new = "347427";
$patient_url = "https://api.blisterwuerfel.de/ext-api/patient/".$id_new."/".$monday;

$patient_headers = array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
);
$patient_ch = curl_init();
curl_setopt($patient_ch, CURLOPT_URL, $patient_url);
curl_setopt($patient_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($patient_ch, CURLOPT_HTTPHEADER, $patient_headers);
$patient_result = curl_exec($patient_ch);



$patient_result = json_decode($patient_result, true);

// this is going down a level, in the output, 
echo json_encode($patient_result['medications']);
?>