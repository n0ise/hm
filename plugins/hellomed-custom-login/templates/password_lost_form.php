<div id="password-lost-form" class="hm-auth-wrap">

		<div class="hm-logo">
			<a href="index.php">
			<img src="/wp-content/uploads/2022/05/hel_logo-01.svg">
			</a>
		</div>

	<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">

  <div class="hm-auth-form my-4">
    <div class="row gy-3">


	<div class="col-12">
        <div class="h2 m-0">Passwort zurücksetzen</div>
    </div>

	<p>
		<?php
			_e(
				"Geben Sie Ihre E-Mail Adresse ein und wir senden Ihnen einen Passwort zurücksetzen link zu.",
				'hellomed_custom_login'
			);
		?>
	</p>

	<div class="col-12">
		<div class="form-floating">
		<input type="text" name="user_login" id="user_login"  class="form-control" placeholder=" ">
			<label for="user_login"><?php _e( 'Email', 'hellomed-custom-login' ); ?></label>
		</div>
	</div>


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
			<input id="hideInputLog" type="submit" name="submit" class="lostpassword-button"
			       value="<?php _e( 'Reset Password', 'hellomed-custom-login' ); ?>"/>
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Passwort zurücksetzen</label> 
		</div>
	</div>

  </div>
  </form>

	<div class="text-center">
    <a class="text-secondary" href="anmelden">Zurück zum Login</a>
    <a class="text-secondary" href="registrieren">Noch kein Mitglied? Jetzt registrieren!</a>
  </div>			


</div>