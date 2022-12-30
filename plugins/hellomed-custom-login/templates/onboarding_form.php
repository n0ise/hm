
<?php if(is_user_logged_in()) { ?>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">

 <link href="wp-content/themes/hellomed/assets/css/uppy.min.css" rel="stylesheet">

   <div class="hm-auth-wrap">
    <div class="hm-logo">
        <a href="index.php">
            <img src="/wp-content/uploads/2022/05/hel_logo-01.svg" />
        </a>
    </div>



     <form id="onboardingForm" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data">
        <div class="hm-auth-form step">
            <div class="row gy-3">
        
            <div class="col-12">
                <div class="h3 mb-3">
            <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/about_me.svg">
            Patienteninformationen
            <i class="bi bi-info-circle"
                data-bs-toggle="tooltip" data-placement="top"
                title="Wir benötigen nur noch wenige patient:innenrelevante Informationen von dir,
    damit dich unsere Apotheker:innen beim Start mit hellomed bestmöglichst beraten können.">  </i>
            </div>
        </div>


                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar" style="width: 25%;">Schritt 1/4</div>
                    </div>
                </div>

                <?php
         $user = wp_get_current_user();
		   $user_id = $user->ID; if ( get_field('patient_caregiver', 'user_' .$user_id) == "caregiver"){ ?>

                <div class="col-12">
                    <div class="p-3 bg-light">
                        <div class="text-secondary">
                            Sie haben sich im vorherigen Schritt als Angehöriger identifiziert. Bitte nennen Sie uns hier Ihren Namen damit wir Sie später unter diesem kontaktieren können.
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <input id="patient_first_name" name="patient_first_name" type="text" class="form-control" placeholder=" " />
                                <label for="patient_first_name">Name des Angehörigen</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <input id="patient_last_name" name="patient_last_name" type="text" class="form-control" placeholder=" " />
                                <label for="patient_last_name">Nachname des Angehörigen</label>
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>

                <div class="col-12">
                    <div class="btn-group d-flex">
                        <input type="radio" class="btn-check" name="geschlecht" value="male" id="radiomale" autocomplete="off" />
                        <label class="btn btn-outline-primary" for="radiomale">Männlich</label>
                        <input type="radio" class="btn-check" name="geschlecht" value="female" id="radiofemale" autocomplete="off" />
                        <label class="btn btn-outline-primary" for="radiofemale">Weiblich</label>
                    </div>
                </div>


   

                <div class="col-12">
                    <div class="form-floating">
                        <input id="birthdaypicker" name="geburt" type="text" class="form-control" placeholder=" " onblur="birthdaySelectedBlur();" onfocus="birthdaySelected();" />
                        <label id="birthdaylabel" for="birthdaypicker">Was ist Ihr Geburtsdatum?</label>
                    </div>
                </div>


                <div class="col-12">
                    <div class="form-floating">
                        <input id="krankheiten" name="krankheiten" type="text" class="form-control" placeholder=" " />
                        <label for="krankheiten">Welche Haupterkrankungen haben Sie?</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input id="allergien" name="allergien" type="text" class="form-control" placeholder=" " />
                        <label for="allergien">Haben Sie Allergien oder Unverträglichkeiten?</label>
                    </div>
                </div>
                <div class="col-12">
                    <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
                </div>
            </div>
        </div>

        <div id="userinfo" class="hm-auth-form step" style="display: none;">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="h3 mb-3">
                    <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/shipping_adress.svg">
                    Anschrift & Lieferadresse
                    </div>
                </div>


                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar" style="width: 50%;">Schritt 2/4</div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="strase" name="strasse" type="text" class="form-control" placeholder=" " />
                        <label for="strase">Straße</label>
                    </div>
                </div>
                <div class="col-4 ps-0">
                    <div class="form-floating">
                        <input id="strasenr" name="nrno" type="text" class="form-control" placeholder=" " />
                        <label for="strasenr">Nr</label>
                    </div>
                </div>
                <div class="col-4 pe-0">
                    <div class="form-floating">
                        <input id="plz" name="postcode" type="text" class="form-control" placeholder=" " />
                        <label for="plz">Postleitzahl</label>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-floating">
                        <input id="Ort" name="stadt" type="text" class="form-control" placeholder=" " />
                        <label for="Ort">Wohnort</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input id="zusatzinformationen" name="zusatzinformationen" type="text" class="form-control" placeholder=" " />
                        <label for="zusatzinformationen">Haben Sie zusätzliche Lieferhinweise?</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input id="telefon" name="telephone" type="text" class="form-control" placeholder=" " />
                        <label for="telefon">Was ist Ihre Telefonnummer?</label>
                    </div>
                </div>

                <div class="col-12">
                    <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
                </div>
            </div>
        </div>

        <div class="hm-auth-form step" style="display: none;">
            <div class="row gy-3">

                <div class="col-12">
        <div class="h3 mb-3">
          <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/prescription2.svg">
          Rezeptinformationen
        </div>
      </div>

                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar" style="width: 75%;">Schritt 3/4</div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="form-floating">
                        <input id="startdatumpicker" name="geburt" type="text" class="form-control" placeholder=" " onblur="startdatumSelectedBlur();" onfocus="startdatumSelected();" />
                        <label id="startdatumlabel" for="startdatumpicker">Was ist Ihr Wunsch-Startdatum?</label>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Liegen Ihre Rezepte bereits vor?</label>
                    <div class="btn-group d-flex">
                        <input type="radio" class="btn-check" name="first_rezept_uploaded" value="1" id="flexRadioDefault1" autocomplete="off" onclick="ihaverezept();" />
                        <label class="btn btn-outline-primary" for="flexRadioDefault1">Ja, liegen vor</label>
                        <input type="radio" class="btn-check" name="first_rezept_uploaded" value="0" id="flexRadioDefault2" autocomplete="off" checked onclick="idonthaverezept();" />
                        <label class="btn btn-outline-primary" for="flexRadioDefault2">Nein, noch nicht</label>
                    </div>
                </div>

                <div class="col-12" id="haveFile" style="display: none;">
                    <label class="form-label">Liegen Rezepte oder Medikationsplan vor?</label>
                    <div class="btn-group d-flex">
                        <input type="radio" class="btn-check" name="rezept_type" value="rezeptfoto" id="rezeptfoto" autocomplete="off" checked onclick="ihaveRezeptfoto();"/>
                        <label class="btn btn-outline-primary" for="rezeptfoto">Rezeptfoto</label>
                        <input type="radio" class="btn-check" name="rezept_type" value="eRezept" id="eRezept" autocomplete="off" onclick="ihaveeRezept();" />
                        <label class="btn btn-outline-primary" for="eRezept">E-Rezept</label>
                        <input type="radio" class="btn-check" name="rezept_type" value="medplan" id="medplan" autocomplete="off" onclick="ihaveMedplan();" />
                        <label class="btn btn-outline-primary" for="medplan">Medikationsplan</label>
                    </div>
                </div>

                <div class="col-12" id="rezepthochladen"  style="display: none;">
                    <label id="rezeptlabel"class="form-label">Rezept hochladen</label>


                    <div id="drag-drop-area"></div> 

                        <!-- <div class="dropzone" id="mydropzone">

                           <div class="dz-message d-flex flex-column" style="width:100%">
                           
                           <span class="upload-area-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="340.531" height="419.116" viewBox="0 0 340.531 419.116">
                                        <g id="files-new" clip-path="url(#clip-files-new)">
                                            <path
                                                id="Union_2"
                                                data-name="Union 2"
                                                d="M-2904.708-8.885A39.292,39.292,0,0,1-2944-48.177V-388.708A39.292,39.292,0,0,1-2904.708-428h209.558a13.1,13.1,0,0,1,9.3,3.8l78.584,78.584a13.1,13.1,0,0,1,3.8,9.3V-48.177a39.292,39.292,0,0,1-39.292,39.292Zm-13.1-379.823V-48.177a13.1,13.1,0,0,0,13.1,13.1h261.947a13.1,13.1,0,0,0,13.1-13.1V-323.221h-52.39a26.2,26.2,0,0,1-26.194-26.195v-52.39h-196.46A13.1,13.1,0,0,0-2917.805-388.708Zm146.5,241.621a14.269,14.269,0,0,1-7.883-12.758v-19.113h-68.841c-7.869,0-7.87-47.619,0-47.619h68.842v-18.8a14.271,14.271,0,0,1,7.882-12.758,14.239,14.239,0,0,1,14.925,1.354l57.019,42.764c.242.185.328.485.555.671a13.9,13.9,0,0,1,2.751,3.292,14.57,14.57,0,0,1,.984,1.454,14.114,14.114,0,0,1,1.411,5.987,14.006,14.006,0,0,1-1.411,5.973,14.653,14.653,0,0,1-.984,1.468,13.9,13.9,0,0,1-2.751,3.293c-.228.2-.313.485-.555.671l-57.019,42.764a14.26,14.26,0,0,1-8.558,2.847A14.326,14.326,0,0,1-2771.3-147.087Z"
                                                transform="translate(2944 428)"
                                                fill="var(--color-hellomed)"
                                            />
                                        </g>
                                    </svg>
                                </span>
                                <span class="upload-area-title">Wählen Sie eine Datei aus oder ziehen Sie hierher</span>
                           </div>
                        </div>  -->
                </div>

                <div class="col-12">
                    <button type="button" id="submit-dropzone" class="action next btn btn-primary btn-lg">Weiter</button>
                </div>
            </div>
        </div>

        <div class="hm-auth-form step" style="display: none;">
            <div class="row gy-3">

                <div class="col-12">
                    <div class="h3 mb-3">
                    <img src="/wp-content/themes/hellomed/assets/img/icons/onboarding/prescription1.svg">
                    Versicherungsinformation
                    </div>
                </div>
                <div class="col-12">
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%;">Schritt 4/4</div>
                    </div>
                </div>

                <div class="col-12">
                    <label class="form-label">Wie sind sie versichert?</label>
                    <div class="btn-group d-flex">
                        <input type="radio" class="btn-check" name="privat_or_gesetzlich" value="privat" id="flexRadioDefault11" autocomplete="off" />
                        <label class="btn btn-outline-primary" for="flexRadioDefault11">Privat</label>
                        <input type="radio" class="btn-check" name="privat_or_gesetzlich" value="gesetzlich" checked id="flexRadioDefault22" autocomplete="off" />
                        <label class="btn btn-outline-primary" for="flexRadioDefault22">Gesetzlich</label>
                    </div>
                </div>

                <!-- <div class="col-12">
                    <div class="form-floating">
                        <input id="krankenversicherung" name="insurance_company" type="text" class="form-control" placeholder=" " />
                        <label for="krankenversicherung">Wie heißt Ihre Krankenversicherung?</label>
                    </div>
                </div> -->

                <div class="col-12">
                    <div class="form-floating">
                        <input id="krankenversicherung" name="insurance_company" type="text" class="form-control insurance_company" placeholder=" " />
                        <label for="krankenversicherung">Wie heißt Ihre Krankenversicherung?</label>
                    </div>
                    <div id="filter-records"></div>
                
                </div>


                <!-- <div class="col-12">
                    <div class="form-floating">
                        <input id="versicherungsnummer" name="insurance_number" type="text" class="form-control" placeholder=" " />
                        <label for="versicherungsnummer">Versicherungsnummer (optional)</label>
                    </div>
                </div> -->

                <div class="col-12">
                  
                    <input id="hideInputLog" type="submit" name="submit" class="register-button" value="<?php _e( 'Submit', 'hellomed-custom-login' ); ?>" />
                    <label for="hideInputLog" class="btn btn-primary btn-lg">Anmeldung abschließen</label>
                </div>
            </div>
        </div>
    </form>

</div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/hellomed-custom-login/assets/js/multistep.js"></script>
<script type="text/javascript" src="/wp-content/plugins/hellomed-custom-login/assets/js/search-function.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.de.min.js" integrity="sha512-3V4cUR2MLZNeqi+4bPuXnotN7VESQC2ynlNH/fUljXZiQk1BGowTqO5O2gElABNMIXzzpYg5d8DxNoXKlM210w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<!-- <script src="https://releases.transloadit.com/uppy/v3.3.1/uppy.min.js"></script> -->


<!-- <button type="button" class="btn btn-primary btn-lg">Weiter</button> -->
<!-- <button id="save" type="submit" name="submit" class="action submit btn btn-primary btn-lg" style="display: none">Submit</button> -->


  <!-- <div class="card-footer">
      <button class="action back btn btn-sm btn-outline-warning" style="display: none">Back</button> -->
    <!-- <button class="action next btn  btn-primary btn-lg float-end">Next</button>
     <button class="action submit btn btn-sm btn-outline-success float-end" style="display: none">Submit</button> -->
    <!-- </div> -->
    <script type="module">
                        import {Uppy, Dashboard, XHRUpload, Tus, Webcam} from "https://releases.transloadit.com/uppy/v3.3.1/uppy.min.mjs"
                        var uppy = new Uppy()
                      
                            .use(Dashboard, {
                                inline: true,
                                height: 500,
                                proudlyDisplayPoweredByUppy:false,
                                target: '#drag-drop-area'
                            })
                        
                            .use(Webcam, { 
                                target: Dashboard,
                                onBeforeSnapshot: () => Promise.resolve(),
                                countdown: false,
                                modes: [
                                    'picture',
                                ],
                                mirror: false,
                                showVideoSourceDropdown: false,
                                /** @deprecated Use `videoConstraints.facingMode` instead. */
                                facingMode: 'environment',
                                videoConstraints: {
                                    facingMode: 'environment',
                                },
                                preferredImageMimeType: null,
                                preferredVideoMimeType: null,
                                showRecordingLength: false,
                                mobileNativeCamera: false,
                                locale: {},

                            })
                       
                            .use(Tus, {endpoint: '/wp-content/themes/hellomed/uploads'})
                        
                            // .use(XHRUpload, {endpoint: '/wp-content/uploads/rezepte'})
                       
                            uppy.on('complete', (result) => {
                            console.log('Upload complete! We’ve uploaded these files:', result.successful)
                            })

                        </script>

<script>
   


 </script>

<style>

            #Webcam-overlay{
                    position: absolute;
                    /* top: 2px; 
                     right: 2px; */
                    z-index: 100;
                    max-width: 95%;
                    max-height: 95%;
                    /* padding: 5px; */
                    object-fit: contain;
                    opacity: 0.3;
                    left: 0;
                    right: 0;
                    top: 0;
                    bottom: 0;
                    margin: auto;
            }


    </style>

  

<script>



   function ihaverezept(){
  document.getElementById('haveFile').style.display ='block';
  document.getElementById('rezepthochladen').style.display ='block';
    document.getElementById('rezeptlabel').innerHTML = 'Rezeptfoto hochladen';
     $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay1.png)");
     $('#rezeptfoto').prop('checked', true);

}

