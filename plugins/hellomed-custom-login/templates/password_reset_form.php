<div id="password-reset-form" class="hm-auth-wrap">

<div class="hm-logo">
			<a href="index.php">
			<img src="/wp-content/uploads/2022/05/hel_logo-01.svg">
			</a>
		</div>

	<form name="resetpassform" id="resetpassform" action="<?php echo site_url( 'wp-login.php?action=resetpass' ); ?>" method="post" autocomplete="off">
		<input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $attributes['login'] ); ?>" autocomplete="off" />
		<input type="hidden" name="rp_key" value="<?php echo esc_attr( $attributes['key'] ); ?>" />

	<div class="hm-auth-form my-4">
    <div class="row gy-3">

	<div class="col-12">
        <div class="h2 m-0 text-center">Neues Passwort festlegen</div>
    </div>


	<div class="col-12">
		<div class="form-floating">
			
			<input type="password" name="pass1" id="pass1" class="form-control" size="20" value="" autocomplete="off" placeholder=" " />
			<label for="pass1"><?php _e( 'Neues Passwort', 'hellomed-custom-login' ) ?></label>
		</div>
		</div>

		<div class="col-12">
		<div class="form-floating">
			
			<input type="password" name="pass2" id="pass2" class="form-control" size="20" value="" autocomplete="off" placeholder=" " />
			<label for="pass2"><?php _e( 'Neues Passwort wiederholen', 'hellomed-custom-login' ) ?></label>
		</div>
		</div>

		<!-- <p class="description"><?php echo wp_get_password_hint(); ?></p> -->

		<?php if ( count( $attributes['errors'] ) > 0 ) : ?>
			<?php foreach ( $attributes['errors'] as $error ) : ?>
				<p>
					<?php echo $error; ?>
				</p>
			<?php endforeach; ?>
		<?php endif; ?>



		<div class="col-12">
			<input type="submit" name="submit" id="hideInputLog"
			       class="button" value="<?php _e( 'Reset Password', 'hellomed-custom-login' ); ?>" />
				   <label for="hideInputLog" class="btn btn-primary btn-lg">Passwort festlegen</label> 
				</div>


		
		</div>
  </div>
	</form>

	<div class="text-center">
    <a class="text-secondary" href="anmelden">Zurück zum Login</a>
    
  </div>	

</div>