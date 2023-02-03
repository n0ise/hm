<?php

function sendDataToZoho($formData, $accessToken) {

    $url = 'https://www.zohoapis.eu/crm/v3/Leads';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Authorization: Zoho-oauthtoken " . $accessToken,
        "Content-Type: application/json"
    ));
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formData));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $responseData = json_decode($response, true);
    // if ($responseData["code"] === "SUCCESS") {
    // } else {
    //     var_dump($responseData);
    //     die;
    // }
    curl_close($curl);
}

function updateDataToZoho($formData, $accessToken) {

    $url = 'https://www.zohoapis.eu/crm/v3/Leads/upsert';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        "Authorization: Zoho-oauthtoken " . $accessToken,
        "Content-Type: application/json"
    ));
    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($formData));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    $responseData = json_decode($response, true);
    // if ($responseData["code"] === "SUCCESS") {
    // } else {
    //     var_dump($responseData);
    //     die;
    // }
    curl_close($curl);
}
 
?>


        