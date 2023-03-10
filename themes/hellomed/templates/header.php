<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title><?php echo get_the_title(); ?> | hellomed</title>

<link rel="icon" href="https://ui.hellomed.com/src/v1.1/img/favicon.svg" type="image/svg+xml">



<!-- jQuery  -->
<script src="https://ui.hellomed.com/src/v1.1/js/jquery-3.6.3.min.js" type="text/javascript"></script>

<!-- Custom -->
<link rel="stylesheet" href="https://ui.hellomed.com/src/v1.1/css/index.css">

<!-- include variables with all fields from acf/wp -->
<?php 
include_once( get_stylesheet_directory() . '/assets/php/variables.php' );
?>

<!-- local css, for lando  -->
<!-- <link rel="stylesheet" href="/UI/css/index.css"> -->

<header class="hm-header">
    <div class="container">
        <div class="hm-logo">
            <a href="/anmelden">
                <img src="https://ui.hellomed.com/src/v1.1/img/logo.svg">
            </a>
        </div>
        <!-- checking if logged in and show the whole nav header -->
        <?php if(is_user_logged_in()) { ?>
        <div class="d-none d-lg-block">
            <nav class="hm-nav">
                <!-- check the page slug and make the correspondent <li> with class active -->
                <a class="<?php if (is_page('admin-dashboard')) { echo 'active'; } ?>"
                    href="/admin-dashboard">Dashboard</a>
                <a class="<?php if (is_page('admin-nutzerverwaltung')) { echo 'active'; } ?>"
                    href="/admin-nutzerverwaltung?status=Alle">Nutzerverwaltung</a>
                <a class="<?php if (is_page('admin-rezeptverwaltung')) { echo 'active'; } ?>"
                    href="/admin-rezeptverwaltung">Rezeptverwaltung</a>
            </nav>
        </div>
        <div class="d-none d-lg-block">
            <div class="hm-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                <div class="hm-dropdown-user">
                    <div class="hm-dropdown-name"><?php echo $user_name; ?>
                    </div>
                    <div class="hm-dropdown-role"><?php echo "hellomed Admin"; ?></div>
                </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-end">
                <!-- <li><a class="dropdown-item" href="os-hilfe">FAQ & Hilfe</a></li>
                <li><a class="dropdown-item" href="os-einstellungen">Einstellungen</a></li> -->
                <!-- <li>
                    <hr class="dropdown-divider">
                </li> -->
                <li><a class="dropdown-item" href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
            </ul>
        </div>

        <div class="d-lg-none">
            <nav class="hm-nav">
                <a href="tel:+4930233295030" class="active">030 233 295 030</a>
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
         <li><a class="<?php if (is_page('admin-dashboard')) { echo 'active'; } ?>"
                    href="/admin-dashboard">Dashboard</a></li>
                    <li><a class="<?php if (is_page('admin-nutzerverwaltung')) { echo 'active'; } ?>"
                    href="/admin-nutzerverwaltung?status=Alle">Nutzerverwaltung</a></li>
                    <li><a class="<?php if (is_page('admin-rezeptverwaltung')) { echo 'active'; } ?>"
                    href="/admin-rezeptverwaltung">Rezeptverwaltung</a></li>               
        </ul>
    <div class="hm-offcanvas-profile">
      <div class="hm-dropdown">
        <div class="hm-dropdown-user">
          <div class="hm-dropdown-name"><?php echo $user_name; ?></div>
          <div class="hm-dropdown-role"><?php echo $user_role; ?></div>
        </div>
      </div>
    </div>
    <ul>
      <li><a href="/hilfe-faq" target="_blank">FAQ & Hilfe</a></li>
      <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
    </ul>
  </div>
</nav>