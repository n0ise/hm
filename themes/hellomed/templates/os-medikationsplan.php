<?php
/* Template Name: OS Medikationsplan */
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
 ?>

<!--  Lodash  -->
<script src="https://ui.hellomed.com/src/v1.1/js/lodash.4.17.21.min.js"></script>

<?php
// TODO - Check if the user is logged in and various conditions
// taking the current id of the user and passing it to the api.php file
$new_user_id= get_field('new_user_id', 'user_' . $user_id);
$patient_url = get_stylesheet_directory_uri() . '/assets/php/test_api.php';
?>
<!-- Define the apiResponse variable in the global scope -->
<script>
let apiResponse = null;

// Add the AJAX script

jQuery(document).ready(function($) {
    // Send the AJAX request to api.php with the $id parameter
    $.ajax({
        url: "<?php echo $patient_url; ?>",
        type: "POST",
        data: {
            id: <?php echo $new_user_id; ?>
        }, // Fix the syntax error here
        success: function(response) {
            // Set the response from api.php to the apiResponse variable
            apiResponse = response;
            console.log(apiResponse);

            // Include the medikation.js file
            var script = document.createElement("script");
            script.src =
                "<?php echo get_stylesheet_directory_uri() . '/assets/js/medication.js'; ?>";
            document.getElementsByTagName("head")[0].appendChild(script);
        },
        error: function(error) {
            console.error(error);
        },
    });
});
</script>
<?php

$rezepte_file = get_field('rezept_input', 'user_'. $user_id); ?>
<main>
    <div class="container">
        <div class="hm-content">
            <div class="h2 mb-5">
                Medikationsplan
                <img src="https://ui.hellomed.com/src/v1.1/img/icons/onboarding/packaging.svg">
            </div>
            <!-- loading image  -->
            <div class="loading-logo">
                <img src="https://ui.hellomed.com/src/v1.1/img/logo.svg" alt="Loading logo">
            </div>
            <div class="hm-medplan-wrapper" style="display:none">

                <div class="hm-medplan-calendar">
                    <div class="hm-medplan-calendar-weeks">
                        <div class="hm-medplan-calendar-weeks-prev">
                            <i class="bi bi-chevron-left"></i>
                            <span>Vorherige</span>
                        </div>
                        <div>
                            <!-- November 2022 -->
                        </div>
                        <div class="hm-medplan-calendar-weeks-next">
                            <span>N??chste</span>
                            <i class="bi bi-chevron-right"></i>
                        </div>
                    </div>
                    <div class="hm-medplan-calendar-days"></div>
                </div>
            </div>

        </div>


    </div>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-5 pt-4">
                <div class="modal-header p-0 border-0">
                    <div class="modal-title pt-1 fs-3">Oxycodon</div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="modal-img mt-3 mb-4">
                        <img
                            src="https://images.unsplash.com/photo-1628771065518-0d82f1938462?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80">
                    </div>
                    <span class="modal-amount">Amount</span> x
                    <span class="modal-time-hint">TimeHint</span>


                </div>
            </div>
        </div>
    </div>
</main>
<?php
ob_end_flush();


// da footer 
include_once('footer.php');
?>