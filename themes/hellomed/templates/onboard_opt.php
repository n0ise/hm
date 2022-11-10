<?php /* Template Name: Onboarding START */ ?>

<?php get_header(); ?>

<div id="primary" class="content-area">

                <main id="main" class="site-main" role="main">
                                <?php
                                // if user is logged in, show shortcode for funnel profile
                                if ( is_user_logged_in() ) {
                                    echo "ok loggee in";
                                    echo do_shortcode('[ninja_form id=23]');
                                } else {
                                    echo "ok NOTtt in";
                                    // if user is not logged in, show shortcode for login
                                    echo do_shortcode('[ninja_form id=21]');
                                }
?>
                </main><!-- .site-main -->


</div><!-- .content-area -->


<?php get_footer(); ?>