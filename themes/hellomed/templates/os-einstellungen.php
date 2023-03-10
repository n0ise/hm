<?php /* Template Name: OS Einstellungen */ ?>
<!-- include_once header.php from template  -->
<?php include_once('os-header.php'); 
// current user id
$user_id = get_current_user_id();
 if(is_user_logged_in()) { 
//    var_dump($user_id);
    ?>
<main>
    <div class="container">
        <div class="hm-content">

            <div class="h2 mb-5">Einstellungen
                <img src="https://ui.hellomed.com/src/v1.1/img/icons/onboarding/about_me.svg">
            </div>

            <div id="success"></div>

            <!-- show function in div content  -->
            <?php function edit_patient($user_id) {
            // $user = get_userdata($user_id);
            $patient_caregiver = get_field('patient_caregiver', 'user_' . $user_id);
            $user_firstname = get_user_meta( $user_id, 'first_name', true );
            $user_lastname = get_user_meta( $user_id, 'last_name', true );
            $geschlecht_value = get_user_meta($user_id, 'geschlecht', true);
                if ($geschlecht_value === "Male") {
                  $geschlecht_value = "Männlich";
                } elseif ($geschlecht_value === "Female") {
                  $geschlecht_value = "Weiblich";
                }
            ?>
            <div class="row gy-4 hm-settings-grid">
                <div class="col-12">
                    <div class="h3 m-0">Stammdaten</div>
                </div>
                <div class="col-12 ">
                    <div class="form-floating">
                        <input id="geschlecht" type="text" class="form-control"
                            value="<?php echo $geschlecht_value ?>" disabled>
                        <label>Geschlecht</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="first_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo $user_firstname ?>">
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
                        <input id="last_name" type="text" class="form-control" placeholder=" "
                            value="<?php echo $user->user_email; ?>" disabled>
                        <label>E-Mail</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="geburt" type="date" class="form-control"
                            value="<?php echo get_user_meta($user_id, 'geburt', true); ?>" disabled>
                        <label>Geburtstag</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Krankheiten</div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="krankheiten" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'krankheiten', true); ?>">
                        <label>Krankheiten</label>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="allergies" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'allergies', true); ?>">
                        <label>Allergien</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="h3 m-0 mt-5">Adressdaten</div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="strasse" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'strasse', true); ?>">
                        <label>Straße</label>
                    </div>
                </div>
                <div class="col-4 ps-0">
                    <div class="form-floating">
                        <input id="nrno" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'nrno', true); ?>">
                        <label>Nr</label>
                    </div>
                </div>
                <div class="col-4 pe-0">
                    <div class="form-floating">
                        <input id="postcode" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'postcode', true); ?>">
                        <label>PLZ</label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="stadt" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'stadt', true); ?>">
                        <label>Wohnort</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input id="zusatz" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'zusatzinformationen', true); ?>">
                        <label>Zusatzinformationen</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-floating">
                        <input id="telephone" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'telephone', true); ?>">
                        <label>Telefon</label>
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
                <div class="col-12">
                    <div class="form-floating">
                        <input id="insurance_company" type="text" class="form-control insurance_company" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'insurance_company', true); ?>"
                            list="insurance-options">
                        <label>Name der Krankenversicherung</label>
                    </div>
                    <div id="insurance-options">
                        <ul></ul>
                    </div>
                </div>

                <!-- <div class="col-12 col-md-6">
                    <div class="form-floating">
                        <input id="insurance_number" type="text" class="form-control" placeholder=" "
                            value="<?php echo get_user_meta($user_id, 'insurance_number', true); ?>">
                        <label>Versicherungsnummer</label>
                    </div>
                </div> -->
                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                <div class="col-12">
                    <button id="save" type="button" class="btn btn-primary btn-lg">Speichern</button>
                </div>
                <!-- add a success div  -->
                <div id="successdown"></div>
            </div>
            <?php   
    }
        edit_patient($user_id); ?>

        </div>
    </div>

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
            // var start_date = $('#start_date').val();
            var insurance_company = $('#insurance_company').val();
            var insurance_number = $('#insurance_number').val();

            // For admin edit template
            // var status = $('#status').val();
            // var email = $('#email').val();
            // var new_user_id = $('#new_user_id').val();
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
                // 'start_date': start_date,
                'insurance_company': insurance_company,
                'insurance_number': insurance_number


                // For admin edit template
                // 'status': status,
                // 'email': email,
                // 'new_user_id': new_user_id
            };
            $.post(ajaxurl, data, function(response) {
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
                        $('#' + inputId).after('<div class="invalid-feedback">' + errorMessages[
                            i].substring(inputId.length + 1) + '</div>');
                    }
                    //add error class and message
                    $('#successdown').addClass('alert alert-danger');
                    $('#successdown').html(
                        'Fehler: Bitte überprüfen Sie die rot markierten Felde');
                    $('#successdown').fadeIn(1000);
                    setTimeout(function() {
                        $('#successdown').fadeOut(1000);
                    }, 5000);
                }

                // show new data in their fields after saving
                $('#first_name').val(first_name);
                $('#last_name').val(last_name);
                $('#telephone').val(telephone);
                $('#strasse').val(strasse);
                $('#postcode').val(postcode);
                $('#stadt').val(stadt);
                $('#geburt').val(geburt);
                $('#allergies').val(allergies);
                $('#geschlecht').val(geschlecht);
                $('#insurance_company').val(insurance_company);
                $('#insurance_number').val(insurance_number);
                // $('#start_date').val(start_date);
                $('#krankheiten').val(krankheiten);
                $('#nrno').val(nrno);

                // $('#status').val(status);
                // $('#email').val(email);
                // $('#new_user_id').val(new_user_id);

                console.log(response);
                // debug sent data 
                console.log(data);

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