function idonthaverezept(){
  document.getElementById('haveFile').style.display = 'none';
  document.getElementById('rezepthochladen').style.display = 'none';
      $('#rezeptfoto').prop('checked', false);
      $('#eRezept').prop('checked', false);
      $('#medplan').prop('checked', false);
}

                    $(document).ready(function() {
                    $(document.body).on('click', 'button[data-cy="Webcam"]' ,function(){
                    // $('button[data-cy="Webcam"]').on("click", function () {
                    runAfterElementExists(".uppy-Webcam-videoContainer", function() {
                        $('.uppy-Webcam-videoContainer').append('<div id="Webcam-overlay"></div>');


                        runAfterElementExists(".uppy-Webcam-video", function() {
                                    var video = $(".uppy-Webcam-video" ); //JQuery selector 
        
                                    $("#Webcam-overlay").css("aspect-ratio", video[0].videoWidth+ '/' +video[0].videoHeight);
                                    // $("#Webcam-overlay").css("height",video[0].videoHeight+'px');
                                    // $("#Webcam-overlay").css("width",video[0].videoWidth+'px');
                        })

                        if($('#rezeptfoto').is(':checked'))
                            {
                                ihaveRezeptfoto();
                            }else if($('#eRezept').is(':checked'))
                            {
                            ihaveeRezept();
                            }
                            else
                            {
                            ihaveMedplan();
                            }
                        });
                    });
                    })



