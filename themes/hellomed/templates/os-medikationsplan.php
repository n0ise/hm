<?php
/*
Template Name: OS Medikationsplan
*/
?>
<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>
<?php
// current user id logged in 
$user_id = get_current_user_id();
$rezepte_file = get_field('rezept_input', 'user_'. $user_id); ?>
<main>
  <div class="container">
    <div class="hm-content">

      <div class="h2 mb-5">
        Medikationsplan
        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icons/onboarding/packaging.svg">
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
</main>
<?php
 } else { ?>
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
    <?php header("Refresh:10; url=/anmelden"); 
        }

// da footer 
include_once('footer.php');
?>