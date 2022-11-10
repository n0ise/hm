<?php /* Template Name: Login Page */ ?>

<?php get_header(); ?>

<div id="primary" class="content-area">

                <main id="main" class="site-main" role="main" style="background:#F0F3F6 !important;">
                    <style>
   button, input[type="button"], input[type="submit"]{
    width:100% !important;
                 
font-size: 1.25rem;
border-radius: 0.5rem !important;
                        }
                      .auth-wrap {
max-width: 400px;
margin: 0 auto !important;
padding: 100px 0 0 !important;
}
                        #auth-form {
margin: 40px 0;
padding: var(--spacing);
border-radius: 10px;
background: #fff;
box-shadow: var(--shadow);
}
.form-floating>.form-control, .form-floating>.form-control-plaintext, .form-floating>.form-select {
height: calc(3.5rem + 2px);
line-height: 1.25;
}
.form-control {
display: block;
width: 100%;
padding: .375rem .75rem;
font-size: 1rem;
font-weight: 400;
line-height: 1.5;
color: #212529;
background-color: #fff;
background-clip: padding-box;
border: 1px solid #ced4da;
-webkit-appearance: none;
-moz-appearance: none;
appearance: none;
border-radius: .375rem;
transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
                    </style>
                                                    <div class="auth-wrap">
                                                        <div class="logo" style="width:140px;margin:0 auto;"><img src="https://stage.hellomed.com/wp-content/uploads/2022/05/hel_logo-01.svg"></div>
                                                        <div class="auth-form" style="margin: 40px 0;
padding: 40px;
border-radius: 10px;
background: #fff;
box-shadow: var(--shadow);">

<?php
if ( ! is_user_logged_in() ) { // Display WordPress login form:
    $args = array(
        'redirect' => admin_url(), 
        'form_id' => 'auth-form',
        'label_username' => __( 'E-Mail' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me custom text' ),
        'label_log_in' => __( 'Login' ),
        'remember' => false
    );
    wp_login_form( $args );
} else { // If logged in:
    wp_loginout( home_url() ); // Display "Log Out" link.
    echo " | ";
    wp_register('', ''); // Display "Site Admin" link.
}

                                ?>
                                </div><div style="text-align: center;"><a href="/forgot-password"> Forgot password?</a><br><br><a href="/register">Don't have an account? Register now.</a></div>
</div><br><br>
                </main><!-- .site-main -->


</div><!-- .content-area -->


<?php get_footer(); ?>