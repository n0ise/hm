<?php
/*
Template Name: OS Medikationsplan
*/
?>
<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); 

// TODO - Check if the user is logged in and various conditions
// taking the current id of the user and passing it to the api.php file
$user_id = get_current_user_id();
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
    data: { id:<?php echo $new_user_id; ?> },  // Fix the syntax error here
    success: function(response) {
      // Set the response from api.php to the apiResponse variable
      apiResponse = response;
      console.log(apiResponse);

      // Include the medikation.js file
      var script = document.createElement("script");
      script.src = "<?php echo get_stylesheet_directory_uri() . '/assets/js/medication.js'; ?>";
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
                <img src="wp-content/themes/hellomed/assets/img/icons/onboarding/packaging.svg">
            </div>
            <div class="hm-medplan-tabs mb-5">
                <div class="hm-medplan-tabs-left is-inactive">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <div class="hm-medplan-tabs-right">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>

        </div>


    </div>
    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Demo Modal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Enim quas, tenetur veritatis
                    architecto
                    quia ea impedit voluptas nisi eos, neque minus accusamus nobis odio obcaecati voluptatum porro
                    dolorum soluta iure.
                </div>
            </div>
        </div>
    </div>
</main>
<?php
 

// da footer 
include_once('footer.php');
?>