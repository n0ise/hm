<?php /* Template Name: Forgot Page */ ?>

<?php get_header(); ?>

<div id="primary" class="content-area">

                <main id="main" class="site-main" role="main">
                                <?php

// show the reset password form 
if ( isset( $_GET['action'] ) && 'reset' == $_GET['action'] ) :

    $reset_key = $_GET['key'];
    $user_login = $_GET['login'];

    $user_data = check_password_reset_key( $reset_key, $user_login );

    if ( ! $user_data ) {

        echo 'Invalid key';

        exit;

    }

    ?>

    <form method="post" action="<?php echo esc_url( site_url( 'wp-login.php?action=resetpass' ) ); ?>">

        <input type="hidden" id="user_login" name="rp_login" value="<?php echo esc_attr( $user_login ); ?>" autocomplete="off" />

        <input type="hidden" name="rp_key" value="<?php echo esc_attr( $reset_key ); ?>" />

        <p>

            <label for="pass1"><?php _e( 'New password', 'personalize-login' ) ?></label>

            <input type="password" name="pass1" id="pass1" class="input" size="20" value="" autocomplete="off" />

        </p>

        <p>

            <label for="pass2"><?php _e( 'Repeat new password', 'personalize-login' ) ?></label>

            <input type="password" name="pass2" id="pass2" class="input" size="20" value="" autocomplete="off" />

        </p>

        <p class="description"><?php echo wp_get_password_hint(); ?></p>

        <br class="clear" />

        <p class="submit"><input type="submit" name="submit" id="resetpass-button" class="button button-primary" value="<?php _e( 'Reset Password', 'personalize-login' ); ?>" /></p>

    </form>

    <?php

// show the forgot password form
else :

    ?>

    <form method="post" action="<?php echo esc_url( site_url( 'wp-login.php?action=lostpassword', 'login_post' ) ); ?>">

        <p>

            <label for="user_login"><?php _e( 'Username or E-mail:', 'personalize-login' ); ?></label>

            <input type="text" name="user_login" id="user_login" class="input" value="" size="20" />

        </p>

        <?php do_action( 'lostpassword_form' ); ?>

        <p class="submit"><input type="submit" name="submit" class="button button-primary" value="<?php _e( 'Reset My Password', 'personalize-login' ); ?>" /></p>

    </form>

    <?php

endif;


                                // Start the loop.
                                // while ( have_posts() ) : the_post();

                                //                 // Include the page content template.
                                //                 get_template_part( 'template-parts/content', 'page' );
                                //                 // If comments are open or we have at least one comment, load up the comment template.
                                //                 if ( comments_open() || get_comments_number() ) {

                                //                                 comments_template();

                                //                 }

                                //                 // End of the loop.
                                // endwhile;

                                ?>

                </main><!-- .site-main -->


</div><!-- .content-area -->


<?php get_footer(); ?>