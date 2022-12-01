<div class="auth-wrap">
  <div class="logo">
    <a href="index.php">
	<img src="https://hm.lndo.site/wp-content/uploads/2022/05/hel_logo-01.svg">
    </a>
  </div>

	<form id="signupform" action="<?php echo wp_registration_url(); ?>" method="post">
		
	<div class="auth-form my-4">
    <div class="row gy-3">
      <div class="col-12">
        <div class="h2 m-0">Registrierung</div>
      </div>
	
	  <?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p>
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>
	
		<div class="col-12">
				<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="patientcaregiverid" value="patient" id="patientcaregiverid1" required="required" >
			<label class="form-check-label" for="patientcaregiverid1">
				Patient
			</label>
			</div>
			<div class="form-check form-check-inline">
			<input class="form-check-input" type="radio" name="patientcaregiverid" value="caregiver" id="patientcaregiverid2" required="required" >
			<label class="form-check-label" for="patientcaregiverid2">
				Caregiver
			</label>
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
			<label for="email"><?php _e( 'Email', 'hellomed-custom-login' ); ?> </label>
		</div>
      </div>


	  <div class="col-12">
				<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" >
			<label class="form-check-label" for="flexCheckDefault">
				Checkbox 1
			</label>
			</div>
			<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
			<label class="form-check-label" for="flexCheckChecked">
			Checkbox 2
			</label>
			</div>
			<div class="form-check">
			<input class="form-check-input" type="checkbox" value="" id="flexCheckChecked2" >
			<label class="form-check-label" for="flexCheckChecked2">
			Checkbox 3
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

		<div class="col-12">
			<input id="hideInputLog"  type="submit" name="submit" class="register-button"
			       value="<?php _e( 'Registrieren', 'hellomed-custom-login' ); ?>"/>
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Registrieren</label> 
				</div>
				</div>
  </div>
	</form>

	<div class="text-center">
    <a class="text-secondary" href="anmelden">Bereits Mitglied? Jetz anmelden!</a>

  </div>	
	
</div>