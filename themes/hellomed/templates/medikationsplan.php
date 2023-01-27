<?php /* Template Name: Medikationsplan */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>


<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

<!-- and show  sidebar  -->
<?php include_once('sidebar.php'); ?>

<!-- here is the content of the Medikationsplan page  -->
<div class="content">
    <div class="h2 mb-5 border-bottom">Medikationsplan</div>
    <div class="medplan-tabs"></div>
  </div>
</div>

<script src="https://ui.hellomed.com/src/v1.0/js/lodash.min.js"></script>
<!-- child directory folder, assets/js  -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/os-medications.js"></script>

<!-- that's a dump of the json file for testing -->
 <?php
$json = file_get_contents('weekly_plan.json');
$json_data = json_decode($json, true);
 print_r($json_data);
 ?>

<?php }
else { ?>
<!-- or show the message and redirect if the user is ooout  -->
    <div class="container">
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Du bist nicht eingeloggt!</h4>
                <p>Bitte logge dich ein, um diese Seite zu sehen.</p>
                <hr>
                <p class="mb-0">Du wirst in 10 Sekunden weitergeleitet.</p>
            </div>
        </div>
    </div>
</div>
<?php header("Refresh:0; url=/anmelden"); 
} ?>

<!-- da footer  -->
<?php
include_once('footer.php');
?>
