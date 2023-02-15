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
                        <th data-label="Rezept ID">Rezept ID<a href="#"><i
                                    class="bi bi-sort-numeric-up sort-icon active"></i></a></th>
                        <th data-label="Nutzer E-Mail">Nutzer E-Mail <i class="fas fa-sort"></i></th>
                        <th data-label="Arzt">Arzt <i class="fas fa-sort"></i></th>
                        <th>Datum der<br>Verschreibung<a href="#"><i
                                    class="bi bi-sort-numeric-up sort-icon active"></i></a></th>
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
                                    $displayed = true;
                                } else {
                                    break;
                                }
                                ?>
                    <tr>
                        <td data-label="Rezept ID"><?php echo $rezept['prescription_id']; ?></td>
                        <td data-label="Nutzer E-Mail"><?php echo $email; ?></td>
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
<!-- js bits for the sorting toggle in the table  -->
<script>
$(document).ready(function() {
    let table = $('table');

    $('th i').click(function() {
        $(this).toggleClass('active');
        let columnIndex = $(this).closest('th').index();
        if ($(this).hasClass('active')) {
            $(this).removeClass('bi-sort-numeric-up').addClass('bi-sort-numeric-down');
            sortTable(table, 'desc', columnIndex);
        } else {
            $(this).removeClass('bi-sort-numeric-down').addClass('bi-sort-numeric-up');
            sortTable(table, 'asc', columnIndex);
        }
    });

    function sortTable(table, order, columnIndex) {
        let rows, switching, i, x, y, shouldSwitch;
        switching = true;
        while (switching) {
            switching = false;
            rows = table.find('tr');
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = $(rows[i]).find('td').eq(columnIndex).text();
                y = $(rows[i + 1]).find('td').eq(columnIndex).text();

                // Convert date strings from 'dd.mm.yyyy' to 'yyyy-mm-dd' format for sorting
                if (columnIndex === 3) {
                    x = convertDateToSortable(x);
                    y = convertDateToSortable(y);
                }

                if (order === 'asc') {
                    if (x > y) {
                        shouldSwitch = true;
                        break;
                    }
                } else if (order === 'desc') {
                    if (x < y) {
                        shouldSwitch = true;
                        break;
                    }
                }
            }

            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }

        // Convert date strings back to 'dd.mm.yyyy' format for display
        let dateCells = $('td[data-label="Datum der Verschreibung"]');
        dateCells.each(function() {
            let dateValue = $(this).text();
            let formattedDate = convertDateToDisplay(dateValue);
            $(this).text(formattedDate);
        });
    }

    // Convert a date string in 'dd.mm.yyyy' format to 'yyyy-mm-dd' format
    function convertDateToSortable(dateString) {
        let [day, month, year] = dateString.split('.');
        let sortableDate = `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}`;
        return sortableDate;
    }

    // Convert a date string in 'yyyy-mm-dd' format to 'dd.mm.yyyy' format
    function convertDateToDisplay(dateString) {
        let [year, month, day] = dateString.split('-');
        let displayDate = '';
        if (day && month && year) {
            displayDate = `${day.padStart(2, '0')}.${month.padStart(2, '0')}.${year}`;
        } else {
            displayDate = dateString;
        }
        return displayDate;
    }

});
</script>

<?php } 
else { ?>
<!-- here if the user is not logged in, going raaaus  -->
<?php header("url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>