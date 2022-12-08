<?php if(is_user_logged_in()) { ?>

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
               <input id="patient_first_name" name="patient_first_name" type="text" class="form-control py-2" placeholder=" ">
                  <label for="patient_first_name" class="form-label">Name des Angehörigen</label>
                
                  </div>
               </div>
               <div class="mt-3">
               <div class="form-floating">
               <input id="patient_last_name" name="patient_last_name" type="text" class="form-control py-2" placeholder=" ">
                  <label for="patient_last_name" class="form-label">Nachname des Angehörigen</label>
                 
               </div>
               </div>
            </div>
         </div>

         <?php } ?>

         <div class="col-12">
            <div class="btn-group d-flex">
               <input type="radio" class="btn-check" name="geschlecht" value="male"  id="radiomale" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiomale">Männlich</label>
               <input type="radio" class="btn-check" name="geschlecht"  value="female" id="radiofemale" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiofemale">Weiblich</label>
               <input type="radio" class="btn-check" name="geschlecht"  value="divers" id="radiodivers" autocomplete="off">
               <label class="btn btn-outline-primary" for="radiodivers">Taucher</label>
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

         <div class="col-12">
            <div class="form-floating">
                  <input  id="geburtstag" name="geburt" type="date" class="form-control" placeholder=" ">
                <label for="geburtstag">Geburtstag</label>
            </div>
         </div>
         <div class="col-12">
            <div class="form-floating">
                <input id="krankheiten" name="krankheiten" type="text" class="form-control" placeholder=" ">
                <label for="krankheiten">Krankheiten</label>
            </div>
         </div>
         <div class="col-12">
         <div class="form-floating">
                <input id="allergien" name="allergien" type="text" class="form-control" placeholder=" ">
                <label for="allergien">Allergien</label>
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
             <label for="plz">PLZ</label>
         </div>
      </div>
      <div class="col-8">
         <div class="form-floating">
                 <input id="Ort" name="stadt" type="text" class="form-control" placeholder=" ">
                 <label for="Ort">Ort</label>
             </div>
      </div>
      <div class="col-12">
      <div class="form-floating">
         <input id="zusatzinformationen" name="zusatzinformationen" type="text" class="form-control" placeholder=" ">
             <label for="zusatzinformationen">Zusatzinformationen</label>
         </div>
      </div>
      <div class="col-12">
      <div class="form-floating">
         <input id="telefon" name="telephone" type="text" class="form-control" placeholder=" ">
             <label for="telefon">Telefon</label>
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
         <div class="h2 m-0">Rezeptinformationen</div>
      </div>
      <div class="col-12">
         <div class="progress">
            <div class="progress-bar" style="width: 75%;">Schritt 3/4</div>
         </div>
      </div>
      <div class="col-12">
      <div class="form-floating">
         <input id="startdatum" name="start_date" type="date" class="form-control" placeholder=" ">
             <label for="startdatum">Hellomed Startdatum</label>
         </div>
      </div>
   
      <div class="col-12">
         <label class="form-label"><b>Liegen Ihre Rezepte vor?</b></label>
         <div class="form-check">
            <input class="form-check-input" type="radio" name="first_rezept_uploaded" id="flexRadioDefault1" value="1">
            <label class="form-check-label" for="flexRadioDefault1">Ja, ich habe sie vor mir</label>
         </div>
         <div class="form-check">
            <input class="form-check-input" type="radio" name="first_rezept_uploaded" id="flexRadioDefault2" value="0">
            <label class="form-check-label" for="flexRadioDefault2">Nein, noch nicht</label>
         </div>
      </div>
      <div class="col-12">
         <label class="form-label" for="customFile"><b>Rezept hochladen</b></label>

         <!-- <div style="padding: 30px; text-align: center; color: #bbb; font-weight: 500; border: 2px dashed #ccc;">Upload field with design we already have</div> -->
      <input type="file" class="form-control" id="customFile" />

        </div>
      <div class="col-12">
         <button type="button" class="action next btn btn-primary btn-lg">Weiter</button>
      </div>
   </div>
</div>



<div class="hm-auth-form step" style="display: none">
   <div class="row gy-3">
      <div class="col-12">
         <div class="h2 m-0">Versicherungsinformation</div>
      </div>
      <div class="col-12">
         <div class="progress">
            <div class="progress-bar" style="width: 100%;">Schritt 4/4</div>
         </div>
      </div>
      <div class="col-12">
         <label class="form-label"><b>Wie sind sie versichert?</b></label>
         <div class="form-check">
            <input class="form-check-input" type="radio" name="privat_or_gesetzlich" id="flexRadioDefault11" value="privat">
            <label class="form-check-label" for="flexRadioDefault11">Privat</label>
         </div>
         <div class="form-check">
            <input class="form-check-input" type="radio" name="privat_or_gesetzlich" id="flexRadioDefault22" value="gesetzlich">
            <label class="form-check-label" for="flexRadioDefault22">Gesetzlich</label>
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
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Submit</label> 
   
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




<?php } 
else { ?>

    <?php header("url=/anmelden"); 
}

?>

