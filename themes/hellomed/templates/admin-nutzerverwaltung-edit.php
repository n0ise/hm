<?php /* Template Name: Admin Nutzerverwaltung EDIT */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>

<!-- taking id from the browser param, sent from Editieren in /admin-nutzerverwaltung  -->
<?php $user_id=$_GET['user_id']; 

 if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>
<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Nutzer bearbeiten</div>

            <!-- show function in div content  -->
            <?php function edit_patient($user_id) {
                // var_dump($user_id);
            
                // get user data
                $user = get_userdata($user_id);
                // var_dump($user->ID);
                $patient_caregiver = get_field('patient_caregiver', 'user_' . $user->ID);
                $user_firstname = $user->user_firstname;
                $user_lastname = $user->user_lastname;
                $geschlecht_value = get_user_meta($_GET['user_id'], 'geschlecht', true);
                if ($geschlecht_value === "Male") {
                  $geschlecht_value = "Männlich";
                } elseif ($geschlecht_value === "Female") {
                  $geschlecht_value = "Weiblich";
                }
                
            ?>
            <div class="row gy-4 hm-settings-grid">
                <div class="col-12">
                    <div class="h3 m-0">ID</div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input id="new_user_id" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'new_user_id', true); ?>">
                        <label>User ID</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Stammdaten</div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="first_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo $user_firstname; ?>">
                        <label>Vorname</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="last_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo $user_lastname; ?>">
                        <label>Nachname</label>
                    </div>
                </div>
                <?php if ($patient_caregiver == 'caregiver') { ?>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="patient_first_name" type="text" class="form-control border border-primary"
                            placeholder=" " value="<?php echo get_field('patient_first_name', 'user_' . $user->ID); ?>">
                        <label>Patient Vorname</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="patient_last_name" type="text" class="form-control border border-primary"
                            placeholder=" " value="<?php echo get_field('patient_last_name', 'user_' . $user->ID); ?>">
                        <label>Patient Nachname</label>
                    </div>
                </div>
                <?php } ?>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <select id="geschlecht" class="form-select">
                            <option value="<?php echo get_user_meta($_GET['user_id'], 'geschlecht', true); ?>" selected>
                                <?php echo $geschlecht_value; ?></option>
                            <?php 
                                $geschlecht = array('Männlich', 'Weiblich');
                                $selectedgeschlecht = $geschlecht_value;
                                $keygeschlecht = array_search($geschlecht_value, $geschlecht);
                                unset($geschlecht[$keygeschlecht]);
                                    foreach ($geschlecht as $valuegeschlecht) {
                                    echo '<option value="' . $valuegeschlecht . '">' . $valuegeschlecht . '</option>';
                                    } 
                                ?>
                            </option>
                        </select>
                        <label>Geschlecht</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <?php
                            $geburt = get_user_meta($_GET['user_id'], 'geburt', true);
                            $converted_date = date("Y-m-d", strtotime($geburt));
                        ?>
                        <input id="geburt" type="date" class="form-control" value="<?php echo $converted_date; ?>">
                        <label>Geburtstag</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Krankheiten</div>
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
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Adressdaten</div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="strasse" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'strasse', true); ?>">
                        <label>Straße</label>
                    </div>
                </div>
                <div class="col-4 ps-0">
                    <div class="form-floating">
                        <input id="nrno" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'nrno', true); ?>">
                        <label>Nr</label>
                    </div>
                </div>
                <div class="col-4 pe-0">
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
                        <label>Wohnort</label>
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
                    <div class="h3 m-0 mt-5">Verblisterung</div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <?php
                            $start_date = get_user_meta($_GET['user_id'], 'start_date', true);
                            $converted_date = date("Y-m-d", strtotime($start_date));
                        ?>
                        <input id="start_date" type="date" class="form-control" value="<?php echo $converted_date; ?>">
                        <label>hellomed Startdatum</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Krankenkasse</div>
                </div>
                <div class="col-12">
                    <div class="btn-group d-flex">
                        <input id="privat_gesetzlich" type="radio" value="Private" class="btn-check"
                            name="privat_or_gesetzlich" autocomplete="off" <?php 
                            if ( get_user_meta($user_id, 'privat_or_gesetzlich', true) =='Private' ){
                                echo 'checked';} ?>>
                        <label class="btn btn-outline-primary" for="privat_gesetzlich">Privat versichert</label>
                        <input id="gesetzlich_versichert" type="radio" value="Public" class="btn-check"
                            name="privat_or_gesetzlich" autocomplete="off" <?php 
                            if ( get_user_meta($user_id, 'privat_or_gesetzlich', true) =='Public' ){
                                echo 'checked';} ?>>
                        <label class="btn btn-outline-primary" for="gesetzlich_versichert">Gesetzlich versichert</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="insurance_company" type="text" class="form-control insurance_company" placeholder=" "
                            value="<?php echo get_user_meta($_GET['user_id'], 'insurance_company', true); ?>"
                            list="insurance-options">
                        <label>Name der Krankenversicherung</label>
                    </div>
                    <div id="insurance-options">
                        <ul></ul>
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
                    <div class="h3 m-0 mt-5">Status</div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select id="status" class="form-select">
                            <option value="" disabled selected>Bitte wählen</option>
                            <option value="<?php echo get_user_meta($_GET['user_id'], 'status', true); ?>" selected>
                                <?php echo get_user_meta($_GET['user_id'], 'status', true); ?></option>
                            <?php 
                                $status = array('Aktiv', 'Inaktiv', 'Wartend');
                                $selectedstatus = get_user_meta($_GET['user_id'], 'status', true);
                                $keystatus = array_search($selectedstatus, $status);
                             unset($status[$keystatus]);
                                    foreach ($status as $valuestatus) {
                                    echo '<option value="' . $valuestatus . '">' . $valuestatus . '</option>';
                                    } 
                                ?>
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
<?php header("Refresh:0; url=/anmelden"); 
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
        var patient_first_name = $('#patient_first_name').val();
        var patient_last_name = $('#patient_last_name').val();
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
            'patient_first_name': patient_first_name,
            'patient_last_name': patient_last_name,
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
            response = JSON.parse(response);

            // remove invalid when focusing on the field
            $('input').on('focus', function() {
                $(this).removeClass('is-invalid');
                $(this).next('.invalid-feedback').remove();
            });

            if (response.status == 'success') {
                //remove error classes and messages
                $('#successdown').removeClass('alert alert-danger');
                $('input').removeClass('is-invalid');
                $('.invalid-feedback').remove();
                //add success classes and message
                // $('input').addClass('is-valid');
                $('#successdown').addClass('alert alert-success');
                $('#successdown').html(response.message);
                $('#successdown').fadeIn(1000);
                setTimeout(function() {
                    $('#successdown').fadeOut(1000);
                }, 5000);

            } else if (response.status == 'error') {
                var errorMessages = response.message;
                //loop through error messages and add to corresponding input fields
                for (var i = 0; i < errorMessages.length; i++) {
                    var inputId = errorMessages[i].split(":")[0];
                    $('#' + inputId).addClass('is-invalid');
                    $('#' + inputId).after('<div class="invalid-feedback">' + errorMessages[i]
                        .substring(inputId.length + 1) + '</div>');
                }
                //add error class and message
                $('#successdown').addClass('alert alert-danger');
                $('#successdown').html('Fehler: Bitte überprüfen Sie die rot markierten Felde');
                $('#successdown').fadeIn(1000);
                setTimeout(function() {
                    $('#successdown').fadeOut(1000);
                }, 5000);

            }
            // update the input fields with the new data
            $('#first_name').val(first_name);
            $('#last_name').val(last_name);
            $('#patient_first_name').val(patient_first_name);
            $('#patient_last_name').val(patient_last_name);
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

