<div class="hm-auth-wrap">
  <div class="hm-logo">
    <a href="index.php">
	<img src="/wp-content/uploads/2022/05/hel_logo-01.svg">
    </a>
  </div>

	<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
		
	<div class="hm-auth-form my-4">
    <div class="row gy-3">
      <div class="col-12">
      <div class="h3 mb-3">Registrierung
        <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Registrieren Sie sich oder einen Angehörigen als Patient bei hellomed. Die Registrierung dauert nur wenige Minuten. Unsere hellomed Apotheker melden Sich nach der Registrierung bei Ihnen innerhalb von 48 Stunden telefonisch"> </i>
        </div>
      </div>
	


		<div class="col-12">
       <label class="form-label">Sind Sie Patient oder Angehöriger?</label>
        <div class="btn-group d-flex">
          <input required type="radio" class="btn-check" name="patientcaregiverid" value="patient"  id="patientcaregiverid1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="patientcaregiverid1">Patient</label>
          <input type="radio" class="btn-check" name="patientcaregiverid"  value="caregiver" id="patientcaregiverid2" autocomplete="off">
          <label class="btn btn-outline-primary" for="patientcaregiverid2">Angehöriger</label>
        </div>
      </div>


	  <div class="col-12">
        <div class="form-floating">
			
			<input required  class="form-control" type="text" name="first_name" id="first-name" required="required" placeholder=" ">
			<label for="first_name"><?php _e( 'Ihr Vorname', 'hellomed-custom-login' ); ?></label>
		</div>
      </div>

	  <div class="col-12">
        <div class="form-floating">
			
			<input required class="form-control" type="text" name="last_name" id="last-name" required="required" placeholder=" ">
			<label for="last_name"><?php _e( 'Ihr Nachname', 'hellomed-custom-login' ); ?></label>
		</div>
      </div>

	  <div class="col-12">
        <div class="form-floating">

			<input required class="form-control"  type="text" name="email" id="email" required="required" placeholder=" ">
			<label for="email"><?php _e( 'Ihre E-Mail-Adresse', 'hellomed-custom-login' ); ?> </label>
		</div>
      </div>


	  <div class="col-12">
        <div class="form-check m-0">
          <input required class="form-check-input" type="checkbox" id="test3">
          <label class="form-check-label text-justify" for="test3">
          <small>
              Ich habe die <a href>AGB</a> und die <a href>Datenschutzerklärung</a> zur Kenntnis genommen. *
            </small>
          </label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-check m-0">
          <input class="form-check-input" type="checkbox" id="test4" name="personal_data_checkbox">
          <label class="form-check-label text-justify" for="test4">
          <small>
          Ich willige ein, dass meine personenbezogenen Daten, inklusive meiner Gesundheitsdaten zum Zweck der Übersendung personalisierter Errinerungsmails zur Einreichung eines Folgerezeptes und Produktempfehlungen per E-Mail verarbeitet werden.
            </small>
      </label>  
        </div>
      </div>
      <div class="col-12">
        <div class="form-check m-0">
          <input  class="form-check-input" type="checkbox" id="test5" name="newsletter_checkbox">
          <label class="form-check-label text-justify"  for="test5">
          <small>
              Ja ich möchte weitere Informationen zu Neuigkeiten und Angeboten von der hellomed Group GmbH per E-Mail oder Telefon erhalten. Ich willige ein, dass die Apotheke zu diesem Zweck meine E-Mail-Adresse, Telefonnummer meinen Namen und meine Adresse an die hellomed Group GmbH übermittelt und diese die Daten zum Zweck der Informationsübermittlung verarbeitet. Soweit dafür erforderlich, entbinde ich den Apotheker und seine Angestellten von der Schweigepflicht.
            </small>
          </label>
        </div>
      </div>
      <div class="col-12">
        <small class="d-block pt-3 text-justify border-top">
        Ich kann meine Einwilligungen und die Schweigepflichtentbindungserklärung jederzeit mit Wirkung für die Zukunft in meinem hellomedOs Kundenkonto widerrufen. 
        </small>
      </div> 

		<!-- <p class="form-row">
			//?php _e( 'Notiz: Es wird ein automatisches Passwort generiert und per E-Mail zugesandt. ', 'hellomed-custom-login' ); ?>
		</p> -->

		<?php if ( $attributes['recaptcha_site_key'] ) : ?>
			<div class="recaptcha-container">
				<div class="g-recaptcha" data-sitekey="<?php echo $attributes['recaptcha_site_key']; ?>"></div>
			</div>
		<?php endif; ?>

		<!-- <p></p> -->

				<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
				<?php foreach ( $attributes['errors'] as $error ) : ?>
					<div class="col-12">
				<div class="alert alert-danger m-0">
				<i class="bi bi-exclamation-circle-fill me-2"></i>
								<?php echo $error; ?>
								</div>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>

		<div class="col-12">
			<input id="hideInputLog"  type="submit" name="submit" class="register-button"
			       value="<?php _e( 'Registrieren', 'hellomed-custom-login' ); ?>"/>
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Registrieren</label> 
				</div>
				</div>
  </div>
	</form>

	<div class="text-center">
    <a class="text-secondary" href="anmelden">Bereits Registriert? Jetzt anmelden!</a>

  </div>	
	
</div>