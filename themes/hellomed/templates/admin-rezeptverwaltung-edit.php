<?php /* Template Name: Admin Rezeptverwaltung Edit */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in() && current_user_can('administrator')) { ?>

<!-- and sidebar  -->
<div class="content">



    <?php
// taking values from parameters in the url
$user_id=$_GET['user_id']; 
$rezept_id=$_GET['rezept']; 


// take data pls
$rezept_input = get_field('rezept_input', 'user_'.$user_id);

// var_dump($rezept_input);

?>
    <main>
        <div class="container">
            <div class="hm-content">

                <div class="h2 mb-5">Rezept hinzufügen/editieren</div>
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" value="<?php echo $user_id; ?>">
                            <label>User ID</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="prescription_id" type="text" class="form-control"
                                value="<?php echo $rezept_input[0]['prescription_id']; ?>">
                            <label>Prescription ID</label>
                        </div>
                    </div>
                    <?php 
    //  if it is not empty the rezept_input
    if(!empty($rezept_input[0]['blister_job'])) {
        foreach($rezept_input[0]['blister_job'] as $blister_job) {
          
  ?>
                    <div class="col-12 col-md-6">
                        <div class="form-floating">
                            <input id="blister_job_id" type="text" class="form-control"
                                value="<?php echo $blister_job['blister_job_id'] ?>">
                            <label>Blisterjob ID <small> (data not saving for the moment)</small></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input id="blister_start_date" type="text" class="form-control"
                                value="<?php echo $blister_job['blister_start_date'] ?>">
                            <label>Start <small> (data not saving for the moment)</small></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-floating" id="blister_end_date">
                            <input id="blister_end_date" type="text" class="form-control"
                                value="<?php echo $blister_job['blister_end_date'] ?>">
                            <label>Ende <small> (data not saving for the moment)</small></label>
                        </div>
                    </div>

                    <?php       }
?>
                    <p id="here"> </p>
                    <?php  }

   ?>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-light btn-sm" id="add_blister_job">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Blisterjob
                        </button>
                    </div>

                    <script>
                    jQuery(document).ready(function() {
                        jQuery('#add_blister_job').click(function() {
                            jQuery('#here').append(
                                '<div class="col-12 col-md-6"><div class="form-floating"><input type="text" class="form-control" value=""><label>Blisterjob ID</label></div></div><div class="col-12 col-md-3"><div class="form-floating"><input type="text" class="form-control" value=""><label>Start</label></div></div><div class="col-12 col-md-3"><div class="form-floating" id="blister_end_date"><input type="text" class="form-control" value=""><label>Ende</label></div></div>'
                            );
                        });
                    });
                    </script>
                    <div class="col-12 col-md-9">
                        <div class="form-floating">
                            <input id="doctor_name" type="text" class="form-control"  value="<?php echo $rezept_input[0]['doctor_name']; ?>">
                            <label>Arzt</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input id="prescription_date_by_doctor"  type="text" class="form-control"  value="<?php echo $rezept_input[0]['prescription_date_by_doctor']; ?>">
                            <label>Verschreibungsdatum</label>
                        </div>
                    </div>
                    <?php
                if(!empty($rezept_input[0]['medicine_section'])) {
                    foreach($rezept_input[0]['medicine_section'] as $medicine) { ?>
                    <div class="col-12 col-md-9">
                        <div class="form-floating">
                            <input id="medikamente" type="text" class="form-control"
                                value="<?php echo $medicine['medicine_name_pzn']; ?>">
                            <label>Medikament <small> (data not saving for the moment)</small></label>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input id="amount" type="text" class="form-control"
                                value="<?php echo $medicine['medicine_amount']; ?> ">
                            <label>Menge <small> (data not saving for the moment)</small></label>
                        </div>
                    </div>
                    <?php
                    }
                 ?> <div id="there"></div> <?php
                }
                ?>

                    <div class="col-12 d-flex justify-content-center">
                        <button id="add_medicine_div" type="button" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Medikament
                        </button>
                    </div>
                    <script>
                    jQuery(document).ready(function() {
                        jQuery('#add_medicine_div').click(function() {
                            jQuery('#there').append(
                                '<div class="col-12 col-md-9"><div class="form-floating"><input type="text" class="form-control" value=""><label>Medikamente </label></div></div><div class="col-12 col-md-3"><div class="form-floating"><input type="text" class="form-control" value=""><label>Menge</label></div></div>'
                            );
                        });
                    });
                    </script>
                    <div class="col-12">
                        <div class="form-floating">
                            <select id="status_prescription" class="form-select">
                                <option selected><?php echo $rezept_input[0]['status_prescription'] ?> </option>
                                <option>Aktiv</option>
                                <option>Inaktiv</option>
                                <option>Wartend</option>
                                <option>Gefähred</option>
                            </select>
                            <label>Status</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button id="save_blister_job" type="button" class="btn btn-primary btn-lg">Speichern</button>
                    </div>
                    <div id="result"></div>
                </div>
                <script>
                jQuery('#save_blister_job').click(function() {
                    var blister_job_id = jQuery('#blister_job_id').val();
                    var blister_start_date = jQuery('#blister_start_date').val();
                    var blister_end_date = jQuery('#blister_end_date').val();
                    var prescription_id = jQuery('#prescription_id').val();
                    var doctor_name = jQuery('#doctor_name').val();
                    var prescription_date_by_doctor = jQuery('#prescription_date_by_doctor').val();
                    var prescription_id = jQuery('#prescription_id').val();
                    var medicine_name_pzn = jQuery('#medicine_name_pzn').val();
                    var medicine_amount = jQuery('#medicine_amount').val();
                    var status_prescription = jQuery('#status_prescription').val();
                    var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                    var data = {
                        'action': 'edit_patient',
                        'blister_job_id': blister_job_id,
                        'blister_start_date': blister_start_date,
                        'blister_end_date': blister_end_date,
                        'prescription_id': prescription_id,
                        'doctor_name': doctor_name,
                        'prescription_date_by_doctor': prescription_date_by_doctor,
                        'medicine_name_pzn': medicine_name_pzn,
                        'medicine_amount': medicine_amount,
                        'prescription_id': prescription_id,
                        'status_prescription': status_prescription,
                        'rezept_id': <?php echo $rezept_id; ?>,
                        'user_id': <?php echo $user_id; ?>
                    }
                    console.log(data);
                    $.post(ajaxurl, data, function(response) {
                        console.log(response);
                        jQuery('#result').append(
                            '<div class="alert alert-success" role="alert">Rezept erfolgreich gespeichert</div>'
                        );
                  
                                          
                    });
                });
                </script>
            </div>
        </div>
    </main>
    <?php

}
else { ?>
    <!-- or show the message and redirect if the user is ooout  -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Du bist nicht eingeloggt!</h4>
                    <p>Bitte logge dich ein, um diese Seite zu sehen.</p>
                    <hr>q
                    <p class="mb-0">Du wirst in 10 Sekunden weitergeleitet.</p>
                </div>
            </div>
        </div>
        <?php header("Refresh:10; url=/anmelden"); 
}
// da footer 
include_once('footer.php');
?>