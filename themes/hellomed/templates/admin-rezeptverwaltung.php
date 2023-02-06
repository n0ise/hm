<?php /* Template Name: Admin Rezeptverwaltung */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>

<?php

// get all users with role client
$users = get_users( array( 'role' => 'client' ) );

//  var_dump ($);
// }

?>

<main>
    <div class="container">
        <div class="hm-content">
            <div class="h2 mb-5">Rezeptverwaltung</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Rezept ID</th>
                        <th>User E-Mail</th>
                        <th>Arzt</th>
                        <th>Datum der<br>Verschreibung</th>
                        <th>Medikamente</th>
                        <th>Status</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                     foreach ($users as $user) {
                        $user_id =  get_field( 'new_user_id', 'user_' . $user->ID );
                        $user_name = $user->display_name;
                        $email = $user->user_email; 
                        $user_status = get_field('status', 'user_' . $user->ID);
                        $user_rezept = get_field('rezept_input', 'user_' . $user->ID);
                        $prescription_date_by_doctor = get_field('prescription_doctor_by_name', 'user_' . $user->ID);
                        $prescription_status = get_field('prescription_status', 'user_' . $user->ID);
                    

                        // loop through each rezept_file
                        foreach ($user_rezept as $rezept) {
                            $displayed = false;
                            $date_doctor = $rezept['prescription_date_by_doctor'];
                            $name_doctor = $rezept['doctor_name'];
                            if  (empty($name_doctor)) {
                                $name_doctor = "Not set";
                            } 
                        if (empty($date_doctor) || $date_doctor == 0) {
                        $formatted_date_doctor = "Not set";
                        } else {
                        $formatted_date_doctor = date("d.m.Y", strtotime($date_doctor));
                        }
                            foreach ($rezept['rezept_file'] as $rezept_file) {
                              if (isset($rezept_file['rezept_type']) && strtolower($rezept_file['rezept_type']) != 'medplan') {
                                if (!$displayed) {
                                  // showing the first row 
                                  $displayed = true;
                                } else {
                                  break;
                                }?>
                    <tr>
                        <td data-label="Rezept ID"><?php echo $rezept['prescription_id']; ?></td>
                        <td data-label="User E-Mail"><?php echo $email; ?></td>
                        <td data-label="Arzt"><?php echo $name_doctor; ?></td>
                        <td data-label="Datum der Verschreibung"><?php echo $formatted_date_doctor; ?></td>
                        <td data-label="Medikamente"><?php 
                                        if (!empty($rezept['medicine_section'])) {
                                            foreach ($rezept['medicine_section'] as $medicine) {
                                                //  the medicine fields show but removing the latest elements if it's the latest (fuck that was tricky)
                                                echo $medicine['medicine_name_pzn'] . " (x".$medicine['medicine_amount']. ")" . (end($rezept['medicine_section']) == $medicine ? '' : ', ');
                                            }
                                        }
                                        ?>
                        </td>
                        <td data-label="Status">
                            <span
                                class="badge rounded-pill text-bg-<?php echo strtolower($rezept['status_prescription']);?> "><?php echo $rezept['status_prescription']; ?></span>
                        </td>
                        <td data-label="Aktionen">
                            <a
                                href="admin-rezeptverwaltung-edit?user_id=<?php echo $user->ID; ?>&rezept=<?php echo $rezept['prescription_id']; ?>">
                                <i class="bi bi-pencil-fill"></i> Editieren</a>
                        </td>
                    </tr>
                    <?php           
                                }
                            }
                        }
                    }
                    
            ?>

                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-4 offset-4">
                    <a class="btn btn-primary btn-lg" href="admin-neu-rezeptverwaltung">Neues Rezept anlegen</a>
                </div>
            </div>

        </div>
    </div>
</main>


<?php } 
else { ?>
<!-- here if the user is not logged in, going raaaus  -->
<?php header("url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>