<?php
// include variables with all fields from acf/wp
include_once( get_stylesheet_directory() . '/assets/php/variables.php' );
?>
<!DOCTYPE html>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>#hellostage 🤘🏻</title>

<link rel="icon" href="img/favicon.svg" type="image/svg+xml">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<!-- include css.css from olly UI-->
<link rel="stylesheet" href="https://ui.hellomed.com/css/css.css">
<!-- <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/css.css"> -->
    <div class="app">
<div class="header">
    <img src="../../../wp-content/uploads/2022/05/hel_logo-01.svg" alt="logo" class="logo" width="300"> 
    <?php if(is_user_logged_in()) { ?>
      
    <div class="dropdown">
        <div class="dropdown-photo">
            <img src="<?php echo get_avatar_url($user_id); ?>" />
        </div>
        <div class="dropdown-user">
            <div class="dropdown-name">
                <!-- show user name  -->
                <?php echo $user_name;  echo $status; ?>
            </div>
            <div class="dropdown-role">
                <!-- show user role and userID     -->
                <?php echo $user_role; ?> (ID <?php echo $user_id; ?>)
                <!-- and the logout  -->
                <a href="<?php echo wp_logout_url( home_url() ); ?>">Logout</a>
<?php } else {
//something?
 } ?>

            </div>
        </div>
    </div>
</div> 