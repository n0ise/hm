<?php /* Template Name: Admin Dashboard */ ?>

<!-- include_once header.php from template  -->
<?php include_once('header.php'); 
// <!-- if logged in and can administrate --> ?>
<?php if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>
<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Dashboard</div>
            <div class="row gy-4">
                <div class="col-12">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo count_users()['avail_roles']['client']; ?></h5>
                            <p class="card-text">Nutzer auf Hellomed angemeldet</p>
                            <a href="/admin-nutzerverwaltung?status=Alle" class="btn btn-primary">Anzeigen</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo count(get_users(array('meta_key' => 'status', 'meta_value' => 'Aktiv'))); ?>
                            </h5>
                            <p class="card-text">Status "Aktiv"</p>
                            <a href="/admin-nutzerverwaltung?status=Aktiv" class="btn btn-primary">Anzeigen</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">
                                <?php echo count(get_users(array('meta_key' => 'status', 'meta_value' => 'Wartend'))); ?>
                            </h5>
                            <p class="card-text">Status "Wartend"</p>
                            <a href="/admin-nutzerverwaltung?status=Wartend" class="btn btn-primary">Anzeigen</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<?php } 
else { 
//  here if the user is not logged in, redirects to /anmelden  -->
 header("Refresh:0; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>