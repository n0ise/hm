<?php /* Template Name: Admin Nutzerverwaltung  */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- if logged in  -->
<?php if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Nutzerverwaltung</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>(Blister) Nutzer ID</th>
                        <th>Name</th>
                        <th class="sort-geburtsdatum"><a href="#"><i class="bi bi-sort-numeric-up sort-icon"></i></a>
                            Geburts-<br>datum
                        </th>
                        <th>E-Mail</th>
                        <th>Telefon</th>
                        <th>Berechtigungen</th>
                        <th class="sort-registrierungsdatum"> <a href="#"><i
                                    class="bi bi-sort-numeric-up sort-icon"></i></a>
                            Datum der<br>Registrierung
                        </th>
                        <th>Status</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
$status="Alle";
    if (isset($_GET['status'])) {
          $status = $_GET['status'];
        //   sort by status 
            if ($status == "Alle") {
                $users = get_users(array('role' => 'client'));
            } else {
                $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));
            }
            ?>

                    <!--  add 3 buttons to filter by status -->
                    <small>Filter by &nbsp; </small>
                    <a href="admin-nutzerverwaltung?status=Alle"> <button type="button"
                            class="btn btn-primary btn-sm">Alle</button></a>
                    <a href="admin-nutzerverwaltung?status=Aktiv"> <button type="button"
                            class="btn btn-success btn-sm">Aktiv</button>
                        <a href="admin-nutzerverwaltung?status=Wartend"> <button type="button"
                                class="btn btn-warning btn-sm">Wartend</button>
                            <a href="admin-nutzerverwaltung?status=Inaktiv"> <button type="button"
                                    class="btn btn-secondary btn-sm">Inaktiv</button>

                                <?php
        foreach ($users as $user) {
        $user_confimed = get_field('has_completed_onboarding', 'user_' . $user->ID);
            if ($user_confimed == 1){
                // var_dump($user);
                $user_id = $user->new_user_id;
                $user_name = $user->display_name;
                $patient_caregiver = get_field('patient_caregiver', 'user_' . $user->ID);
                $user_firstname = get_field('patient_first_name', 'user_' . $user->ID);
                $user_lastname = get_field('patient_last_name', 'user_' . $user->ID);
                $user_status = get_field('status', 'user_' . $user->ID);
                $date = get_field('geburt', 'user_' . $user->ID); 
                $formatted_date = date("d.m.Y", strtotime($date));
                // registration date from WP 
                $registration_date = $user->user_registered;
                // removed time, and output to dd.mm.yyyy 
                $formatted_registration_date = date('d.m.Y', strtotime($registration_date));
                // 4 checkboxes
                $agb_checkbox = get_field('agb_checkbox', 'user_' . $user->ID);
                $newsletter_checkbox = get_field('newsletter_checkbox', 'user_' . $user->ID);
                $reminder_checkbox = get_field('reminder_checkbox', 'user_' . $user->ID);
                $personal_data_checkbox = get_field('personal_data_checkbox', 'user_' . $user->ID);



        ?>
                                <tr>
                                    <td data-label="(Blister) Nutzer ID"><?php echo $user_id; ?></td>
                                    <td data-label="Name"><?php 
                            if ($patient_caregiver == 'caregiver') {
                               echo "<div class=row>
                               <div class=col-sm-12>".$user_firstname. " ".$user_lastname; echo "<div class=row>
                               <div class=col-sm-12><span class=small>Caregiver: ".$user->user_firstname.' '.$user->user_lastname. "</span> </div>
                               </div>"; 
                            } else {
                             echo $user->first_name. " ".$user->last_name; 
                            } 
                            ?>
                                    </td>
                                    <td data-label="Geburtsdatum"><?php  echo $formatted_date; ?></td>
                                    <td data-label="E-Mail"><?php echo $user->user_email; ?></td>
                                    <td data-label="Telefon"><?php echo $user->telephone; ?></td>
                                    <td data-label="Berechtigungen">
                                        <span
                                            class="consent-badge <?php echo ($agb_checkbox) ? 'is-checked' : 'is-unchecked'; ?>"><i
                                                class="bi <?php echo ($agb_checkbox) ? 'bi-check-circle-fill' : 'bi-check-circle'; ?>"></i>
                                            AGB und Datenschutz</span>
                                        <span
                                            class="consent-badge <?php echo ($personal_data_checkbox) ? 'is-checked' : 'is-unchecked'; ?>"><i
                                                class="bi <?php echo ($personal_data_checkbox) ? 'bi-check-circle-fill' : 'bi-check-circle'; ?>"></i>
                                            Führung Kundenkonto</span>
                                        <span
                                            class="consent-badge <?php echo ($reminder_checkbox) ? 'is-checked' : 'is-unchecked'; ?>"><i
                                                class="bi <?php echo ($reminder_checkbox) ? 'bi-check-circle-fill' : 'bi-check-circle'; ?>"></i>
                                            Erinnerungs-E-Mails</span>
                                        <span
                                            class="consent-badge <?php echo ($newsletter_checkbox) ? 'is-checked' : 'is-unchecked'; ?>"><i
                                                class="bi <?php echo ($newsletter_checkbox) ? 'bi-check-circle-fill' : 'bi-check-circle'; ?>"></i>
                                            News und Angebote</span>
                                    </td>

                                    <td data-label="Registrierungsdatum"><?php echo $formatted_registration_date; ?>
                                    </td>

                                    <td data-label="Status"><span
                                            class="badge rounded-pill text-bg-<?php echo  strtolower($user->status); ?>"><?php echo $user->status; ?></span>
                                    </td>
                                    <td data-label="Aktionen">
                                        <a href="admin-nutzerverwaltung-edit?user_id=<?php echo $user->ID; ?>"><i
                                                class="bi bi-pencil-fill"></i> Editieren</a>
                                        <!-- <a href><i class="bi bi-trash2-fill"></i> Löschen</a> -->
                                    </td>
                                </tr>
                                <?php 
            } 
        }
    }   ?>
                </tbody>
            </table>
            <!-- <div class="row mt-5">
                <div class="col-4 offset-4">
                    <a class="btn btn-primary btn-lg" href="admin-nutzerverwaltung-edit.php">Neuen Nutzer anlegen</a>
                </div>
            </div> -->

        </div>
    </div>
