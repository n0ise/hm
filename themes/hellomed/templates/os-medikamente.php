<?php
/*
Template Name: OS Medikamente
*/
$user_id = get_current_user_id();
// if user is not logged in, go to anmelden 
// if is not having account active, can't see page and go to willkommen  
ob_start();
if (!is_user_logged_in() || get_field('status', 'user_' . $user_id) != 'Aktiv') {
    $redirect_url = is_user_logged_in() ? 'willkommen' : 'anmelden';
    header("Location: $redirect_url");
    exit;
}
// include_once header.php from template  
 include_once('os-header.php'); 
 
// current user id logged in 
$rezepte_file = get_field('rezept_input', 'user_'. $user_id); ?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">
                Medikamente
                <img src="https://ui.hellomed.com/src/v1.0/img/icons/onboarding/otc.svg">
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Enthalten in Rezept ID</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

            foreach ($rezepte_file as $rezept) {
            //    var_dump($rezept);

if (!empty($rezept['medicine_section'])) {
    foreach ($rezept['medicine_section'] as $medicine) {
        //  explode the medicines  and stack them one item per row 🤯
        // var_dump($rezept);
        $medicine_name_pzn = explode(',', $medicine['medicine_name_pzn']);
        foreach ($medicine_name_pzn as $item) {
      ?>

                    <tr>
                        <td data-label="Name"><?php echo $item; ?></td>
                        <td data-label="ID"><?php echo $rezept['prescription_id']; ?></td>
                        <td data-label="Status"><span
                                class="badge rounded-pill text-bg-<?php echo strtolower($rezept['status_prescription']); ?>">
                                <?php echo $rezept['status_prescription']; ?></span></td>
                    </tr>
                    <?php
                            }
                         }
                    }
                }
               ?>

                </tbody>
            </table>
        </div>
    </div>
</main>
<?php
 
 ob_end_flush();


// da footer 
include_once('footer.php');
?>