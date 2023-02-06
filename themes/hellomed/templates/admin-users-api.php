<?php /* Template Name: Admin Users API  */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- if logged in  -->
<?php if(is_user_logged_in() && current_user_can('administrator')) { 

$credentials_api = json_decode(file_get_contents('wp-content/themes/hellomed/assets/json/test_api.json'), true);
$client_id= $credentials_api['client_id'];
$client_secret = $credentials_api['client_secret'];
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
// echo $token;

$today = date("Y-m-d");
// parse the friggin' data
$patient_url = "https://api.blisterwuerfel.de/ext-api/activated-users/".$today;
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
// show every field of the result in a bootstrap table, with title and value of the array
// echo '<table class="table table-striped table-hover">';
// dump result in a formatted way 
// echo '<pre>';

// print_r($patient_result);
// echo '</pre>';
// echo '</table>';

// echo json_encode($patient_result);
?>
<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Aktive Benutzerliste (API)</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>(Blister) User ID</th>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>E-Mail</th>
                        <th>Status</th>
                        <th>Apotheken-ID</th>
                        <th>Erstellungsdatum</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <?php
                    foreach ($patient_result as $patient) {
                        // var_dump($patient);
                        $user_id = $patient['extId'];
                        $user_email = $patient['email'];
                        $patient_pharmacy = $patient['pharmacyId'];
                        $user_firstname = $patient['firstname'];
                        $user_lastname = $patient['lastname'];
                        $user_status = $patient['active'];
                        $date = $patient['createdAt']; 
                        ?>
                <tr>
                    <td data-label="(Blister) User ID"><?php echo $user_id; ?></td>
                    <td data-label="Name"><?php echo $user_firstname; ?></td>
                    <td data-label="Surname"><?php echo $user_lastname; ?></td>
                    <td data-label="Email"><?php echo $user_email; ?></td>
                    <td data-label="Status"><?php echo $user_status; ?></td>
                    <td data-label="Pharmacy ID"><?php echo $patient_pharmacy; ?></td>
                    <td data-label="Creation Date"><?php echo $date; ?></td>

                </tr>
                </tbody>
            </table>


        </div>
    </div>
</main>
<?php } }


else { ?>
<!-- here if the user is not logged in, going raaaus  -->
<?php header("url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>