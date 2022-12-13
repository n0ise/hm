<?php /* Template Name: Admin Nutzerverwaltung EDIT */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- taking id from the browser param, sent from Editieren in /admin-nutzerverwaltung  -->
<?php $user_id=$_GET['user_id']; ?>
<?php if(is_user_logged_in() && current_user_can('administrator')) { 
   // var_dump($user_id);
    ?>

<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Nutzer hinzufügen/editieren</div>

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
                        <select id="geschlecht" class="form-select">
                            <option value="<?php echo get_user_meta($_GET['user_id'], 'geschlecht', true); ?>" selected>
                            <?php echo get_user_meta($_GET['user_id'], 'geschlecht', true); ?></option>
                            <option value="Männlich">Männlich</option>
                            <option value="Weiblich">Weiblich</option>
                            <option value="Divers">Divers</option>
                            </option>
                        </select>
                        <label>Geschlecht</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="geburt" type="date" class="form-control"
                            value="<?php echo get_user_meta($_GET['user_id'], 'geburt', true); ?>">
                        <label>Geburtstag</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="krankheiten" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'krankheiten', true); ?>">
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
                <div class="col-4">
                    <div class="form-floating">
                        <input id="nrno" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'nrno', true); ?>">
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
                <div class="col-6">
                    <div class="form-floating">
                        <input id="zusatz" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'zusatzinformationen', true); ?>">
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
                <div class="col-12">
                    <div class="form-floating">
                        <input id="start_date" type="date" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'start_date', true); ?>">
                        <label>Hellomed Startdatum</label>
                    </div>
                </div>
                <div class="col-12 col-md-4 offset-md-4">
                    <div class="btn-group d-flex">
                        <input id="privat_gesetzlich" type="radio" value="Privat" class="btn-check"
                            name="privat_or_gesetzlich" autocomplete="off" <?php 
                            if ( get_user_meta($user_id, 'privat_or_gesetzlich', true) =='Privat' ){
                                echo 'checked';} ?>>
                        <label class="btn btn-outline-primary" for="privat_gesetzlich">Privat versichert</label>
                        <input id="gesetzlich_versichert" type="radio" value="Gesetzlich" class="btn-check"
                            name="privat_or_gesetzlich" autocomplete="off" <?php 
                            if ( get_user_meta($user_id, 'privat_or_gesetzlich', true) =='Gesetzlich' ){
                                echo 'checked';} ?>>
                        <label class="btn btn-outline-primary" for="gesetzlich_versichert">Gesetzlich versichert</label>
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
                            <option>Inaktiv</option>
                            <option>Gefähred</option>
                        </select>
                        <label>Status</label>
                    </div>
                </div>
                <input type="hidden" id="user_id" value="<?php echo $_GET['user_id']; ?>">

                <div class="col-12">
                    <button id="save" type="button" class="btn btn-primary btn-lg">Speichern</button>
                </div>

                 <!-- success div, will show the changed fields  --> 
         
             <div id="successdown" role="alert"></div>
            </div>
            <?php   
    }
  edit_patient($user_id); 
            ?>

        </div>
            
    </div>


    <?php
add_action('wp_ajax_edit_patient', 'edit_patient');
add_action('wp_ajax_nopriv_edit_patient', 'edit_patient');

?>
</main>

<?php } 
else { ?>
<!-- here if the user is not logged in, going raaaus  -->
<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">NO.</div>
            <div class="alert alert-danger" role="alert">
                <!-- image centered  -->
                <div class="text-center">
                    <img class="rounded img-fluid mx-auto img-thumbnail " width="300"
                        src="wp-content/themes/hellomed/assets/img/why.jpeg" alt="nope">
                </div>

                <h4 class="alert-heading">Du bist nicht eingeloggt!</h4>
                <p>Bitte logge dich ein, um diese Seite zu sehen.</p>
                <hr>
                <p class="mb-0">Du wirst in 10 Sekunden weitergeleitet.</p>
            </div>
        </div>
    </div>
</main>
<?php header("Refresh:10; url=/anmelden"); 
}

// da footer 
include_once('footer.php');
?>

<!-- ajax bits and pieces -->
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#save').click(function() {
        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var geschlecht = $('#geschlecht').val();
        var geburt = $('#geburt').val();
        var krankheiten = $('#krankheiten').val();
        var allergies = $('#allergies').val();
        var strasse = $('#strasse').val();
        var nrno = $('#nrno').val();
        var postcode = $('#postcode').val();
        var stadt = $('#stadt').val();
        var zusatz = $('#zusatz').val();
        var telephone = $('#telephone').val();
        var privat_or_gesetzlich = $('input[name="privat_or_gesetzlich"]:checked').val();
        var start_date = $('#start_date').val();
        var insurance_company = $('#insurance_company').val();
        var insurance_number = $('#insurance_number').val();
        // var email = $('#email').val();
        var new_user_id = $('#new_user_id').val();
        var status = $('#status').val();
        var ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";

        var data = {
            'action': 'edit_patient',
            'user_id': <?php echo $user_id; ?>,
            'first_name': first_name,
            'last_name': last_name,
            'geschlecht': geschlecht,
            'geburt': geburt,
            'krankheiten': krankheiten,
            'allergies': allergies,
            'strasse': strasse,
            'nrno': nrno,
            'postcode': postcode,
            'stadt': stadt,
            'zusatz': zusatz,
            'telephone': telephone,
            'privat_or_gesetzlich': privat_or_gesetzlich,
            'start_date': start_date,
            'insurance_company': insurance_company,
            'insurance_number': insurance_number,
            'status': status,
            // 'email': email,
            'new_user_id': new_user_id
        };
        // console.log(data);

        $.post(ajaxurl, data, function(response) {
            // if there is at least a field changed (is not empty), show the success div (disappears after 5 seconds)
            if (response != '') {
            $('#successdown').addClass('alert alert-success'); 
            $('#successdown').html(response.toString());
            $('#successdown').fadeIn(1000);
            setTimeout(function() {
                $('#successdown').fadeOut(1000);
            }, 5000);
            }
            // update the input fields with the new data
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
            $('#krankheiten').val(krankheiten);
            $('#status').val(status);
            // $('#email').val(email);
            $('#new_user_id').val(new_user_id);
            // debug sent data and response from functions.php
            console.log(data);
            console.log(response);

        });
    });
});
</script>