</main>
<!-- js bits for the sorting toggle in the table  -->
<script>
$(document).ready(function() {
    // this part will add a pointer cursor  
    const sortIcon = document.querySelector('.sort-icon');
    $(this).css('cursor', 'pointer');
    let table = $('table');

    sortIcon.addEventListener('click', function() {
        // let table = document.querySelector('table');
        if (sortIcon.classList.contains('bi-sort-numeric-up')) {
            sortTable(table, 'desc');
            sortIcon.classList.remove('bi-sort-numeric-up');
        }
    })

    // this will makle upsidedown the icon on toggle 
    $('th i').click(function() {
        $(this).toggleClass('active');
        let table = $('table');
        let columnIndex = $(this).closest('th').index();
        if ($(this).hasClass('active')) {
            $(this).removeClass('bi-sort-numeric-up').addClass('bi-sort-numeric-down');
            sortTable(table, 'desc', columnIndex);
        } else {
            $(this).removeClass('bi-sort-numeric-down').addClass('bi-sort-numeric-up');
            sortTable(table, 'asc', columnIndex);
        }
    });

    // the sorting magic
    function sortTable(table, order, columnIndex) {
        let rows, switching, i, x, y, shouldSwitch;
        switching = true;
        while (switching) {
            switching = false;
            rows = table.find('tr');
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                let dateStr = $(rows[i]).find('td').eq(columnIndex).text();
                if (columnIndex === 2) {
                    let sortableDate = convertDateToSortable(dateStr);
                    x = sortableDate;
                    y = convertDateToSortable($(rows[i + 1]).find('td').eq(columnIndex).text());
                } else {
                    x = $(rows[i]).find('td').eq(columnIndex).text();
                    y = $(rows[i + 1]).find('td').eq(columnIndex).text();
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
        if (columnIndex === 2) {
            let dateCells = $('td[data-label="Geburtsdatum"]');
            dateCells.each(function() {
                let dateValue = $(this).text();
                let formattedDate = convertDateToDisplay(dateValue);
                $(this).text(formattedDate);
            });
        }
    }


    // Convert a date string in 'dd.mm.yyyy' format to 'yyyy-mm-dd' format
    function convertDateToSortable(dateString) {
        let [day, month, year] = dateString.split('.');
        if (!day || !month || !year) {
            return null;
        }
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

})
</script>
<?php 
} 
else { ?>
<!-- here if the user is not logged in, going raaaus  -->
<?php header("url=/anmelden"); 
    }

// da footer 
include_once('footer.php');
?>