function runAfterElementExists(jquery_selector,callback){
    var checker = window.setInterval(function() {
     if ($(jquery_selector).length) {
        clearInterval(checker);
        callback();
        }}, 200); 
}

function ihaveRezeptfoto(){
  document.getElementById('rezepthochladen').style.display ='block';
    document.getElementById('rezeptlabel').innerHTML = 'Rezeptfoto hochladen';
     $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay1.png)");



}
function ihaveeRezept(){
  document.getElementById('rezepthochladen').style.display ='block';
  document.getElementById('rezeptlabel').innerHTML = 'e-Rezept hochladen';
    $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay2.png)");
  
}
function ihaveMedplan(){
  document.getElementById('rezepthochladen').style.display ='block';
  document.getElementById('rezeptlabel').innerHTML = 'Medplan hochladen';
    $("#Webcam-overlay").css("content","url(wp-content/themes/hellomed/assets/img/icons/onboarding/Overlay3.png)");
}
                     


// function idonthaverezept(){
// }

function birthdaySelected(){
  document.getElementById('birthdaylabel').innerHTML = 'tt.mm.jjjj';
}
function birthdaySelectedBlur(){
  document.getElementById('birthdaylabel').innerHTML = 'Was ist Ihr Geburtsdatum?';
}
function startdatumSelected(){
  document.getElementById('startdatumlabel').innerHTML = 'tt.mm.jjjj';
}
function startdatumSelectedBlur(){
  document.getElementById('startdatumlabel').innerHTML = 'Was ist Ihr Wunsch-Startdatum?';
}


