
<?php if ( true ) : ?>

	<?php if ( $attributes['show_title'] ) : ?>
		<h2><?php _e( 'Sign In', 'hellomed-custom-login' ); ?></h2>
	<?php endif; ?>

<div class="auth-wrap">
  <div class="logo">
    <a href="index.php">
	<img src="https://hm.lndo.site/wp-content/uploads/2022/05/hel_logo-01.svg">
    </a>
  </div>
  <div class="auth-form my-4">
    <div class="row gy-3">
      <div class="col-12">
        <div class="h2 m-0">Login</div>
      </div>


	<!-- Show errors if there are any -->
	<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
		<?php foreach ( $attributes['errors'] as $error ) : ?>
			<p class="login-error">
				<?php echo $error; ?>
			</p>
		<?php endforeach; ?>
	<?php endif; ?>

	<!-- Show logged out message if user just logged out -->
	<?php if ( $attributes['logged_out'] ) : ?>
		<p class="login-info">
			<?php _e( 'You have signed out. Would you like to sign in again?', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['registered'] ) : ?>
		<p class="login-info">
			<?php
				printf(
					__( 'You have successfully registered to <strong>%s</strong>. We have emailed your password to the email address you entered.', 'hellomed-custom-login' ),
					get_bloginfo( 'name' )
				);
			?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['lost_password_sent'] ) : ?>
		<p class="login-info">
			<?php _e( 'Überprüfen Sie Ihre E-Mail auf einen Link zum Zurücksetzen Ihres Passworts.', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>

	<?php if ( $attributes['password_updated'] ) : ?>
		<p class="login-info">
			<?php _e( 'Your password has been changed. You can sign in now.', 'hellomed-custom-login' ); ?>
		</p>
	<?php endif; ?>


	  <form method="post" action="<?php echo wp_login_url(); ?>">
      <div class="col-12">
        <div class="form-floating">
		<input type="text" class="form-control" name="log" id="user_login" placeholder=" ">
		<label for="user_login"><?php _e( 'Username or Email', 'hellomed-custom-login' ); ?></label>
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
	  </form>
    </div>
  </div>
  <div class="text-center">
  <a class="text-secondary" href="<?php echo wp_lostpassword_url(); ?>"> <?php _e( 'Password vergessen?', 'hellomed-custom-login' ); ?> </a>
    <br><br>
    <a class="text-secondary" href="#"> <?php _e( 'Noch kein Mitglied? Jetzt registrieren!', 'hellomed-custom-login' ); ?> </a>
  </div>
</div>








<?php endif; ?>
