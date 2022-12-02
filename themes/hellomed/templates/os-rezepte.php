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
var_dump($rezepte_file);

?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">
                Rezepte
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/icons/onboarding/prescription2.svg">
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
                        <td><?php echo $rezept['rezept_file']['ID']; ?></td>
                        <td><?php echo $rezept['doctor_name']; ?></td>
                        <td><?php echo $rezept['prescription_date_by_doctor']; ?></td>
                        <td>
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
                        <td><span class="badge rounded-pill text-bg-<?php echo $rezept['status_prescription']; ?>"><?php echo $rezept['status_prescription']; ?></span></td>
                    </tr>
                    <?php
            }
               ?>

                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-12 col-md-4 offset-md-4">
                    <!--// TODO here putting data from user TBD -->
                    <a class="btn btn-primary btn-lg"
                        href="mailto:patient@hellomed.com?subject=Neues Folgerezept - Folgerezept für meine Blister&amp;body=Sehr geehrte Damen und Herren, im Anhang dieser E-Mail finden Sie mein Folgerezept mit Bitte um Bearbeitung. Beste Grüße">Folgerezept
                        einreichen</a>
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