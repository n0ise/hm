<?php
/*
Template Name: OS Rezepte
*/
?>
<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>
<?php
// get logged in user id 
$user_id = get_current_user_id();

// get all acf repeater rezepte_file for $user_id
$rezepte_file = get_field('rezept_input', 'user_' .$user_id);
// var_dump($rezepte_file);

?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">
                Rezepte
                <img src="https://ui.hellomed.com/src/v1.0/img/icons/onboarding/prescription2.svg">
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rezept ID</th>
                        <th>Arzt</th>
                        <th>Verschreibungsdatum</th>
                        <th>Enthaltene Medikamente</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

            foreach ($rezepte_file as $rezept) {
            //    var_dump($rezept);
?>
                    <tr>
                        <td data-label="Rezept ID"><?php echo $rezept['prescription_id']; ?></td>
                        <td data-label="Arzt"><?php echo $rezept['doctor_name']; ?></td>
                        <td data-label="Verschreibungsdatum"><?php echo $rezept['prescription_date_by_doctor']; ?></td>
                        <td data-label="Enthaltene Medikamente">
                            <!-- show the medicine_section -->
                            <?php
                 if (!empty($rezept['medicine_section'])) {
                    foreach ($rezept['medicine_section'] as $medicine) {
                        //  the medicine fields show but removing the latest elements if it's the latest (fuck that was tricky)
                        echo $medicine['medicine_name_pzn'] . " (x".$medicine['medicine_amount']. ")" . (end($rezept['medicine_section']) == $medicine ? '' : ', ');
                    }
                }
                ?>
                        </td>
                        <td data-label="Status"><span
                                class="badge rounded-pill text-bg-<?php echo strtolower($rezept['status_prescription']); ?>"><?php echo $rezept['status_prescription']; ?></span>
                        </td>
                    </tr>
                    <?php
            }
               ?>

                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-12 col-md-4 offset-md-4">
                    <div class="btn btn-primary btn-lg modalopen">Rezept
                        herunterladen</div>

                     <div class="modal fade bd-rezept-modal-lg" tabindex="-1" role="dialog" aria-labelledby="RezeptModal"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12 col md-6">
                                            <div class="mb-3">
                                                <label for="startdatum_neues_rezept" class="form-label">Startdatum neues
                                                    Rezept</label>
                                                <input type="text" class="form-control" id="startdatum_neues_rezept"
                                                    placeholder="">
                                            </div>
                                            <div class="mb-3">
                                                <label for="rezept_hochladen" class="form-label">Rezept
                                                    hochladen</label>
                                                <input type="file" class="form-control" id="rezept_hochladen"
                                                    placeholder="Arzt">
                                            </div>

                                            <a class="btn btn-primary btn-lg"
                                                href="mailto:patient@hellomed.com?subject=Neues Folgerezept - Folgerezept für meine Blister&amp;body=Sehr geehrte Damen und Herren, im Anhang dieser E-Mail finden Sie mein Folgerezept mit Bitte um Bearbeitung. Beste Grüße">Folgerezept
                                                einreichen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal -->
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
    <!-- modal click to open, added in Iteration 2 -->
    <!-- <script>
    jQuery(document).ready(function($) {
        $('.modalopen').click(function() {
            $('.bd-rezept-modal-lg').modal('show');
        });
    });
    </script> -->