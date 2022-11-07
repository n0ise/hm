<?php
function my_theme_enqueue_styles() {
 $parent_style = 'parent-style'; // Estos son los estilos del tema padre recogidos por el tema hijo.
 wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
 wp_enqueue_style( 'child-style',
 get_stylesheet_directory_uri() . '/style.css',
 array( $parent_style ),
 wp_get_theme()->get('Version')
 );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );




/* deactivate it , keeping in case we need it
* Creating a doctor CPT*/
  
// function custom_post_type() {
  
// 	// Set UI labels for Custom Post Type
// 		$labels = array(
// 			'name'                => _x( 'Doctors', 'Post Type General Name', 'twentytwentyone' ),
// 			'singular_name'       => _x( 'Doctor', 'Post Type Singular Name', 'twentytwentyone' ),
// 			'menu_name'           => __( 'Doctors', 'twentytwentyone' ),
// 			'parent_item_colon'   => __( 'Parent Doctor', 'twentytwentyone' ),
// 			'all_items'           => __( 'All Doctors', 'twentytwentyone' ),
// 			'view_item'           => __( 'View Doctor', 'twentytwentyone' ),
// 			'add_new_item'        => __( 'Add New Doctor', 'twentytwentyone' ),
// 			'add_new'             => __( 'Add New', 'twentytwentyone' ),
// 			'edit_item'           => __( 'Edit Doctor', 'twentytwentyone' ),
// 			'update_item'         => __( 'Update Doctor', 'twentytwentyone' ),
// 			'search_items'        => __( 'Search Doctor', 'twentytwentyone' ),
// 			'not_found'           => __( 'Not Found', 'twentytwentyone' ),
// 			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
// 		);
		  
// 	// Set other options for Custom Post Type
		  
// 		$args = array(
// 			'label'               => __( 'doctor', 'twentytwentyone' ),
// 			'description'         => __( 'List of doctors', 'twentytwentyone' ),
// 			'labels'              => $labels,
// 			// Features this CPT supports in Post Editor
// 			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
// 			// You can associate this CPT with a taxonomy or custom taxonomy. 
// 			'taxonomies'          => array( 'genres' ),
// 			/* A hierarchical CPT is like Pages and can have
// 			* Parent and child items. A non-hierarchical CPT
// 			* is like Posts.
// 			*/
// 			'hierarchical'        => false,
// 			'public'              => true,
// 			'show_ui'             => true,
// 			'show_in_menu'        => true,
// 			'show_in_nav_menus'   => true,
// 			'show_in_admin_bar'   => true,
// 			'menu_position'       => 10,
// 			'menu_icon'           => 'dashicons-nametag',
// 			'can_export'          => true,
// 			'has_archive'         => true,
// 			'exclude_from_search' => false,
// 			'publicly_queryable'  => true,
// 			'capability_type'     => 'post',
// 			'show_in_rest' => true,
	  
// 		);
		  
// 		// Registering your Custom Post Type
// 		register_post_type( 'doctors', $args );
	  
// 	}
	  
// 	/* Hook into the 'init' action so that the function
// 	* Containing our post type registration is not 
// 	* unnecessarily executed. 
// 	*/
	  
// 	add_action( 'init', 'custom_post_type', 0 );


// 	/*
// * Creating a doctor CPT*/
  
// function custom_post_type_medicine() {
  
// 	// Set UI labels for Custom Post Type
// 		$labels = array(
// 			'name'                => _x( 'Medicines', 'Post Type General Name', 'twentytwentyone' ),
// 			'singular_name'       => _x( 'Medicine', 'Post Type Singular Name', 'twentytwentyone' ),
// 			'menu_name'           => __( 'Medicines', 'twentytwentyone' ),
// 			'parent_item_colon'   => __( 'Parent Medicine', 'twentytwentyone' ),
// 			'all_items'           => __( 'All Medicines', 'twentytwentyone' ),
// 			'view_item'           => __( 'View Medicine', 'twentytwentyone' ),
// 			'add_new_item'        => __( 'Add New Medicine', 'twentytwentyone' ),
// 			'add_new'             => __( 'Add New', 'twentytwentyone' ),
// 			'edit_item'           => __( 'Edit Medicine', 'twentytwentyone' ),
// 			'update_item'         => __( 'Update Medicine', 'twentytwentyone' ),
// 			'search_items'        => __( 'Search Medicine', 'twentytwentyone' ),
// 			'not_found'           => __( 'Not Found', 'twentytwentyone' ),
// 			'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwentyone' ),
// 		);
		  
// 	// Set other options for Custom Post Type
		  
// 		$args = array(
// 			'label'               => __( 'medicine', 'twentytwentyone' ),
// 			'description'         => __( 'List of medicines', 'twentytwentyone' ),
// 			'labels'              => $labels,
// 			// Features this CPT supports in Post Editor
// 			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
// 			// You can associate this CPT with a taxonomy or custom taxonomy. 
// 			'taxonomies'          => array( 'genres' ),
// 			/* A hierarchical CPT is like Pages and can have
// 			* Parent and child items. A non-hierarchical CPT
// 			* is like Posts.
// 			*/
// 			'hierarchical'        => false,
// 			'public'              => true,
// 			'show_ui'             => true,
// 			'show_in_menu'        => true,
// 			'show_in_nav_menus'   => true,
// 			'show_in_admin_bar'   => true,
// 			'menu_position'       => 11,
// 			'menu_icon'           => 'dashicons-beer',
// 			'can_export'          => true,
// 			'has_archive'         => true,
// 			'exclude_from_search' => false,
// 			'publicly_queryable'  => true,
// 			'capability_type'     => 'post',
// 			'show_in_rest' => true,
	  
