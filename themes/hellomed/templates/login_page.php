<?php /* Template Name: Login Page */ 

$login  = (isset($_GET['login']) ) ? $_GET['login'] : 0;
?> 

<!DOCTYPE html>
	<html lang="en"><head>
	<title><?php echo get_the_title(); ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"> -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://ui.hellomed.com/css/css.css">

	</head>
		<body>
<!-- 
<form class="auth-form" name="custom-login-form" id="custom-login-form" action="<?= esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post"> -->

<form class="auth-wrap" name="custom-login-form" id="custom-login-form" action="<?= esc_url( site_url( 'wp-login.php', 'login_post' ) ); ?>" method="post">

<!-- <div class="auth-wrap"> -->
  <div class="logo">
    <a href="index.php">
      <img src="/wp-content/uploads/2022/05/hel_logo-01.svg">
    </a>
  </div>
  <div class="auth-form my-4">
    <div class="row gy-3">
      <div class="col-12">
        <div class="h2 m-0">Anmelden</div>
      </div>
      <div class="col-12">
        <div class="form-floating">
        <input class="form-control" type="text" name="log" id="<?= __('user_login') ; ?>" placeholder=" " >
          <label for="<?= __('user_login') ; ?>">Benutzername oder E-Mail-Adresse</label>
        </div>
      </div>
      <div class="col-12">
        <div class="form-floating">
		<input class="form-control" type="password" name="pwd" id="<?= __('user_pass'); ?>" placeholder=" ">
          <label for="<?= __('user_pass'); ?>">Passwort</label>
        </div>
      </div>
      <div class="col-12">
         <input type="submit" name="wp-submit" id="<?= esc_attr(__('wp-submit')); ?>" class="btn btn-primary btn-lg" value="<?= esc_attr(__('Anmelden')); ?>" />
         <input type="hidden" name="redirect_to" value="<?= esc_url(get_home_url('/')); ?>'" />
      </div>
    </div>
 
    <?php
							if ( $login === "failed" ) {
							  echo '<br> <div class="alert alert-danger" role="alert">' . __("<strong>ERROR:</strong> Invalid username and/or password.") . '</div>';
							} elseif ( $login === "empty" ) {
							  echo '<br> <div class="alert alert-danger" role="alert">' . __("<strong>ERROR:</strong> Username and/or Password is empty.") . '</div>';
							} elseif ( $login === "false" ) {
							  echo '<br> <div class="alert alert-success" role="alert">' . __("<strong>INFO:</strong> You are logged out.") . '</div>';
							}
							?>
  </div>
  <div class="text-center">
    <a class="text-secondary" href="/passwort-vergessen">Passwort vergessen?</a>
    <br><br>
    <a class="text-secondary" href="/registrieren">Noch kein Mitglied? Jetzt registrieren!</a>
  </div>
</form>

</body></html>
     

