<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>#hellostage 🤘🏻</title>

<link rel="icon" href="wp-content/themes/hellomed/assets/img/favicon.svg" type="image/svg+xml">

<!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Lodash -->
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

<!-- include jquery, might remove later  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<!-- include variables with all fields from acf/wp -->
<?php 
include_once( get_stylesheet_directory() . '/assets/php/variables.php' );
?>

<!-- Custom js -->
<script src="wp-content/themes/hellomed/assets/js/ios-safari.js"></script>
<script src="wp-content/themes/hellomed/assets/js/off-canvas.js"></script>

<!-- if page is medikamente, load this  -->
<?php if (is_page('os-medikationsplan')) { ?>
<script src="wp-content/themes/hellomed/assets/js/os-medications.js"></script>
<?php } ?>

<!-- UI CSS -->
<link rel="stylesheet" href="https://ui.hellomed.com/css/index.css">
<!-- local css, for lando  -->
<!-- <link rel="stylesheet" href="/UI/css/index.css"> -->

<header class="hm-header">
    <div class="container">
        <div class="hm-logo">
            <a href="index.html">
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg">
            </a>
        </div>
        <!-- checking if logged in and show the whole nav header -->
        <?php if(is_user_logged_in()) { ?>
        <div class="d-none d-lg-block">
            <nav class="hm-nav">
                <!-- check the page slug and make the correspondent <li> with class active -->
                <a class="<?php if (is_page('os-medikationsplan.')) { echo 'active'; } ?>"
                    href="/os-medikationsplan.">Medikationsplan</a>
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