</script>

<script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
</script>

<style>





.uppy-Root {
	/* border: none; */
	/* background-color: transparent;

	display: flex;
	flex-wrap: wrap;
   justify-content: center;
   align-content: center; */
   border: 2px dashed #40404652;
   border-radius: 0.375rem;
 
}

.dropzone .dz-message {
    margin: 0;
}

.uppy-Root:hover, .uppy-Root:focus {
   border: 2px dashed var(--color-hellomed);
   
}









.upload-area-icon {
	display: block;
	width: 2.25rem;
	height: 2.25rem;
   margin-left: auto;
  margin-right: auto;
  width: 50%;
}
.upload-area-icon svg {
	max-height: 100%;
	max-width: 100%;
}
.upload-area-title {
	margin-top: 1rem;
	display: block;
}









.img-search{
        max-width:100%;
}











/*Bootstrap Calendar*/
.datepicker {
    border-radius: 0;
    padding: 0;
}
.datepicker-days table thead, .datepicker-days table tbody, .datepicker-days table tfoot {
    padding: 10px;
    display: list-item;
}
.datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
    background: var(--color-hellomed);
    color: #ffffff;
    border-radius: 0;
}
.datepicker-days table thead tr:nth-child(2n+0) td, .datepicker-days table thead tr:nth-child(2n+0) th {
    border-radius: 3px;
}
.datepicker-days table thead tr:nth-child(3n+0) {
    text-transform: uppercase;
    font-weight: 300 !important;
    font-size: 12px;
    color: rgba(255, 255, 255, 0.7);
}
.table-condensed > tbody > tr > td, .table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > td, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > td, .table-condensed > thead > tr > th {
    padding: 11px 13px;

}

