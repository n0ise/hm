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
        <?php  
        // if page is os-rezepte 
    if (is_page('rezepte')) { 
            
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
                if ($prescription_status == "Aktiv" && isset($prescription_end_date)) {
                    $prescription_end_datetime = DateTime::createFromFormat('Y-m-d', $prescription_end_date);
                    $prescription_end_timestamp = $prescription_end_datetime->getTimestamp();
                    $prescription_end_date_formatted = $prescription_end_datetime->format('d.m.Y');
                    // two weeks before the expiry date 
                    $two_weeks_before = $prescription_end_datetime->modify('-14 days');
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
                    // display row data with $class assigned
                } else {
                    // skip processing and displaying the prescription
                    continue;
                }
                    ?>
        <div class="hm-preheader <?php echo $class; ?>" id="prescription-<?php echo $prescription_id; ?>">
            <i class="bi bi-exclamation-circle-fill"></i>
            <div>
                Ihr aktueller Rezeptzyklus f??r das Rezept <b><?php echo $prescription_id; ?></b> und somit die Belieferung durch hellomed l??uft zum
                <b><?php echo $prescription_end_date_formatted; ?></b> aus.
                Bitte senden Sie uns ein Folgerezept bis zum
                <b><?php echo $two_weeks_before->format('d.m.Y'); ?></b> postalisch oder per
                E-Rezept zu.
            </div>
            <i class="bi bi-x-circle"></i>
        </div>
        <script>
        $('.bi-x-circle').click(function() {
            var id = $(this).parent().attr('id');
            // $(this).parent().hide();
            $(this).parent().remove();
            sessionStorage.setItem("div_closed_" + id, "true");
        });
        $(document).ready(function() {
            $('.hm-preheader').each(function() {
                var id = $(this).attr('id');
                if (sessionStorage.getItem("div_closed_" + id) === "true") {
                    $("#" + id).remove();
                }
            });
        });
        </script>




        <?php  
                }        
        }
    }
    ?>

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
                    <a class="<?php if (is_page('medikationsplan')) { echo 'active'; } ?>"
                        href="/medikationsplan">Medikationsplan</a>
                    <a class="<?php if (is_page('rezepte')) { echo 'active'; } ?>" href="/rezepte">Rezepte</a>
                    <a class="<?php if (is_page('medikamente')) { echo 'active'; } ?>"
                        href="/medikamente">Medikamente</a>
                </nav>
            </div>
            <div class="d-none d-lg-block">
                <div class="hm-dropdown dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="hm-dropdown-user">
                        <div class="hm-dropdown-name"><?php echo $user_name; ?>
                        </div>
                        <div class="hm-dropdown-role"><?php echo "hellomed Patient"; ?></div>
                    </div>
                </div>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="/hilfe-faq" target="_blank">FAQ & Hilfe</a></li>
                    <li><a class="dropdown-item" href="/berechtigungen">Berechtigungen</a></li>
                    <li><a class="dropdown-item" href="/einstellungen">Einstellungen</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
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
                <li><a class="<?php if (is_page('os-medikationsplan')) { echo 'active'; } ?>"
                        href="/medikationsplan">Medikationsplan</a></li>
                <li><a class="<?php if (is_page('os-rezepte')) { echo 'active'; } ?>" href="/rezepte">Rezepte</a>
                </li>
                <li><a class="<?php if (is_page('os-medikamente')) { echo 'active'; } ?>"
                        href="/medikamente">Medikamente</a> </li>
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
                <li><a href="/einstellungen">Einstellungen</a></li>
                <li><a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a></li>
            </ul>
        </div>
    </nav>