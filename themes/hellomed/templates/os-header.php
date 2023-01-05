<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>hellomed STAGE</title>

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
        <?php  
        // checking current user, and the if the patient have prescriptions 
        $current_user_id = get_current_user_id();
        $rezept_input = get_field('rezept_input', 'user_' . $current_user_id);
        $current_timestamp = time();
        if ($rezept_input) {
            // for each prescription with a status of aktiv, it will then convert the expiring date, compare to what is left  
                foreach ($rezept_input as $row) {
                    $prescription_status = $row['status_prescription'];
                    $prescription_id = $row['prescription_id'];
                    $prescription_end_date = $row['prescription_end_date'];
                    $prescription_end_datetime = DateTime::createFromFormat('d/m/Y', $prescription_end_date);
                    $prescription_end_timestamp = $prescription_end_datetime->getTimestamp();
                    $prescription_end_date_formatted = $prescription_end_datetime->format('d.m.Y');
                    
                    // adding a dynamic class based on the time left for the prescription to expire
                    if ($prescription_end_timestamp >= $current_timestamp + 4 * 7 * 24 * 60 * 60) {
                        // More than 4 weeks away
                        $class = 'theme-green';
                    } elseif ($prescription_end_timestamp >= $current_timestamp + 2 * 7 * 24 * 60 * 60) {
                        // More than 2 weeks away
                        $class = 'theme-yellow';
                    } else {
                        // Less than 2 weeks away
                        $class = 'theme-red';
                    }
                    ?>
        <div class="hm-preheader <?php echo $class; ?>">
                <i class="bi bi-exclamation-circle-fill"></i>
                <div>
                Ihr aktueller Rezeptzyklus und die Belieferung durch hellomed läuft zum <b><?php echo $prescription_end_date; ?></b> aus.
      Bitte senden Sie Ihr Folgerezept spätestens bis zum <b>(DD/MM/YYY)</b> postalisch oder per
      Rezept-Upload an uns.
                </div>
                <i class="bi bi-x-circle"></i>
        </div>
        <?php  
                }        
        }
        ?>

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
                    <a class="<?php if (is_page('os-rezepte')) { echo 'active'; } ?>" href="/os-rezepte">Rezepte</a>
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
                <li><a class="<?php if (is_page('os-rezepte')) { echo 'active'; } ?>" href="/os-rezepte">Rezepte</a>
                </li>
                <li><a class="<?php if (is_page('os-medikamente')) { echo 'active'; } ?>"
                        href="/os-medikamente">Medikamente</a> </li>
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