.table-condensed > tbody > tr > th, .table-condensed > tfoot > tr > th, .table-condensed > thead > tr > th {
    color: #fff;
}

.datepicker table tr td.active.active {
    background-color: var(--color-hellomed);
}

.datepicker-months table thead td, .datepicker-months table thead th, .datepicker-years table thead td, .datepicker-years table thead th, .datepicker-decades table thead td, .datepicker-decades table thead th, .datepicker-centuries table thead td, .datepicker-centuries table thead th {
    border-radius: 0;
}

.datepicker td, .datepicker th {
    border-radius: 50%;
    padding: 0 12px;
}
.datepicker-days table thead, .datepicker-months table thead, .datepicker-years table thead, .datepicker-decades table thead, .datepicker-centuries table thead {
    background: var(--color-hellomed);
    color: #ffffff;
    border-radius: 0;
}
.datepicker table tr td.active, .datepicker table tr td.active:hover, .datepicker table tr td.active.disabled, .datepicker table tr td.active.disabled:hover {
    background-image: none;
}
.datepicker .prev, .datepicker .next {
    color: rgba(255, 255, 255, 0.5);
    transition: 0.3s;
    width: 37px;
    height: 37px;
}
.datepicker .prev:hover, .datepicker .next:hover {
    background: transparent;
    color: rgba(255, 255, 255, 0.99);
    font-size: 21px;
}
.datepicker .datepicker-switch {
    font-size: 24px;
    font-weight: 400;
    transition: 0.3s;
}
.datepicker .datepicker-switch:hover {
    color: rgba(255, 255, 255, 0.7);
    background: transparent;
}
.datepicker table tr td span {
    border-radius: 2px;
    margin: 3%;
    width: 27%;
}
.datepicker table tr td span.active, .datepicker table tr td span.active:hover, .datepicker table tr td span.active.disabled, .datepicker table tr td span.active.disabled:hover {
  background-color: var(--color-hellomed);
  background-image: none;
}
.dropdown-menu {
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 6px 12px rgba(0,0,0,.175);
}
.datepicker-dropdown.datepicker-orient-top:before {
    border-top: 7px solid rgba(0,0,0,.1);
}
</style>

<?php } 
else { ?>
    <?php header("Refresh:0; url=/anmelden"); 
}

?>

