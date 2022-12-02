<?php /* Template Name: Admin Nutzerverwaltung EDIT */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- taking id from the browser param, sent from Editieren in /admin-nutzerverwaltung  -->
<?php $user_id=$_GET['user_id']; ?>
<?php if(is_user_logged_in()) { 
   // var_dump($user_id);
    ?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Nutzer hinzufügen/editieren</div>
            <div id="success"></div>

            <!-- show function in div content  -->
            <?php function edit_patient($user_id) {
// var_dump($user_id);
// get user data
$user = get_userdata($user_id);
?>
            <div class="row gy-4">
                <div class="col-12">
                    <div class="form-floating">
                        <input id="new_user_id" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'new_user_id', true); ?>">
                        <label>User ID</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select id="geschlecht" class="form-select">
                            <option value="<?php echo get_user_meta($_GET['user_id'], 'geschlecht', true); ?>" selected>
                                <?php echo get_user_meta($_GET['user_id'], 'geschlecht', true); ?></option>
                            <option value="Männlich">Männlich</option>
                            <option value="Weiblich">Weiblich</option>
                            <option value="Divers">Divers</option>
                            </option>

                            </option>
                        </select>
                        <label>Geschlecht</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="first_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'first_name', true); ?>">
                        <label>Name</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="last_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'last_name', true); ?>">
                        <label>Nachname</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="email" type="text" class="form-control" placeholder=" "
                            value="<?php echo $user->user_email; ?>">
                        <label>E-Mail</label>
                    </div>
                </div>
                <!-- // TODO get date in "date" format -->
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="geburt" type="text" class="form-control"
                            value="<?php echo get_user_meta($_GET['user_id'], 'geburt', true); ?>">
                        <label>Geburtstag</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="sickness" type="text" class="form-control" placeholder=" ">
                        <label>Krankheiten</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="allergies" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'allergies', true); ?>">
                        <label>Allergien</label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="strasse" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'strasse', true); ?>">
                        <label>Straße</label>
                    </div>
                </div>
                <!-- // TODO add number  -->
                <div class="col-4">
                    <div class="form-floating">
                        <input type="text" class="form-control" placeholder=" ">
                        <label>Nr</label>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-floating">
                        <input id="postcode" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'postcode', true); ?>">
                        <label>PLZ</label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="stadt" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'stadt', true); ?>">
                        <label>Ort</label>
                    </div>
                </div>
                <!-- // TODO add Zusatzinfos -->
                <div class="col-6">
                    <div class="form-floating">
                        <input id="zusatz" type="text" class="form-control" placeholder=" ">
                        <label>Zusatzinformationen</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input id="telephone" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'telephone', true); ?>">
                        <label>Telefon</label>
                    </div>
                </div>
                <!-- // TODO get date in "date" format -->
                <div class="col-12">
                    <div class="form-floating">
                        <input id="start_date" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'start_date', true); ?>">
                        <label>Hellomed Startdatum</label>
                    </div>
                </div>
                <div class="col-12 col-md-4 offset-md-4">
                    <div class="btn-group d-flex">
                        <input id="privat_gesetzlich" type="radio" class="btn-check" name="btnradio" id="test1"
                            autocomplete="off" checked>
                        <label class="btn btn-outline-primary" for="test1">Privat versichert</label>
                        <input type="radio" class="btn-check" name="btnradio" id="test2" autocomplete="off">
                        <label class="btn btn-outline-primary" for="test2">Gesetzlich versichert</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="insurance_company" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'insurance_company', true); ?>">
                        <label>Name der Krankenversicherung</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="insurance_number" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'insurance_number', true); ?>">
                        <label>Versicherungsnummer</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select id="status" class="form-select">
                            <option selected><?php echo get_user_meta($_GET['user_id'], 'status', true); ?></option>
                            <option>Aktiv</option>
                            <option>Wartend</option>
                        </select>
                        <label>Status</label>
                    </div>
                </div>
                <input type="hidden" id="user_id" value="<?php echo $_GET['user_id']; ?>">

                <div class="col-12">
                    <button id="save" type="button" class="btn btn-primary btn-lg">Speichern</button>
                </div>
            </div>
            <?php   
    }
  edit_patient($user_id); ?>
            <!-- add a success div  -->
       <!-- add a space gap here -->

    
            <div id="successdown"></div>
        </div>
    </div>

    <!-- ajax bits and pieces -->
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#save').click(function() {
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var telephone = $('#telephone').val();
            var strasse = $('#strasse').val();
            var postcode = $('#postcode').val();
            var geschlecht = $('#geschlecht').val();
            var city = $('#city').val();
            var stadt = $('#stadt').val();
            var geburt = $('#geburt').val();
            var allergies = $('#allergies').val();
            var insurance_company = $('#insurance_company').val();
            var insurance_number = $('#insurance_number').val();
            var start_date = $('#start_date').val();
            var sickness = $('#sickness').val();
            var status = $('#status').val();
            var email = $('#email').val();
            var new_user_id = $('#new_user_id').val();
            var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

            var data = {
                'action': 'edit_patient',
                'user_id': <?php echo $user_id; ?>,
                'first_name': first_name,
                'last_name': last_name,
                'telephone': telephone,
                'strasse': strasse,
                'postcode': postcode,
                // 'city': city,
                'stadt': stadt,
                'geburt': geburt,
                'allergies': allergies,
                'insurance_company': insurance_company,
                'insurance_number': insurance_number,
                'start_date': start_date,
                'rezept_end': sickness,
                'geschlecht': geschlecht,
                'status': status,
                'email': email,
                'new_user_id': new_user_id

            };
            $.post(ajaxurl, data, function(response) {

                $('#success').addClass('alert alert-success');
                $('#success').html('Profile updated');
                $('#successdown').addClass('alert alert-success');
                $('#successdown').html('Profile updated');
                // show updated fields  in the success message 

                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#telephone').val(telephone);
                $('#strasse').val(strasse);
                $('#postcode').val(postcode);
                $('#allergies').val(allergies);
                $('#stadt').val(stadt);
                $('#geburt').val(geburt);
                $('#allergies').val(allergies);
                $('#geschlecht').val(geschlecht);
                $('#insurance_company').val(insurance_company);
                $('#insurance_number').val(insurance_number);
                $('#start_date').val(start_date);
                $('#sickness').val(sickness);
                $('#status').val(status);
                $('#email').val(email);
                $('#new_user_id').val(new_user_id);



                console.log(response);
                // debug sent data 
                console.log(data);

            });
        });
    });
    </script>
    <?php
add_action('wp_ajax_edit_patient', 'edit_patient');
add_action('wp_ajax_nopriv_edit_patient', 'edit_patient');

?>
</main>

<?php 
}
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