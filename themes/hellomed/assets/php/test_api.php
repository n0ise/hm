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


$patient_url = "https://api.blisterwuerfel.de/ext-api/patient/338962/2022-12-14";
$patient_headers = array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
);
$patient_ch = curl_init();
curl_setopt($patient_ch, CURLOPT_URL, $patient_url);
curl_setopt($patient_ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($patient_ch, CURLOPT_HTTPHEADER, $patient_headers);
$patient_result = curl_exec($patient_ch);


// wrap result into json object 
$patient_result = json_decode($patient_result, true);
// make it available via POST request
echo json_encode($patient_result);

?>