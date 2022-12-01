<?php /* Template Name: Admin Rezeptverwaltung s  */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>


<?php

// get all users with role client
$args = array(
    'role' => 'client',
    'orderby' => 'user_status',
    'order' => 'ASC'
);
$users = get_users($args);
// var_dump($users);
?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Rezeptverwaltung</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rezept ID</th>
                        <th>Arzt</th>
                        <th>Verschreibungsdatum</th>
                        <th>Medikamente</th>
                        <th>Status</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                      foreach ($users as $user) {
                        $user_id = $user->new_user_id;
                        $user_name = $user->display_name;
                        $user_status = get_field('status', 'user_' . $user->ID);
                        $user_rezept = get_field('rezept_input', 'user_' . $user->ID);
                        $prescription_date_by_doctor = get_field('prescription_doctor_by_name', 'user_' . $user->ID);
                        $prescription_status = get_field('prescription_status', 'user_' . $user->ID);
                        
                        // if user_rezept is not empty
                        if (!empty($user_rezept)) {
                            foreach ($user_rezept as $rezept) {
                                
                        //    var_dump($rezept);
                  ?>
                    <tr>
                        <td>
                            <?php echo $rezept['prescription_id']; ?></td>
                        <td><?php echo $rezept['doctor_name']; ?></td>
                        <td><?php echo$rezept['prescription_date_by_doctor']; ?></td>
                        <td><?php 
                        if (!empty($rezept['medicine_section'])) {
                            foreach ($rezept['medicine_section'] as $medicine) {
                                //  the medicine fields show but removing the latest elements if it's the latest (fuck that was tricky)
                                echo $medicine['medicine_name_pzn'] . " (x".$medicine['medicine_amount']. ")" . (end($rezept['medicine_section']) == $medicine ? '' : ', ');
                            }
                        }
                        ?>
                        </td>
                        <td><span
                                class="badge rounded-pill text-bg-<?php echo $rezept['status_prescription'];?> "><?php echo $rezept['status_prescription']; ?></span>
                        </td>
                        <td><a href="admin-rezeptverwaltung-edit?user_id=<?php echo $user->ID; ?>&rezept=<?php echo $rezept['prescription_id']; ?>"><i
                                    class="bi bi-pencil-fill"></i> Editieren</a></td>
                    </tr>

                    <?php           
                     }
                        }
                    }
            ?>

                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-4 offset-4">
                    <a class="btn btn-primary btn-lg" href="admin-rezeptverwaltung-edit?new=1">Neues Rezept anlegen</a>
                </div>
            </div>

        </div>
    </div>
</main>


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
    <?php header("Refresh:10; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>