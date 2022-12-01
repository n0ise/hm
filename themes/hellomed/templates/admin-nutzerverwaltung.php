<?php /* Template Name: Admin Nutzerverwaltung  */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- if logged in  -->
<?php if(is_user_logged_in()) { ?>
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
      echo $status;
          $status = $_GET['status'];
          // $users = get_users(array('role' => 'client', 'meta_key' => 'status', 'meta_value' => $status));
          // take all fields for roles client 
          $args = array(
              'role' => 'client',
              'orderby' => 'user_status',
              'order' => 'ASC'
          );
          $users = get_users($args);

          
          foreach ($users as $user) {
// var_dump($user);
        $user_id = $user->new_user_id;
        $user_name = $user->display_name;
        $patient_caregiver = get_field('patient_caregiver', 'user_' . $user->ID);
        $user_firstname = $user->first_name;
        $user_lastname = $user->last_name;
        $user_status = get_field('status', 'user_' . $user->ID);
        $date = get_field('geburt', 'user_' . $user->ID); ?>



                    <tr>
                        <td><?php echo $user_id; ?></td>
                        <td><?php  if ($patient_caregiver == 'Caregiver') {
            $user_firstname = $user->first_name;
            $user_lastname = $user->last_name . "<br><span class=small>Caregiver: ".get_field('caregiver_nachname', 'user_' . $user->ID).' '. get_field('caregiver_vorname', 'user_' . $user->ID). "</span>"; }   echo $user->first_name. " ".$user->last_name; ?>
                        </td>
                        <td><?php  echo $date; ?></td>
                        <td><?php echo $user->user_email; ?></td>
                        <td><?php echo $user->telephone; ?></td>
                        <td><span
                                class="badge rounded-pill text-bg-<?php echo  $user->status; ?>"><?php echo $user->status; ?></span>
                        </td>
                        <td><a href="admin-nutzerverwaltung-edit?user_id=<?php echo $user->ID; ?>"><i class="bi bi-pencil-fill"></i> Editieren</a>
                        </td>
                    </tr>
                    <?php } } ?>
                </tbody>
            </table>
            <div class="row mt-5">
                <div class="col-4 offset-4">
                    <a class="btn btn-primary btn-lg" href="admin-nutzerverwaltung-edit.html">Neuen Nutzer anlegen</a>
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