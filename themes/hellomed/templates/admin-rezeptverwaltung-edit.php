<?php /* Template Name: Admin Rezeptverwaltung Edit */ ?>
<!-- include_once header.php from template  -->
<?php include_once('header.php'); ?>
<!-- show the content if the user is logged in   -->
<?php if(is_user_logged_in() && current_user_can('administrator') || current_user_can('admin_panel') ) { ?>


<!-- and sidebar  -->
<div class="content">



    <?php
// taking values from parameters in the url



$rezept_id = $_GET['rezept'];
$user_id = $_GET['user_id']; 
$rezept_input = get_field('rezept_input', 'user_'.$user_id);
// show new_user_id , which is the user that matches blisterwuerfel
$new_user_id = get_field('new_user_id', 'user_'.$user_id);
// echo $new_user_id;

$filtered_rezept_input = array_filter($rezept_input, function ($record) use ($rezept_id, $user_id) {
  return $record['prescription_id'] == $rezept_id;
});
// var_dump ($rezept_input);


// take data pls

// var_dump($rezept_input);

?>
    <main>
        <div class="container">
            <div class="hm-content">
                <?php  foreach ($filtered_rezept_input as $record) { ?>
                <div class="h2 mb-5">Rezept bearbeiten</div>
                <div class="row gy-4 hm-settings-grid">
                    <div class="col-12">
                        <div class="h3 m-0">User</div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input id="new_user_id" type="text" class="new_user_id form-control"
                                value="<?php echo $new_user_id; ?>">
                            <label>User ID</label>
                        </div>
                    </div>
                    <!-- <div class="col-12">
                        <div class="form-floating">
                            <input id="prescription_id_no" type="text" class="form-control"
                                value="<?php echo $record['prescription_id']; ?>">
                            <label>Prescription ID</label>
                        </div>
                    </div> -->
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Blisterjob</div>
                    </div>
                    <?php 
    if (!empty($record['blister_job'])) {
      foreach ($record['blister_job'] as $blister_job) {

  ?>

                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_job_id" type="text" class="blister_job_id form-control"
                                value="<?php echo $blister_job['blister_job_id'] ?>">
                            <label>Blisterjob ID</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_start_date" type="date"
                                class=" blister_start_date form-control date-convert"
                                value="<?php echo $blister_job['blister_start_date'] ?>">
                            <label>Start</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="blister_end_date" type="date" class="blister_end_date form-control date-convert"
                                value="<?php echo $blister_job['blister_end_date'] ?>">
                            <label>Ende</label>
                        </div>
                    </div>

                    <?php  } 
                      }
                    ?>
                    <!-- div where will be added new blister jobs on click  -->

                    <div class="blister_ph"></div>
                    <?php
                }
                     ?>

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
                            <input id="doctor_name" type="text" class="form-control"
                                value="<?php echo $record['doctor_name']; ?>">
                            <label>Arzt</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Rezept</div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_date_by_doctor" type="date" class="form-control"
                                value="<?php echo $record['prescription_date_by_doctor']; ?>">
                            <label>Verschreibungsdatum</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_start_date" type="date" class="form-control"
                                value="<?php echo $record['prescription_start_date']; ?>" ?>
                            <label>Start</label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-floating">
                            <input id="prescription_end_date" type="date" class="form-control"
                                value="<?php echo $record['prescription_end_date']; ?>">
                            <label>Ende</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Medikamente</div>
                    </div>
                    <?php
                if (!empty($record['medicine_section'])) {
                    foreach ($record['medicine_section'] as $medicine) {?>
                    <div class="col-12 col-md-9">
                        <div class="form-floating">
                            <input id="medicine_name_pzn" type="text" class="form-control medicine_name_pzn"
                                value="<?php echo $medicine['medicine_name_pzn']; ?>" list="medicine-options">
                            <label>Medikament</label>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="form-floating">
                            <input id="medicine_amount" type="number" class="form-control medicine_amount"
                                value="<?php echo $medicine['medicine_amount']; ?>" step="1" min="0">
                            <label>Menge</label>
                        </div>

                    </div>
                    <?php
                    }
                }
                ?>
                    <div class="medikament_ph"></div>
                    <datalist id="medicine-options"></datalist>

                    <div class="col-12 d-flex justify-content-center">
                        <button id="add_medicine_div" type="button" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle-fill me-2"></i>
                            Medikament
                        </button>
                    </div>
                    <?php
                    //checking if the user have a rezept_file with rezept_type named medplan 
                    // and show a download in case, with file_url as a value   
                    $medplan_files = array();
                    $erezept_files = array();
                    if($rezept_input){
                        foreach($rezept_input as $input){
                            if( $input['prescription_id'] === $rezept_id){
                                foreach($input['rezept_file'] as $file){
                                    if(strpos($file['rezept_type'], 'medplan') !== false ){
                                        $medplan_files[] = $file['file_url'];
                                    }
                                    if(strpos($file['rezept_type'], 'erezept') !== false || strpos($file['rezept_type'], 'rezeptfoto') !== false){
                                        $erezept_files[] = $file['file_url'];
                                    }
                                }
                            }
                        }
                    }
                    if(!empty($medplan_files)): ?>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Medikationsplan</div>
                    </div>
                    <?php $counter = 1; 
      foreach($medplan_files as $file): ?>
                    <div class="col-12">
                        Es wurde ein Medikationsplan für dieses Rezept hochgeladen:
                        <a class="modal_m" href="javascript:void(0)" data-toggle="modal"
                            data-target="#medplanPreviewModal<?php echo $counter; ?>">Vorschau</a> |
                        <a href="<?php echo $file; ?>" download>Download</a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="medplanPreviewModal<?php echo $counter; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="medplanPreviewModalLabel" aria-hidden="true">
                        <div class="modal-rezept modal-dialog modal-lg modal-dialog-center" role="document">
                            <div class="modal-content p-5 pt-4">
                                <div class="modal-header p-0 border-0">
                                    <h5 class="modal-title pt-1 fs-3" id="medplanPreviewModalLabel">Medikationsplan Vorschau</h5>
                                    <button type="button" class="btn-close modal-close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="modal-img mt-3 mb-4">
                                        <img src="<?php echo $file; ?>" alt="Medikationsplan Vorschau">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; endforeach; ?>

                    <?php else: ?>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Medikationsplan</div>
                    </div>
                    <div class="col-12">
                        Es wurde kein Medikationsplan für diesen Patient hochgeladen.
                    </div>
                    <?php endif; ?>

                    <?php $counter = 0; ?>
                    <?php if(!empty($erezept_files)): ?>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Rezeptfelder</div>
                    </div>
                    <?php
        if (count($erezept_files) > 1) {
            echo "<div class='col-12'> Es wurden " . count($erezept_files) . " Rezeptfelder für dieses Rezept hochgeladen:</div>";
        } else {
            echo "<div class='col-12'> Es wurde " . count($erezept_files) . " Rezeptfelder für dieses Rezept hochgeladen:</div>";
        }
        foreach($erezept_files as $file): 
    ?>
                    <div class="col-12">
                        <a class="modal_r" href="javascript:void(0)" data-toggle="modal"
                            data-target=".erezeptPreviewModal<?php echo $counter; ?>">Vorschau</a> |
                        <a href="<?php echo $file; ?>" download>Download</a>
                    </div>
                    <div class="modal fade erezeptPreviewModal<?php echo $counter; ?>" tabindex="-1" role="dialog"
                        aria-labelledby="erezeptPreviewModalLabel" aria-hidden="true">
                        <div class="modal-rezept modal-dialog modal-lg modal-dialog-center" role="document">
                            <div class="modal-content p-5 pt-4">
                                <div class="modal-header p-0 border-0">
                                    <h5 class="modal-title pt-1 fs-3" id="erezeptPreviewModalLabel">Rezept Vorschau</h5>
                                    <button type="button" class="btn-close modal-close" data-dismiss="modal"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="modal-img mt-3 mb-4">
                                        <img src="<?php echo $file; ?>" alt="Rezept Vorschau">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php $counter++; ?>
                    <?php endforeach; ?>

                    <?php else: ?>
                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Rezept File</div>
                    </div>
                    <div class="col-12">
                        Es wurde kein Rezept File für dieses Rezept hochgeladen.
                    </div>
                    <?php endif; ?>

                    <div class="col-12">
                        <div class="h3 m-0 mt-5">Status</div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select id="status_prescription" class="form-select">
                                <?php
                                    $status_prescription = array('Aktiv', 'Wartend','Gefährdet', 'Inaktiv');
                                    $selected_status_prescription = $record['status_prescription'];
                                    if (!$selected_status_prescription) {
                                        echo '<option value="" disabled selected>Bitte Wählen</option>';
                                    }
                                    foreach ($status_prescription as $value_status_prescription) {
                                        if($selected_status_prescription == $value_status_prescription) {
                                            echo '<option value="' . $value_status_prescription . '" selected>' . $value_status_prescription . '</option>';
                                        } else {
                                            echo '<option value="' . $value_status_prescription . '">' . $value_status_prescription . '</option>';
                                        }
                                    }
                                ?>
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
            var prescription_id = $('#prescription_id').val();
            var doctor_name = $('#doctor_name').val();
            var prescription_date_by_doctor = $('#prescription_date_by_doctor').val();
            var prescription_start_date = $('#prescription_start_date').val();
            var prescription_end_date = $('#prescription_end_date').val();
            // var medicine_name_pzn = $('#medicine_name_pzn').val();
            // var medicine_amount = $('#medicine_amount').val();
            var status_prescription = $('#status_prescription').val();
            var new_user_id = $('#new_user_id').val();

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
                'action': 'edit_patient',
                // 'blister_job_id': blister_job_id,
                // 'blister_start_date': blister_start_date,
                // 'blister_end_date': blister_end_date,
                'prescription_id': prescription_id,
                'doctor_name': doctor_name,
                'prescription_date_by_doctor': prescription_date_by_doctor,
                'prescription_start_date': prescription_start_date,
                'prescription_end_date': prescription_end_date,
                // 'medicine_name_pzn': medicine_name_pzn,
                // 'medicine_amount': medicine_amount,
                'prescription_id': prescription_id,
                'status_prescription': status_prescription,
                'blister_jobs': blister_jobs,
                'medikament': medikament,
                'new_user_id': new_user_id,
                'rezept_id': <?php echo $rezept_id; ?>,
                'user_id': <?php echo $user_id; ?>
            }
            console.log(data);
            // count blister_jobs, debug
            var count = Object.keys(blister_jobs).length;
            console.log(count);
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



            });
        });
    });

    // modal for Files, for medikationplan and rezept
    // $('#exampleModalCenter').on('show.bs.modal', function() {
    //     console.log('Modal is being triggered');
    // });
    $(document).ready(function() {
        $('#exampleModalCenter').modal({
            show: false
        });

        $('.modal_m').on('click', function() {
            let targetModalId = $(this).data('target');
            $(targetModalId).modal('show');
        });

        $('.modal_r').on('click', function() {
            var modalId = $(this).data("target");
            $(modalId).modal('show');
        });
    });
    // closiiing tiiime 🎶
    $('.modal-close').on('click', function() {
    var modal = $(this).closest('.modal');
    modal.modal('hide');
});
    </script>