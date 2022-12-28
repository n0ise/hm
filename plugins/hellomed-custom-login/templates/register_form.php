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
        <div class="h2 m-0">Registrierung</div>
      </div>
	


		<div class="col-12">
       <label class="form-label">Sind Sie Patient oder Angehöriger?</label>
        <div class="btn-group d-flex">
          <input type="radio" class="btn-check" name="patientcaregiverid" value="patient"  id="patientcaregiverid1" autocomplete="off" checked>
          <label class="btn btn-outline-primary" for="patientcaregiverid1">Patient</label>
          <input type="radio" class="btn-check" name="patientcaregiverid"  value="caregiver" id="patientcaregiverid2" autocomplete="off">
          <label class="btn btn-outline-primary" for="patientcaregiverid2">Angehöriger</label>
        </div>
      </div>


	  <div class="col-12">
        <div class="form-floating">
			
			<input  class="form-control" type="text" name="first_name" id="first-name" required="required" placeholder=" ">
			<label for="first_name"><?php _e( 'Name', 'hellomed-custom-login' ); ?></label>
		</div>
      </div>

	  <div class="col-12">
        <div class="form-floating">
			
			<input  class="form-control" type="text" name="last_name" id="last-name" required="required" placeholder=" ">
			<label for="last_name"><?php _e( 'Nachname', 'hellomed-custom-login' ); ?></label>
		</div>
      </div>

	  <div class="col-12">
        <div class="form-floating">

			<input class="form-control"  type="text" name="email" id="email" required="required" placeholder=" ">
			<label for="email"><?php _e( 'Was ist Ihre E-Mail Adresse?', 'hellomed-custom-login' ); ?> </label>
		</div>
      </div>


	  <div class="col-12">
        <div class="form-check m-0">
          <input class="form-check-input" type="checkbox" id="test3">
          <label class="form-check-label" for="test3">
            Ich habe die AGB und die Datenschutzerklärung zur Kenntnis genommen.
          </label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-check m-0">
          <input class="form-check-input" type="checkbox" id="test4">
          <label class="form-check-label" for="test4">
            Ich willige ein, dass meine personenbezogenen Daten, inklusive meiner Gesundheitsdaten zum Zweck der Übersendung einer Erinnerungsmail zur Einreichung eines Folgerezepts verarbeitet werden.
          </label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-check m-0">
          <input class="form-check-input" type="checkbox" id="test5">
          <label class="form-check-label" for="test5">
            Ich willige ein, dass meine personenbezogenen Daten, inklusive meiner Gesundheitsdaten zum Zweck der Übersendung personalisierter Produktempfehlungen per E-Mail verarbeitet werden.
          </label>
        </div>
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