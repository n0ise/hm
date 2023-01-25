<?php /* Template Name: Admin Neu Rezeptverwaltung */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in() && current_user_can('administrator')) { ?>

<div class="content">
    <main>
        <div class="container">
            <div class="hm-content">
                <div class="h2 mb-5">Rezept bearbeiten</div>
                <div class="row gy-4 hm-settings-grid">
                    <div class="col-12">
                        <div class="h3 m-0">Benutzer</div>
                    </div>
                    <div class="col-12">
                        <select id="patient_select" name="patient_select" class="form-control"
                            onchange="updateSelectedID()">
                            <option value="" disabled selected>Patienten auswählen</option>
                            <?php 
                                $patients = get_users( array( 'role' => 'client' ) );
                                foreach ( $patients as $patient ) {
                                    $new_user_id = get_field('new_user_id', 'user_'.$patient->ID);
                                    $patient_first_name = get_field('patient_first_name', 'user_'.$patient->ID);
                                    $patient_last_name = get_field('patient_last_name', 'user_'.$patient->ID);
                            ?>
                            <option value="<?php echo $new_user_id; ?>" data-patientid="<?php echo $patient->ID; ?>">
                                <?php echo $new_user_id . ' - ' . $patient_first_name. " ".$patient_last_name; ?>
                            </option>
                            <?php 
                                }
                            ?>
                        </select>
                        <input type="hidden" id="user_id" name="user_id" value="">
                    </div>

                    <div class="col-12">
                        <div class="h3 m-0">Prescrition ID</div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <div class="input-group gap-1">
                                <input id="prescription_id_no" type="text" class="form-control" value="">
                                <div class="input-group-append">
                                    <button class="btn btn-primary btn-sm" type="button"
                                        onclick="generateRandomID()">Random</button>
                                </div>
                            </div>
                            <!-- <label>Prescription ID</label> -->
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Blisterjob</div>
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
                            <input id="blister_start_date" type="date"
                                class=" blister_start_date form-control" placeholder="tt.mm.jjjj" value="">
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
                            <input id="prescription_end_date" type="date" class="form-control"
                                placeholder="tt.mm.jjjj" value="">
                            <label>Ende</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Inhalt</div>
                    </div>

                    <div class="col-12 col-md-9">
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
                    </div>
                    <div class="medikament_ph"></div>
                    <datalist id="medicine-options"></datalist>

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
    <?php header("Refresh:10; url=/anmelden"); 
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

    function search() {
        // console.log('search called');
        const searchTerm = this.value;

        if (searchTerm.length < 3) {
            return;
        }
        const searchResults = data.slice(0, 10);

        document.querySelector('#medicine-options').innerHTML = '';
        searchResults.forEach(result => {
            const option = document.createElement('option');
            option.value = result.Artikelbezeichnung;
            option.label = result.PZN;
            document.querySelector('#medicine-options').appendChild(option);
        });
    }

    jQuery(document).ready(function($) {
        $('#add_medicine_div').click(function() {
            fetchData();

            // Create a string of HTML that represents the new div element and its contents
            let newDivHTML =
                `<div class="col-12 col-md-9">
              <div class="form-floating">
                  <input id="medicine_name_pzn" type="text" class="form-control medicine_name_pzn"
                      value="" list="medicine-options">
                  <label>Medikament</label>
              </div>
          </div>

          <div class="col-12 col-md-3">
              <div class="form-floating">
                  <input id="medicine_amount" type="number" class="form-control medicine_amount"
                      value="" step="1" min="0">
                  <label>Menge</label>
              </div>

          </div>
          <div class="medikament_ph"></div>`;

            // Insert the HTML string representation of the new div element after the div element with the medikament_ph class
            document.querySelectorAll('.medikament_ph')[document.querySelectorAll('.medikament_ph')
                .length - 1].insertAdjacentHTML('afterend', newDivHTML);

            // Attach the event listeners to the input element
            document.querySelector('.medicine_name_pzn').addEventListener('input', search);
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
            var prescription_id_no = $('#prescription_id_no').val();
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
                'user_id': user_id
            }
            console.log(data);
            // count blister_jobs, debug
            var count = Object.keys(blister_jobs).length;
            console.log(count);
            $.post(ajaxurl, data, function(response) {
                console.log(typeof response);
                console.log(response);
                response = JSON.parse(response);
                if (response.status == 'success') {
                    $('#successdown').removeClass('alert alert-danger');
                    $('input').removeClass('border border-2 border-danger');
                    $('#successdown').addClass('alert alert-success');
                    $('#successdown').html(response.message);
                    $('#successdown').fadeIn(1000);
                    setTimeout(function() {
                        $('#successdown').fadeOut(1000);
                    }, 5000);
                } else if (response.status == 'error') {
                    var errorMessages = response.message;
                    for (var i = 0; i < errorMessages.length; i++) {
                        var inputId = errorMessages[i].split(":")[0];
                        $('#' + inputId).addClass('border-danger');
                        errorMessages[i] = errorMessages[i].substring(inputId.length + 1);
                    }
                    $('#successdown').addClass('alert alert-danger');
                    $('#successdown').html(errorMessages.join("<br>"));
                    $('#successdown').fadeIn(1000);
                    setTimeout(function() {
                        $('#successdown').fadeOut(1000);
                    }, 5000);
                }
            });
        });
    });
    </script>

    <!-- random id number idea, for lazy peeps -->
    <script>
    function generateRandomID() {
        var min = 100;
        var max = 100000;
        var randomID = Math.floor(Math.random() * (max - min + 1)) + min;
        document.getElementById("prescription_id_no").value = randomID;
    }

    // take correspondent ID (wordpress ID not deutche blister) and secretly assign it to the input
    function updateSelectedID() {
        var selectedOption = document.getElementById("patient_select").selectedOptions[0];
        var patientID = selectedOption.getAttribute("data-patientid");
        document.getElementById("user_id").value = patientID;
    }
    </script>