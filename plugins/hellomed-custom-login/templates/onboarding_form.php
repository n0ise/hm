<?php if(is_user_logged_in()) { ?>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">


<div class="hm-auth-wrap">
   <div class="hm-logo">
      <a href="index.php">
      <img src="/wp-content/uploads/2022/05/hel_logo-01.svg">
      </a>
   </div>

   <form id="onboardingForm" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
		
   <div class="hm-auth-form step">
      <div class="row gy-3">
         <div class="col-12">
            <img src="/wp-content/plugins/hellomed-custom-login/assets/images/about_me.svg"></img>
         </div>
         <div class="col-12">
            <div class="h2 m-0">Patienteninformationen</div>
         </div>
         <div class="col-12">
            <div class="progress">
               <div class="progress-bar" style="width: 25%;">Schritt 1/4</div>
            </div>
         </div>

         <?php
         $user = wp_get_current_user();
		   $user_id = $user->ID;

         if ( get_field('patient_caregiver', 'user_' .$user_id) == "caregiver"){ ?>

         <div class="col-12">
            <div class="p-3 bg-light">
               <div class="text-secondary">
                  Sie haben sich im vorherigen Schritt als Angehöriger identifiziert. Bitte nennen
                  Sie uns hier Ihren Namen damit wir Sie später unter diesem kontaktieren können.
               </div>
               <div class="mt-3">
               <div class="form-floating">
                  <input id="patient_first_name" name="patient_first_name" type="text" class="form-control" placeholder=" ">
                  <label for="patient_first_name" >Name des Angehörigen</label>
                  </div>
               </div>
               <div class="mt-3">
               <div class="form-floating">
               <input id="patient_last_name" name="patient_last_name" type="text" class="form-control" placeholder=" ">
                  <label for="patient_last_name" >Nachname des Angehörigen</label>
                 
               </div>
               </div>
            </div>
         </div>

         <?php } ?>

         <div class="col-12">
       
         <!-- <img src="/wp-content/plugins/hellomed-custom-login/assets/images/gender.svg"></img> -->
         <!-- <label class="form-label">Geschlecht</label> -->
            <div class="btn-group d-flex">
               <input type="radio" class="btn-check" name="geschlecht" value="male"  id="radiomale" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiomale">Männlich</label>
               <input type="radio" class="btn-check" name="geschlecht"  value="female" id="radiofemale" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiofemale">Weiblich</label>
               <input type="radio" class="btn-check" name="geschlecht"  value="divers" id="radiodivers" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiodivers">Divers</label>
            </div>
         </div>

         <!-- <div class="col-12">
            <select id="geschlecht" name="geschlecht" class="form-select" aria-label="Default select example">
                <option selected>Geschlecht</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Divers</option>
            </select>
         </div> -->

 
      
               <!-- <h2>Floating label only</h2>

      <div class="form-floating mb-4 d-flex">
      <input 
               type="text"
               class="datepicker_input form-control border-2"
               id="datepicker1"
               required
               placeholder="DD/MM/YYYY">
      <label for="datepicker1">Date input label 1</label>
      </div> -->


         <div class="col-12">
            <div class="form-floating">
                  <input  id="birthdaypicker" name="geburt" type="text" class="form-control" placeholder=" " onblur="birthdaySelectedBlur();" onfocus="birthdaySelected();">
                <label id="birthdaylabel" for="birthdaypicker">Geburtstag</label>
            </div>
         </div>



        <div class="col-12">
            <div class="form-floating">
                <input id="krankheiten" name="krankheiten" type="text" class="form-control" placeholder=" ">
                <label for="krankheiten">Welche Haupterkrankung haben Sie?</label>
            </div>
         </div>
         <div class="col-12">
         <div class="form-floating">
                <input id="allergien" name="allergien" type="text" class="form-control" placeholder=" ">
                <label for="allergien">Haben Sie Allergien?</label>
            </div>
         </div>
         <div class="col-12">
            <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
         </div>
      </div>
   </div>

   <div id="userinfo"  class="hm-auth-form step" style="display: none">
   <div class="row gy-3">
   <div class="col-12">
            <img src="/wp-content/plugins/hellomed-custom-login/assets/images/shipping_adress.svg"></img>
         </div>
      <div class="col-12">
         <div class="h2 m-0">Lieferadresse</div>
      </div>
      <div class="col-12">
         <div class="progress">
            <div class="progress-bar" style="width: 50%;">Schritt 2/4</div>
         </div>
      </div>
      <div class="col-8">
      <div class="form-floating">
         <input id="strase" name="strasse" type="text" class="form-control" placeholder=" ">
             <label for="strase">Straße</label>
         </div>
      </div>
      <div class="col-4">
      <div class="form-floating">
         <input id="strasenr" name="nrno" type="text" class="form-control" placeholder=" ">
             <label for="strasenr">Nr</label>
         </div>
      </div>
      <div class="col-4">
      <div class="form-floating">
         <input id="plz" name="postcode" type="text" class="form-control" placeholder=" ">
             <label for="plz">Postleitzahl</label>
         </div>
      </div>
      <div class="col-8">
         <div class="form-floating">
                 <input id="Ort" name="stadt" type="text" class="form-control" placeholder=" ">
                 <label for="Ort">Wohnort</label>
             </div>
      </div>
      <div class="col-12">
      <div class="form-floating">
         <input id="zusatzinformationen" name="zusatzinformationen" type="text" class="form-control" placeholder=" ">
             <label for="zusatzinformationen">Zusätzliche Lieferinformation</label>
         </div>
      </div>
      <div class="col-12">
      <div class="form-floating">
         <input id="telefon" name="telephone" type="text" class="form-control" placeholder=" ">
             <label for="telefon">Telefonnummer</label>
         </div>
      </div>
   
      <div class="col-12">
         <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
      </div>

   </div>
</div>



<div class="hm-auth-form step" style="display: none">
   <div class="row gy-3">
   <div class="col-12">
            <img src="/wp-content/plugins/hellomed-custom-login/assets/images/prescription2.svg"></img>
         </div>
      <div class="col-12">
         <div class="h2 m-0">Rezeptinformationen</div>
      </div>
      <div class="col-12">
         <div class="progress">
            <div class="progress-bar" style="width: 75%;">Schritt 3/4</div>
         </div>
      </div>


      <div class="col-12">
            <div class="form-floating">
                  <input  id="startdatumpicker" name="geburt" type="text" class="form-control" placeholder=" " onblur="startdatumSelectedBlur();" onfocus="startdatumSelected();">
                <label id="startdatumlabel" for="startdatumpicker">Gewünschtes Startdatum</label>
            </div>
         </div>

      <div class="col-12">
      <label class="form-label">Liegen Ihre Rezepte vor?</label>
      <div class="btn-group d-flex">
               <input type="radio" class="btn-check" name="first_rezept_uploaded" value="1"  id="flexRadioDefault1" autocomplete="off" onclick="ihaverezept();">
               <label class="btn btn-outline-primary" for="flexRadioDefault1">Ja, ich habe sie vor mir</label>
               <input type="radio" class="btn-check" name="first_rezept_uploaded"  value="0" id="flexRadioDefault2" autocomplete="off" onclick="idonthaverezept();">
               <label class="btn btn-outline-primary" for="flexRadioDefault2">Nein, noch nicht</label>
            </div>     
      </div>

         <div class="col-12" id="haveFile" style="display: none;">
            <label class="form-label">Liegen Rezepte oder Medikationsplan vor?</label>
            <div class="btn-group d-flex" onclick="ihavefile();" >
               <input type="radio" class="btn-check" name="rezept_type" value="rezeptfoto"  id="rezeptfoto" autocomplete="off">
               <label class="btn btn-outline-primary" for="rezeptfoto">Rezeptfoto</label>
               <input type="radio" class="btn-check" name="rezept_type"  value="eRezept" id="eRezept" autocomplete="off">
               <label class="btn btn-outline-primary" for="eRezept">E-Rezept</label>
               <input type="radio" class="btn-check" name="rezept_type"  value="medplan" id="medplan" autocomplete="off">
               <label class="btn btn-outline-primary" for="medplan">Medplan</label>
            </div>
         </div>

      <div class="col-12" id="rezepthochladen" style="display: none;">
         <label class="form-label" for="customFile">Rezept hochladen</label>

         <div class="files" id="files1">
            <!-- <div style="padding: 30px; text-align: center; color: #bbb; font-weight: 500; border: 2px dashed #ccc;">Upload field with design we already have</div> -->
            <input type="file" class="form-control" id="customFile" multiple />
            <ul class="fileList"></ul>
         </div>
      </div>



      <div class="col-12">
         <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
      </div>
   </div>
</div>

<div class="hm-auth-form step" style="display: none">
   <div class="row gy-3">
   <div class="col-12">
            <img src="/wp-content/plugins/hellomed-custom-login/assets/images/prescription1.svg"></img>
         </div>
      <div class="col-12">
         <div class="h2 m-0">Versicherungsinformation</div>
      </div>
      <div class="col-12">
         <div class="progress">
            <div class="progress-bar" style="width: 100%;">Schritt 4/4</div>
         </div>
      </div>





      <div class="col-12">
      <label class="form-label">Wie sind sie versichert?</label>
      <div class="btn-group d-flex">
               <input type="radio" class="btn-check" name="privat_or_gesetzlich" value="privat"  id="flexRadioDefault11" autocomplete="off">
               <label class="btn btn-outline-primary" for="flexRadioDefault11">Privat</label>
               <input type="radio" class="btn-check" name="privat_or_gesetzlich"  value="gesetzlich" id="flexRadioDefault22" autocomplete="off">
               <label class="btn btn-outline-primary" for="flexRadioDefault22">Gesetzlich</label>

            </div>
            </div>


      <div class="col-12">
        <div class="form-floating">
            <input id="krankenversicherung" name="insurance_company" type="text" class="form-control" placeholder=" ">
             <label for="krankenversicherung">Name der Krankenversicherung</label>
         </div>
      </div>
     
      <div class="col-12">
        <div class="form-floating">
            <input id="versicherungsnummer" name="insurance_number" type="text" class="form-control" placeholder=" ">
             <label for="versicherungsnummer">Versicherungsnummer (optional)</label>
         </div>
      </div>
      
      <div class="col-12">
         <!-- <button type="button" class="btn btn-primary btn-lg">Weiter</button> -->
         <!-- <button id="save" type="submit" name="submit" class="action submit btn btn-primary btn-lg" style="display: none">Submit</button> -->
      
         <input id="hideInputLog"  type="submit" name="submit" class="register-button"
			       value="<?php _e( 'Submit', 'hellomed-custom-login' ); ?>"/>
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Anmeldung abschließen</label> 
   
      </div>
   </div>
</div>

</form>

   <!-- <div class="card-footer">
      <button class="action back btn btn-sm btn-outline-warning" style="display: none">Back</button> -->
      <!-- <button class="action next btn  btn-primary btn-lg float-end">Next</button>
     <button class="action submit btn btn-sm btn-outline-success float-end" style="display: none">Submit</button> -->
   <!-- </div> -->
</div>



<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="/wp-content/plugins/hellomed-custom-login/assets/js/multistep.js"></script>
<!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.js"></script>

<script>
   function ihaverezept(){
  document.getElementById('haveFile').style.display ='block';
}
function idonthaverezept(){
  document.getElementById('haveFile').style.display = 'none';
  document.getElementById('rezepthochladen').style.display = 'none';

      $('#rezeptfoto').prop('checked', false);
      $('#eRezept').prop('checked', false);
      $('#medplan').prop('checked', false);
    

}

   function ihavefile(){
  document.getElementById('rezepthochladen').style.display ='block';
}

// function idonthaverezept(){
// }

function birthdaySelected(){
  document.getElementById('birthdaylabel').innerHTML = 'dd.mm.yyyy';
}
function birthdaySelectedBlur(){
  document.getElementById('birthdaylabel').innerHTML = 'Geburtstag';
}
function startdatumSelected(){
  document.getElementById('startdatumlabel').innerHTML = 'dd.mm.yyyy';
}
function startdatumSelectedBlur(){
  document.getElementById('startdatumlabel').innerHTML = 'Gewünschtes Startdatum';
}


// $(function(){
// //   $('#geburtstag').datepicker();
// $('#datetimepicker').datepicker({
//     format: 'dd-mm-yyyy',
//     toggleActive: true
// });
// });

// $(document).ready(function(){

// $('#datetimepicker').datepicker({
//     format: 'dd-mm-yyyy',
//     todayHighlight: true,
//     toggleActive: true
// });

// });




$.fn.fileUploader = function (filesToUpload) {
    this.closest(".files").change(function (evt) {

        for (var i = 0; i < evt.target.files.length; i++) {
            filesToUpload.push(evt.target.files[i]);
        };
        var output = [];

        for (var i = 0, f; f = evt.target.files[i]; i++) {
            var removeLink = "<a class=\"removeFile\" href=\"#\" data-fileid=\"" + i + "\">X</a>";

            output.push("<li><strong>", escape(f.name), "</strong> &nbsp; &nbsp; ", removeLink, "</li> ");
        }

        $(this).children(".fileList")
            .append(output.join(""));
    });
};

var filesToUpload = [];

$(document).on("click",".removeFile", function(e){
    e.preventDefault();
    var fileName = $(this).parent().children("strong").text();
     // loop through the files array and check if the name of that file matches FileName
    // and get the index of the match
    for(i = 0; i < filesToUpload.length; ++ i){
        if(filesToUpload[i].name == fileName){
            //console.log("match at: " + i);
            // remove the one element at the index where we get a match
            filesToUpload.splice(i, 1);
        }	
	}
    //console.log(filesToUpload);
    // remove the <li> element of the removed file from the page DOM
    $(this).parent().remove();
});

    $("#files1").fileUploader(filesToUpload);

    $("#uploadBtn").click(function (e) {
        e.preventDefault();
    });







</script>

<style>


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
  background-color: #3546b3;
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

