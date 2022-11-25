
<div class="auth-wrap">
  <div class="logo">
    <a href="index.php">
	<img src="https://hm.lndo.site/wp-content/uploads/2022/05/hel_logo-01.svg">
    </a>
  </div>
  <form method="post" action="<?php echo wp_login_url(); ?>">
  <div class="auth-form my-4">
    <div class="row gy-3">
      <div class="col-12">
        <div class="h2 m-0">Login</div>
      </div>



	<?php if ( $attributes['lost_password_sent'] ) : ?>
		<p class="login-info">
			<?php _e( 'Überprüfen Sie Ihre E-Mail auf einen Link zum Zurücksetzen Ihres Passworts.', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['password_updated'] ) : ?>
		<p class="login-info">
			<?php _e( 'Ihr Passwort wurde geändert. Sie können sich jetzt anmelden.', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>

      <div class="col-12">
        <div class="form-floating">
		<input type="text" class="form-control" name="log" id="user_login" placeholder=" ">
		<label for="user_login"><?php _e( 'Email', 'hellomed-custom-login' ); ?></label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
		<input type="password" class="form-control" name="pwd" id="user_pass" placeholder=" ">
		<label for="user_pass"><?php _e( 'Passwort', 'hellomed-custom-login' ); ?></label>
        </div>
      </div>

	

      <div class="col-12">
	  <input id="hideInputLog" type="submit" value="<?php _e( 'Sign In', 'hellomed-custom-login' ); ?>">
		<label for="hideInputLog" class="btn btn-primary btn-lg">Anmelden</label> 
      </div>
	 
    </div>

	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="login-error">
				<br>
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if ( $attributes['logged_out'] ) : ?>
		<p class="login-info">
		<br>
			<?php _e( 'Sie haben sich abgemeldet. Möchten Sie sich erneut anmelden?', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['registered'] ) : ?>
		<p class="login-info">
		<br>
			<?php
				printf(
					__( 'Sie haben sich erfolgreich bei <strong>%s</strong> registriert. Bitte überprüfen Sie Ihren Posteingang auf eine Bestätigungs-E-Mail.', 'hellomed-custom-login' ),
					get_bloginfo( 'name' )
				);
			?>
		</p>
	<?php endif; ?>

  </div>
  </form>

  <div class="text-center">
  <a class="text-secondary" href="<?php echo wp_lostpassword_url(); ?>"> <?php _e( 'Password vergessen?', 'hellomed-custom-login' ); ?> </a>
    <br><br>
    <a class="text-secondary" href="/registrieren"> <?php _e( 'Noch kein Mitglied? Jetzt registrieren!', 'hellomed-custom-login' ); ?> </a>
  </div>

</div>






