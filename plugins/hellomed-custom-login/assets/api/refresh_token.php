<?php

function refreshAccessToken() {

if (!get_field("access_token", "option") || !get_field("token_expiry", "option")) {
    if (function_exists("acf_add_local_field_group")) {
        acf_add_local_field_group(array(
            "key" => "group_access_token",
            "title" => "Access Token",
            "fields" => array(
                array(
                    "key" => "field_access_token",
                    "label" => "Access Token",
                    "name" => "access_token",
                    "type" => "text",
                ),
                array(
                    "key" => "field_token_expiry",
                    "label" => "Token Expiry",
                    "name" => "token_expiry",
                    "type" => "number",
                ),
            ),
            "location" => array(
                array(
                    array(
                        "param" => "options_page",
                        "operator" => "==",
                        "value" => "acf-options-access-token",
                    ),
                ),
            ),
            "menu_order" => 0,
            "position" => "normal",
            "style" => "default",
            "label_placement" => "top",
            "instruction_placement" => "label",
            "hide_on_screen" => "",
            "active" => true,
            "description" => "",
        ));
    }
}

$accessToken = get_field("access_token", "option");
$tokenExpiry = get_field("token_expiry", "option");

if (!$accessToken || !$tokenExpiry || time() > $tokenExpiry) {
    $clientId = "1000.WETO8P08DO3SNZ6Z8IIXKHLVQAYEOX";
    $clientSecret = "3e00f78a332c6723eceb0cf3d065cf7fc9b1be9d41";
    $refreshToken = "1000.2a45c7fa6f9a8ffc5f48d40d27fc8806.4233d651cf95cf8b2bd20939b4c624fc";

    $data = array(
        "grant_type" => "refresh_token",
        "client_id" => $clientId,
        "client_secret" => $clientSecret,
        "refresh_token" => $refreshToken
    );

    $curl = curl_init("https://accounts.zoho.eu/oauth/v2/token");
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);
    $response = json_decode($response);

        if (!empty($response->access_token) && !empty($response->expires_in)) {
            $accessToken = $response->access_token;
            $tokenExpiry = time() + $response->expires_in;

            update_field("access_token", $accessToken, "option");
            update_field("token_expiry", $tokenExpiry, "option");
            return $accessToken;
        } 
        else {
            $errorMessage = "Failed to refresh the access token.";
                if (!empty($response->error)) {
                $errorMessage .= " Error: " . $response->error;
                }
            trigger_error($errorMessage, E_USER_WARNING);
            return false;
        }
}
else {
    return $accessToken;
}
}