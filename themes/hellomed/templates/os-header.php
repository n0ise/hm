<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/favicon.svg" type="image/svg+xml">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<!-- include css.css from olly UI-->
<link rel="stylesheet" href="https://ui.hellomed.com/css/index.css">

<!-- jQuery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js" type="text/javascript"></script>


<!-- include variables with all fields from acf/wp -->
<?php 
include_once( get_stylesheet_directory() . '/assets/php/variables.php' );
?>

<!-- local css, for lando  -->
<!-- <link rel="stylesheet" href="/UI/css/index.css"> -->


<header class="hm-header">
    <div class="container">
        <div class="hm-logo">
            <a href="index.php">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg">
            </a>
        </div>
        <!-- checking if logged in and show the whole nav header -->
        <?php if(is_user_logged_in()) { ?>
        <div class="d-none d-lg-block">
            <nav class="hm-nav">
                <!-- check the page slug and make the correspondent <li> with class active -->
                <a class="<?php if (is_page('os-medikationsplan')) { echo 'active'; } ?>"
                    href="/os-medikationsplan">Medikationsplan</a>
                <a class="<?php if (is_page('os-rezepte')) { echo 'active'; } ?>"
                    href="/os-rezepte">Rezepte</a>
                <a class="<?php if (is_page('os-medikamente')) { echo 'active'; } ?>"
                    href="/os-medikamente">Medikamente</a>
            </nav>
        </div>
        <div class="d-none d-lg-block">
            <div class="hm-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                <div class="hm-dropdown-photo">
                    <img src="<?php echo get_avatar_url($user_id); ?>" />
                </div>
                <div class="hm-dropdown-user">
                    <div class="hm-dropdown-name"><?php echo $user_name; ?>
                    </div>
                    <div class="hm-dropdown-role"><?php echo $user_role; ?></div>
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="os-hilfe">FAQ & Hilfe</a></li>
                <li><a class="dropdown-item" href="os-einstellungen">Einstellungen</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
            </ul>
        </div>

        <div class="d-lg-none">
            <nav class="hm-nav">
                <a href="tel:+49306941132" class="active">030 6941132</a>
            </nav>
        </div>
        <div class="d-lg-none">
            <div class="hm-hamburger"><i></i><i></i><i></i></div>

        </div>
    </div>
    <?php } else {
                //TODO something? 
                     } ?>
</header>

<nav class="hm-offcanvas">
  <div class="hm-offcanvas-inner">
    <ul>
         <!-- check the page slug and make the correspondent <li> with class active -->
         <li><a class="<?php if (is_page('os-medikationsplan')) { echo 'active'; } ?>"
                    href="/os-medikationsplan">Medikationsplan</a></li> 
                    <li><a class="<?php if (is_page('os-rezepte')) { echo 'active'; } ?>"
                    href="/os-rezepte">Rezepte</a></li> 
                    <li><a class="<?php if (is_page('os-medikamente')) { echo 'active'; } ?>"
                    href="/os-medikamente">Medikamente</a>  </li>           
        </ul>
    <div class="hm-offcanvas-profile">
      <div class="hm-dropdown">
        <div class="hm-dropdown-photo">
          <img src="<?php echo get_avatar_url($user_id); ?>">
        </div>
        <div class="hm-dropdown-user">
          <div class="hm-dropdown-name"><?php echo $user_name; ?></div>
          <div class="hm-dropdown-role"><?php echo $user_role; ?></div>
        </div>
      </div>
    </div>
    <ul>
      <li><a href="os-hilfe">FAQ & Hilfe</a></li>
      <li><a href="os-einstellungen">Einstellungen</a></li>
      <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
    </ul>
  </div>
</nav>