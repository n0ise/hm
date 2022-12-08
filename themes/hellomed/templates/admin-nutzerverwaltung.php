<?php /* Template Name: Admin Nutzerverwaltung  */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- if logged in  -->
<?php if(is_user_logged_in() && current_user_can('administrator')) { ?>
<?php
// Work in progress, sort by status and show all users
// $status="All";
// if (isset($_GET['status'])) {
// echo $status;
//     $status = $_GET['status'];
//     $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));
//     foreach ($users as $user) {
// var_dump($user);
//         $user_id = $user->new_user_id;
//         $user_name = $user->display_name;
//         $patient_caregiver = get_field('patient_caregiver', 'user_' . $user->ID);
//         $user_firstname = $user->first_name;
//         $user_lastname = $user->last_name;
//         $user_status = get_field('status', 'user_' . $user->ID);
        // echo '<tr>';
        // echo '<th scope="row">' . $user_id .  $status.
        // '</th>';
        // echo '<td>' . $user_name . '</td>';
        // echo '<td>' . $user_status . '</td>';
        // echo '<td><a href="/edit-test?user_id=' . $user->ID . '" class="btn btn-primary">Bearbeiten</a></td>';
//         // echo '</tr>';
//     }
// }
?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Nutzerverwaltung</div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Geburtsdatum</th>
                        <th>E-Mail</th>
                        <th>Telefon</th>
                        <th>Status</th>
                        <th>Aktionen</th>
                    </tr>
                </thead>
                <tbody>
            <?php 
      $status="All";
      if (isset($_GET['status'])) {
          $status = $_GET['status'];
        //   sort by status 
            if ($status == "Alle") {
                $users = get_users(array('role' => 'client'));
            } else {
                $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));
            }
          // $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));
            // $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));

         
        //   $users = get_users($args);
// add 3 buttons to filter by status
?>
<small>Filter by &nbsp; </small>
<a href="admin-nutzerverwaltung?status=Alle"> <button type="button" class="btn btn-primary">Alle</button></a>
<a href="admin-nutzerverwaltung?status=Aktiv"> <button type="button" class="btn btn-success">Aktiv</button>
<a href="admin-nutzerverwaltung?status=Wartend"> <button type="button" class="btn btn-warning">Wartend</button>
<a href="admin-nutzerverwaltung?status=Inaktiv"> <button type="button" class="btn btn-secondary" >Inaktiv</button>
<a href="admin-nutzerverwaltung?status=Gefähred"> <button type="button" class="btn btn-danger">Gefähred</button>

<?php
        foreach ($users as $user) {
        $user_confimed = get_field('confirmed_or_not', 'user_' . $user->ID);
        if ($user_confimed == 1){
// var_dump($user);
        $user_id = $user->new_user_id;
        $user_name = $user->display_name;
        $patient_caregiver = get_field('patient_caregiver', 'user_' . $user->ID);
        $user_firstname = $user->first_name;
        $user_lastname = $user->last_name;
        $user_status = get_field('status', 'user_' . $user->ID);
        $date = get_field('geburt', 'user_' . $user->ID); 
        ?>
                    <tr>
                        <td data-label="User ID" ><?php echo $user_id; ?></td>
                        <td data-label="Name" ><?php 
                        if ($patient_caregiver == 'caregiver') {
                     echo get_field('patient_first_name', 'user_' . $user->ID). " ". get_field('patient_last_name', 'user_' . $user->ID);
                     echo "<br><span class=small>Caregiver: ".$user->first_name.' '.$user->last_name. "</span><br>"; 
                    }  
                    else{
                     echo $user->first_name. " ".$user->last_name; 
                        }?>
                        </td>
                        <td data-label="Geburtsdatum" ><?php  echo $date; ?></td>
                        <td data-label="E-Mail" ><?php echo $user->user_email; ?></td>
                        <td data-label="Telefon" ><?php echo $user->telephone; ?></td>
                        <td  data-label="Status" ><span class="badge rounded-pill text-bg-<?php echo  $user->status; ?>"><?php echo $user->status; ?></span>
                        </td>
                        <td data-label="Aktionen"><a href="admin-nutzerverwaltung-edit?user_id=<?php echo $user->ID; ?>"><i class="bi bi-pencil-fill"></i> Editieren</a>
                        </td>
                    </tr>
                    <?php } }
                } ?>
                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-4 offset-4">
                    <a class="btn btn-primary btn-lg" href="admin-nutzerverwaltung-edit.php">Neuen Nutzer anlegen</a>
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