<script>
let data;

function fetchData() {
    fetch('wp-content/themes/hellomed/assets/json/insurances.json')
        .then(response => response.json())
        .then(responseData => {
            data = responseData;
            // console.log(data);
        });
}

function search() {
    console.log('search called');
    const searchTerm = this.value;

    // Reset the search results if the search term is empty
    if (searchTerm === '') {
        document.querySelector('#insurance-options').innerHTML = '';
        return;
    }

    // Show all results that include the search term
    const searchResults = data.filter(company => company.name.toLowerCase().includes(searchTerm.toLowerCase()));
    document.querySelector('#insurance-options').innerHTML =
        '<ul id="filter-records" class="hm-autocomplete"></ul>';

    searchResults.forEach(result => {
        const option = document.createElement('li');
        option.classList.add('hm-autocomplete-item');
        option.innerHTML = `
<div class="hm-autocomplete-img">
<img src="${result.logo ? '/wp-content/themes/hellomed/assets/img/icons/insurance/'+result.logo : '#' }">
</div>
<div class="hm-autocomplete-name">${result.name}</div>
`;
        document.querySelector('#insurance-options ul').appendChild(option);
        option.addEventListener('click', function() {
            document.querySelector('#insurance_company').value = result.name;
            document.querySelector('#insurance-options').innerHTML = '';
        });
    });
}

window.addEventListener('load', fetchData);
document.querySelector('.insurance_company').addEventListener('input', search);
</script>