<?php /* Template Name: Rezeptverwaltung Admin */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in()) { ?>

<!-- and sidebar  -->
<?php include_once('sidebar_admin.php'); ?>
<div class="content">
    <div class="h2 mb-5 border-bottom">Rezeptverwaltung</div>
    <table class="table table-striped">
      <thead>
        <tr><th>Lorem</th><th>Lorem</th><th>Lorem</th><th>Lorem</th></tr>
      </thead>
      <tbody>
        <tr><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td></tr>
        <tr><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td></tr>
        <tr><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td><td>Ipsum</td></tr>
      </tbody>
    </table>
  </div>


            </div>
    


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