// 		);
		  
// 		// Registering your Custom Post Type
// 		register_post_type( 'medicines', $args );
	  
// 	}
	  
// 	/* Hook into the 'init' action so that the function
// 	* Containing our post type registration is not 
// 	* unnecessarily executed. 
// 	*/
	  
// 	add_action( 'init', 'custom_post_type_medicine', 0 );


	/******************************************
* SHOW ALL doctors IN FIELD WITH KEY "doctorsmulti"
******************************************/
// add_filter( 'ninja_forms_render_options', function($options,$settings){
// 	if( $settings['key'] == 'docs_checklist' ){
// 		$args = array(
// 			'post_type' => 'doctors',
// 			'orderby' => 'menu_order',
// 			'order' => 'ASC',
// 			'posts_per_page' => 100,
// 			'post_status' => 'publish'
// 		);
// 		$the_query = new WP_Query( $args ); 
// 		if ( $the_query->have_posts() ){
// 			global $post;
// 			while ( $the_query->have_posts() ){
// 				$the_query->the_post();
// 				$options[] = array('label' => get_field( "namedoc",$post->ID )."<br>".get_field( "addressdoc",$post->ID )."<br>".get_field( "telephonedoc",$post->ID ), 'value' => get_the_title( ));
// 			}
// 			wp_reset_postdata(); 
// 		}
// 	}
// 	return $options;
//  },10,2);

 	/******************************************
* SHOW ALL medicines IN FIELD WITH KEY "medicines_form"
******************************************/
// add_filter( 'ninja_forms_render_options', function($options,$settings){
// 	if( $settings['key'] == 'medicines_checklist' ){
// 		$args = array(
// 			'post_type' => 'medicines',
// 			'orderby' => 'menu_order',
// 			'order' => 'ASC',
// 			'posts_per_page' => 100,
// 			'post_status' => 'publish'
// 		);
// 		$the_query = new WP_Query( $args ); 
// 		if ( $the_query->have_posts() ){
// 			global $post;
// 			while ( $the_query->have_posts() ){
// 				$the_query->the_post();
// 				$options[] = array('label' => get_the_title( ), 'value' => get_the_title( ));
// 			}
// 			wp_reset_postdata(); 
// 		}
// 	}
// 	return $options;
//  },10,2);


// begin custom post type for reviews 
function custom_post_type_reviews() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Reviews', 'Post Type General Name', 'twentyseventeen' ),
			'singular_name'       => _x( 'Review', 'Post Type Singular Name', 'twentyseventeen' ),
			'menu_name'           => __( 'Reviews', 'twentyseventeen' ),
			'parent_item_colon'   => __( 'Parent Review', 'twentyseventeen' ),
			'all_items'           => __( 'All Reviews', 'twentyseventeen' ),
			'view_item'           => __( 'View Review', 'twentyseventeen' ),
			'add_new_item'        => __( 'Add New Review', 'twentyseventeen' ),
			'add_new'             => __( 'Add New', 'twentyseventeen' ),
			'edit_item'           => __( 'Edit Review', 'twentyseventeen' ),
			'update_item'         => __( 'Update Review', 'twentyseventeen' ),
			'search_items'        => __( 'Search Review', 'twentyseventeen' ),
			'not_found'           => __( 'Not Review Found', 'twentyseventeen' ),
			'not_found_in_trash'  => __( 'Not Review found in Trash', 'twentyseventeen' ),
		);
		  
	// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'review', 'twentyseventeen' ),
			'description'         => __( 'List of reviews', 'twentyseventeen' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			'taxonomies'          => array( 'hellomed_reviews' ),
			/* A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 11,
			'menu_icon'           => 'dashicons-format-quote',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest' => true,
	  
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'reviews', $args );
	  
	}
	  
	/* Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	  
	add_action( 'init', 'custom_post_type_reviews', 0 );
	// end of review custom post type 


 function debug_to_console( $data ) {
	if ( is_array( $data ) )
	 $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
	 else
	 $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";
	echo $output;
	}
//Disable emojis in WordPress
add_action( 'init', 'smartwp_disable_emojis' );

function smartwp_disable_emojis() {
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );
  remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
}

function disable_emojis_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}


// remove google fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );



//  GTM in head
function dcms_add_google_tag_manager_head() { ?>

<!-- Google Tag Manager -->
<!-- <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P4KJF2M');</script> -->
<!-- End Google Tag Manager -->

<?php }
// add_action('wp_head', 'dcms_add_google_tag_manager_head');


//  GTM in body - noscript
function dcms_add_google_tag_manager_body() { ?>

	<!-- Google Tag Manager (noscript) -->
<!-- <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P977PPD" -->
<!-- 	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P4KJF2M" -->

height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<?php }
add_action( 'wp_body_open', 'dcms_add_google_tag_manager_body' );

// Elementor empty query text
add_action('elementor/query/query_results', function($query) {
	$total = $query->found_posts;
	if ($total == 0) {
		echo '<h2 style="text-align:center;">Keine Ergebnisse gefunden.</h2>';
	}
});


add_action( 'wp_head', function(){
    ?>
    <meta name="facebook-domain-verification" content="gapf5tqscvrmbe0pimp9wjc3s4upi4" />
    <?php
});