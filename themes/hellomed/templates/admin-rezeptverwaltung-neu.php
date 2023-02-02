<?php /* Template Name: Admin Neu Rezeptverwaltung */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>

<div class="content">
    <main>
        <div class="container">
            <div class="hm-content">
                <div class="h2 mb-5">Rezept bearbeiten</div>
                <div class="row gy-4 hm-settings-grid">
                    <div class="col-12">
                        <div class="h3 m-0">Patient</div>
                    </div>


                    <div class="col-12">
                        <?php 
                        $patients = get_users( array( 'role' => 'client' ) );
                        $patientsWithDetails = [];
                        $new_user_ids = [];
                        $patient_first_names = [];
                        $patient_last_names = [];
                        foreach ( $patients as $patient ) {
                            $new_user_id = get_field('new_user_id', 'user_'.$patient->ID);
                            $patient_first_name = get_field('patient_first_name', 'user_'.$patient->ID);
                            $patient_last_name = get_field('patient_last_name', 'user_'.$patient->ID);

                            $new_user_ids[] = $new_user_id;
                            $patient_first_names[] = $patient_first_name;
                            $patient_last_names[] = $patient_last_name;

                            $patientsWithDetails[] = [
                                'ID' => $patient->ID,
                                'new_user_id' => $new_user_id,
                                'patient_first_name' => $patient_first_name,
                                'patient_last_name' => $patient_last_name,
                            ];
                        }

                        ?>
                        <div class="form-group">
                            <input type="text" id="patient_select" name="patient_select" class="form-control"
                                oninput="search_patient()" onchange="updateSelectedID()" onfocus="search_patient()">
                            <div id="patient_options">
                                <ul id="patient_records" class="hm-autocomplete"
                                    data-patientid="<?php echo $patient->ID; ?>"></ul>
                            </div>
                        </div>

                        <input type="hidden" id="user_id" name="user_id" value="">
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5" id="error_blister">Blisterjob</div>
                    </div>
                    <?php 
                        if (!empty($record['blister_job'])) {
                        foreach ($record['blister_job'] as $blister_job) {

                    ?>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_job_id" type="text" class="blister_job_id form-control" value="ID">
                            <label>Blisterjob ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_start_date" type="date" class=" blister_start_date form-control"
                                placeholder="tt.mm.jjjj" value="">
                            <label>Start</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_end_date" type="date" class="blister_end_date form-control"
                                placeholder="tt.mm.jjjj" value="">
                            <label>Ende</label>
                        </div>
                    </div>
                    <?php  } 
                      }
                    ?>
                    <!-- div where will be added new blister jobs on click  -->

                    <div class="blister_ph"></div>

                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" class="btn btn-light btn-sm" id="add_blister_job">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Blisterjob
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Arzt</div>
                    </div>

                    <div class="col-12">
                        <div class="form-floating">
                            <input id="doctor_name" type="text" class="form-control" value="">
                            <label>Arzt</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Rezept</div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_date_by_doctor" type="date" class="form-control"
                                placeholder="tt.mm.jjjj" value="">
                            <label>Verschreibungsdatum</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_start_date" type="date" class="form-control"
                                placeholder="tt.mm.jjjj" value="">
                            <label>Start</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_end_date" type="date" class="form-control" placeholder="tt.mm.jjjj"
                                value="">
                            <label>Ende</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5" id="error_medikamente">Medikamente</div>
                    </div>
                    <!-- <div class="col-12 col-md-9">
                        <div class="form-floating">
                            <input id="medicine_name_pzn" type="text" class="form-control medicine_name_pzn" value=""
                                list="medicine-options">
                            <label>Medikament</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input id="medicine_amount" type="number" class="form-control medicine_amount" value=""
                                step="1" min="0">
                            <label>Menge</label>
                        </div>
                    </div> -->
                    <div class="medikament_ph"></div>
                    <!-- <datalist id="medicine-options"></datalist> -->

                    <div class="col-12 d-flex justify-content-center">
                        <button id="add_medicine_div" type="button" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Medikament
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Status</div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select id="status_prescription" class="form-select">
                                <option selected="">Bitte wählen</option>
                                <option>Aktiv</option>
                                <option>Inaktiv</option>
                                <option>Wartend</option>
                                <option>Gefähred</option>
                            </select>
                            <label>Status</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button id="save_blister_job" type="button" class="btn btn-primary btn-lg">Speichern</button>
                    </div>
                    <div id="successdown"></div>
                </div>

            </div>
        </div>
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

    <!-- that is taking the json file -->
    <script>
    let data;

    function fetchData() {
        fetch('wp-content/themes/hellomed/assets/json/drugs.json')
            .then(response => response.json())
            .then(responseData => {
                data = responseData;
                // Attach the event listeners to the input elements
                document.querySelectorAll('.medicine_name_pzn').forEach(element => {
                    element.addEventListener('input', search);
                });
            });
    }

    // functions for DRUGS autocomplete
    let counter = 0;

    function search() {
        // console.log('search called');

        const searchTerm = this.value;
        if (searchTerm.length < 3) {
            return;
        }
        const searchResults = data.filter(result => result.Artikelbezeichnung.toLowerCase().includes(searchTerm
            .toLowerCase()));
        // console.log(searchResults);
        document.querySelector(`#medicine-options_${counter}`).innerHTML =
            `<ul id="filter-records" class="hm-autocomplete"></ul>`;

        searchResults.forEach(result => {
            const option = document.createElement('li');
            option.classList.add('hm-autocomplete-item');
            option.innerHTML = `
<div class="hm-autocomplete-name">${result.Artikelbezeichnung}</div>
`;
            document.querySelector(`#filter-records`).appendChild(option);
            option.addEventListener('click', function() {
                document.querySelector(`#medicine_name_pzn_${counter}`).value = result
                    .Artikelbezeichnung;
                document.querySelector(`#medicine-options_${counter}`).innerHTML = '';
            });
        });

    }

    jQuery(document).ready(function($) {
        $('#add_medicine_div').click(function() {
            fetchData();
            // this is taking count of how many repeaters, and add it into the ID 
            counter++;
            let newDivHTML =
                `<div class="col-12 col-md-9">
    <div class="form-floating">
      <input id="medicine_name_pzn_${counter}" type="text" class="form-control medicine_name_pzn" value="" list="medicine-options_${counter}">
      <label>Medikament</label>
    </div>
  </div>
  <div class="col-12 col-md-3">
    <div class="form-floating">
      <input id="medicine_amount" type="number" class="form-control medicine_amount" value="" step="1" min="0">
      <label>Menge</label>
    </div>
  </div>
  <div id="medicine-options_${counter}">
    <ul></ul>
  </div>
  <div class="medikament_ph"></div>`;

            document.querySelectorAll('.medikament_ph')[document.querySelectorAll('.medikament_ph')
                .length - 1].insertAdjacentHTML('afterend', newDivHTML);

            // ..aand this attach the event listener to the input element with ID #medicine_name_pzn_${counter}
            document.querySelector(`#medicine_name_pzn_${counter}`).addEventListener('input', search);
        });
    });
    </script>

    <script>
    jQuery(document).ready(function($) {
        $('#add_blister_job').click(function() {
            let blisterDivHTML =
                `<div class="col-12 col-md-4 blister_jobs_form">
                    <div class="form-floating ">
                        <input type="text" id="blister_job_id" class="form-control blister_job_id" value="">
                        <label>Blisterjob ID</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating">
                        <input type="date" id="blister_start_date" class="form-control blister_start_date" value="">
                        <label>Start</label>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-floating">
                        <input type="date"  id="blister_end_date" class="form-control blister_end_date" value="">
                        <label>Ende</label>
                    </div>
                </div>
                    <div class="blister_ph"></div>`;

            // Insert the HTML string representation of the new div element after the div element with the medikament_ph class
            document.querySelectorAll('.blister_ph')[document.querySelectorAll('.blister_ph').length -
                1].insertAdjacentHTML('afterend', blisterDivHTML);
            // document.querySelector('.blister_ph').insertAdjacentHTML('afterend', blisterDivHTML);

        });
    });
    </script>

    <script>
    jQuery(document).ready(function($) {
        $('#save_blister_job').click(function() {
            // var blister_job_id = $('#blister_job_id').val();
            // var blister_start_date = $('#blister_start_date').val();
            // var blister_end_date = $('#blister_end_date').val();
            var doctor_name = $('#doctor_name').val();
            var prescription_date_by_doctor = $('#prescription_date_by_doctor').val();
            var prescription_start_date = $('#prescription_start_date').val();
            var prescription_end_date = $('#prescription_end_date').val();
            // var medicine_name_pzn = $('#medicine_name_pzn').val();
            // var medicine_amount = $('#medicine_amount').val();
            var status_prescription = $('#status_prescription').val();
            var patient_select = $('#patient_select').val();
            // var prescription_id_no = $('#prescription_id_no').val();
            // generating randomID
            function generateRandomID() {
                return Math.floor(Math.random() * (1000000000 - 100) + 100);
            }
            var prescription_id_no = generateRandomID();
            console.log("Prescription ID: ", prescription_id_no);
            var user_id = $('#user_id').val();
            // for each value in blister_jobs, get the values and put it in an array

            var blister_jobs = {};
            $('.blister_job_id').each(function(index) {
                blister_job_id = $('.blister_job_id')[index].value;
                blister_start_date = $('.blister_start_date')[index].value;
                blister_end_date = $('.blister_end_date')[index].value;

                blister_jobs[index] = {
                    blister_job_id: blister_job_id,
                    blister_start_date: blister_start_date,
                    blister_end_date: blister_end_date,

                };
            });

            // same as blister_jobs but for medicine
            var medikament = {};
            $('.medicine_name_pzn').each(function(index) {
                medicine_name_pzn = $('.medicine_name_pzn')[index].value;
                medicine_amount = $('.medicine_amount')[index].value;

                medikament[index] = {
                    medicine_name_pzn: medicine_name_pzn,
                    medicine_amount: medicine_amount,
                };
            });


            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            var data = {
                'action': 'new_prescription',
                // 'blister_job_id': blister_job_id,
                // 'blister_start_date': blister_start_date,
                // 'blister_end_date': blister_end_date,
                'doctor_name': doctor_name,
                'prescription_date_by_doctor': prescription_date_by_doctor,
                'prescription_start_date': prescription_start_date,
                'prescription_end_date': prescription_end_date,
                // 'medicine_name_pzn': medicine_name_pzn,
                // 'medicine_amount': medicine_amount,
                'status_prescription': status_prescription,
                'blister_jobs': blister_jobs,
                'medikament': medikament,
                'patient_select': patient_select,
                'prescription_id_no': prescription_id_no,
                'user_id': user_id,
                'rezept_type': 'by_admin'
            }
            console.log(data);
            // count blister_jobs, debug
            var count = Object.keys(blister_jobs).length;
            console.log(count);
            $.post(ajaxurl, data, function(response) {
                console.log(typeof response);
                console.log(response);
                response = JSON.parse(response);

                // remove invalid when focusing on the field
                $('input').on('focus', function() {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                });
                $('select').on('focus', function() {
                    $(this).removeClass('is-invalid');
                    $(this).next('.invalid-feedback').remove();
                });

                if (response.status == 'success') {
                    //remove error classes and messages
                    $('#successdown').removeClass('alert alert-danger');
                    $('input').removeClass('is-invalid');
                    $('select').removeClass('is-invalid');
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
            });
        });
    });
    </script>
    <script>
    // function for searching patient 
    function search_patient() {
        const input = document.querySelector('#patient_select');
        const searchTerm = input.value;
        const patients = <?php echo json_encode($patientsWithDetails); ?>;
        document.querySelector('#patient_options').innerHTML = '';

        document.querySelector(`#patient_options`).innerHTML =
            `<ul id="filter-records" class="p-2 hm-autocomplete"></ul>`;

        patients.forEach(result => {
            const option = document.createElement('li');
            option.classList.add('hm-autocomplete-item');
            option.innerHTML = `
      <div class="hm-autocomplete-name">ID: ${result.new_user_id} (${result.patient_first_name} ${result.patient_last_name})</div>
    `;
            option.setAttribute("data-patientid", result.ID);
            document.querySelector('#filter-records').appendChild(option);
            option.addEventListener('click', function(event) {
                document.querySelector('#patient_select').value = `${result.new_user_id}`;
                document.querySelector('#patient_options').innerHTML = '';
                document.querySelector('#user_id').value = result.ID;
            });
        });
    }
    </script>