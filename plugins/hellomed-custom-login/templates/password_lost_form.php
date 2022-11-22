<div id="password-lost-form" class="auth-wrap">

		<div class="logo">
			<a href="index.html">
			<img src="https://hm.lndo.site/wp-content/uploads/2022/05/hel_logo-01.svg">
			</a>
		</div>

	<?php if ( $attributes['show_title'] ) : ?>
		<h3><?php _e( 'Forgot Your Password?', 'hellomed-custom-login' ); ?></h3>
	<?php endif; ?>

	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p>
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<p>
		<?php
			_e(
				"Geben Sie Ihre E-Mail Adresse ein und wir senden Ihnen einen Passwort zurücksetzen link zu.",
				'hellomed_custom_login'
			);
		?>
	</p>




  <div class="auth-form my-4">
    <div class="row gy-3">


	<div class="col-12">
        <div class="h2 m-0">Passwort zurücksetzen</div>
      </div>


	<form id="lostpasswordform" action="<?php echo wp_lostpassword_url(); ?>" method="post">

	<div class="col-12">
		<div class="form-floating">
		<input type="text" name="user_login" id="user_login"  class="form-control" placeholder=" ">
			<label for="user_login"><?php _e( 'Email', 'hellomed-custom-login' ); ?></label>
			
		</div>
		</div>

		<p class="col-12">
			<input id="hideInputLog" type="submit" name="submit" class="lostpassword-button"
			       value="<?php _e( 'Reset Password', 'hellomed-custom-login' ); ?>"/>
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Passwort zurücksetzen</label> 

		</p>
	</form>

	</div>
  </div>



	<div class="text-center">
    <a class="text-secondary" href="anmelden">Zurück zum Login</a>
    <br><br>
    <a class="text-secondary" href="registieren">Noch kein Mitglied? Jetzt registrieren!</a>
  </div>			


</div>