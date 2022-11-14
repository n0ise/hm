<?php /* Template Name: Medikationsplan */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>
<!-- and sidebar  -->
<?php include_once('sidebar.php'); ?>

<!-- here is the content of the profile page  -->
<form action="" method="post">
<style>

.form-floating>.form-control {
    height:70px !important;
}
</style>
<div class="content">
    <div class="h2 mb-5 border-bottom">Medikationsplan</div>
    <div class="medplan-tabs"></div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>
<!-- child directory folder, assets/js  -->
<script src="<?php echo get_stylesheet_directory_uri(); ?>/assets/js/os-medications.js"></script>

<!-- that's a dump of the json file for testing -->
 <?php
$json = file_get_contents('weekly_plan.json');
$json_data = json_decode($json, true);
 print_r($json_data);
 ?>
<!-- da footer  -->
<?php
include_once('footer.php');
?>
