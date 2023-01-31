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


/* Create User Role */
add_role(
    'client', //  System name of the role.
    __( 'Client'  ) // Display name of the role.
);

add_role(
    'admin_panel', //  System name of the role.
    __( 'Hellomed Admin'  ) // Display name of the role.
);

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}

//prevent email from breaking
add_filter( 'wp_mail_content_type','prevent_email_from_breaking' );
function prevent_email_from_breaking() {
        return "text/html";
}


// here temporarily, might remove later
// add_action('admin_enqueue_scripts', function() {
// 	wp_enqueue_script('edit-script', get_stylesheet_directory_uri() . '/assets/js/edit-ajax.js', ['jquery'], '', true);
// });
// add_action('admin_enqueue_scripts', function() {
// 	wp_enqueue_script('add-script', get_stylesheet_directory_uri() . '/assets/js/add-ajax.js', ['jquery'], '', true);
// });

add_action('wp_ajax_edit_patient', function() {
	
	// user_id
	$user_id = $_POST['user_id'];

	// array with all changed data inside (diff approach, might remove later)
	// $changed_fields = array();

	// this will check if any update has been made in the fields, and then show a single confirmation message in the form
	$hasError = false;
	$updates_made = false;
	$errorMessages = array();
	$updates_needed = array();
	
	if (isset($_POST['first_name'])) {
		if (empty($_POST['first_name'])) {
			$hasError = true;
			$errorMessages[] = "first_name: Bitte geben Sie Ihren Vornamen ein.";
		} else {
			if (!empty($_POST['first_name']) && $_POST['first_name'] != $user->first_name) {
				$first_name = $_POST['first_name'];
				update_user_meta($user_id, 'first_name', $first_name);
				$updates_made = true;
			}
		}
	}

	if (isset($_POST['last_name'])) {
		if (empty($_POST['last_name'])) {
			$hasError = true;
			$errorMessages[] = "last_name: Bitte geben Sie Ihren Vornamen ein.";
		} else {
			if (!empty($_POST['last_name']) && $_POST['last_name'] != $user->last_name) {
				$last_name = $_POST['last_name'];
				update_user_meta($user_id, 'last_name', $last_name);
				$updates_made = true;
			}
		}
	}

	if (isset($_POST['patient_first_name'])) {
		if (empty($_POST['patient_first_name'])) {
			$hasError = true;
			$errorMessages[] = "patient_first_name: Bitte geben Sie Ihren Vornamen ein.";
		} else {
			if ( !empty($_POST['patient_first_name']) && $_POST['patient_first_name'] != get_user_meta( $user_id, 'patient_first_name', true )) {
				$last_name = $_POST['patient_first_name'];
				$updates_needed[] = array(
				'meta_key' => 'patient_first_name',
				'meta_value' => $last_name
				);
				$updates_made = true;
				}
		}
	}
	
	if (isset($_POST['patient_last_name'])) {
		if (empty($_POST['patient_last_name'])) {
			$hasError = true;
			$errorMessages[] = "last_name: Bitte geben Sie Ihren Nachnamen ein.";
		} else {
			if (preg_match('/^[a-zA-Z ]+$/', $_POST['last_name'])) {
				if ( !empty($_POST['patient_last_name']) && $_POST['patient_last_name'] != get_user_meta( $user_id, 'patient_last_name', true )) {
					$last_name = $_POST['patient_last_name'];
					$updates_needed[] = array(
					'meta_key' => 'patient_last_name',
					'meta_value' => $last_name
					);
					$updates_made = true;
			}
			} else {
				$hasError = true;
				$errorMessages[] = "patient_last_name: Bitte geben Sie einen gültigen Nachnamen ein.";
			}
		}
	}


	// email might be not needed in the forms
	// if ( !empty($_POST['user_email']) && $_POST['user_email'] != get_user_meta( $user_id, 'user_email', true )) {
	// 	$email = $_POST['user_email'];
	// 	update_user_meta( $user_id, 'user_email', $email );
	// 	echo "<li> E-mail aktualisiert </li> ";
	// 	$updates_made = true;
	// }

	if (isset($_POST['telephone'])) {
		if (empty($_POST['telephone'])) {
			$hasError = true;
			$errorMessages[] = "telephone: Bitte geben Sie Ihre Telefonnummer ein.";
		} else {
			if (preg_match("/^(\+49|0049|0)[1-9]{1}[0-9]{9}$/", $_POST['telephone'])) {
				if ( !empty($_POST['telephone']) && $_POST['telephone'] != get_user_meta( $user_id, 'telephone', true )) {
					$phone = $_POST['telephone'];
					$updates_needed[] = array(
						'meta_key' => 'telephone',
						'meta_value' => $phone
					);
					$updates_made = true;
				}
			} else {
				$hasError = true;
				$errorMessages[] = "telephone: Bitte geben Sie eine gültige Telefonnummer im Format +491234567890, 00491234567890, oder 01234567890 ein.";
			}
		}
	}
	

	if (isset($_POST['strasse']) && (empty($_POST['strasse']))) {
		$hasError = true;
		$errorMessages[] = "strasse: Bitte geben Sie eine Strasse ein.";
		} else {
			if ( !empty($_POST['strasse']) && $_POST['strasse'] != get_user_meta( $user_id, 'strasse', true )) {
				$address = $_POST['strasse'];
				$updates_needed[] = array(
					'meta_key' => 'strasse',
					'meta_value' => $address
				);
				$updates_made = true;	
			}
		}

	if (isset($_POST['stadt']) && (empty($_POST['stadt']))) {
		$hasError = true;
		$errorMessages[] = "stadt: Bitte geben Sie eine Stadt ein.";
		} else {
			if ( !empty($_POST['stadt']) && $_POST['stadt'] != get_user_meta( $user_id, 'stadt', true )) {
				$city = $_POST['stadt'];
				$updates_needed[] = array(
					'meta_key' => 'stadt',
					'meta_value' => $city
				);
				$updates_made = true;	
			}	
		}

	if (isset($_POST['postcode'])) {
		if (empty($_POST['postcode'])) {
			$hasError = true;
			$errorMessages[] = "postcode: Bitte geben Sie eine Postleitzahl ein.";
		} else {
			if (preg_match("/^[0-9]{5}$/", $_POST['postcode'])) {
				if ( !empty($_POST['postcode']) && $_POST['postcode'] != get_user_meta( $user_id, 'postcode', true )) {
					$zip = $_POST['postcode'];
					update_user_meta( $user_id, 'postcode', $zip );
					$updates_needed[] = array(
						'meta_key' => 'stadt',
						'meta_value' => $city
					);
					$updates_made = true;
				}
			} else {
				$hasError = true;
				$errorMessages[] = "postcode: Bitte geben Sie eine gültige Postleitzahl ein (5-stellig)";
			}
		}
	}
	

	if (isset($_POST['geburt'])) {
		if (empty($_POST['geburt'])) {			
			$hasError = true;
			$errorMessages[] = "geburt: Bitte geben Sie Ihren Geburtstag ein.";
		} else {
			if ( !empty($_POST['geburt']) && $_POST['geburt'] != get_user_meta( $user_id, 'geburt', true )) {
				$birthday = $_POST['geburt'];
				update_user_meta( $user_id, 'geburt', $birthday );
				$updates_needed[] = array(
					'meta_key' => 'geburt',
					'meta_value' => $birthday
				);
				$updates_made = true;	
			}
		}
	}

	if (isset($_POST['geschlecht'])) {
		if (empty($_POST['geschlecht'])) {
			$hasError = true;
			$errorMessages[] = "geschlecht: Bitte wählen Sie ein Geschlecht aus.";
		} else {
			if (!empty($_POST['geschlecht']) && $_POST['geschlecht'] !== get_user_meta( $user_id, 'geschlecht', true )) {
				update_user_meta( $user_id, 'geschlecht', $_POST['geschlecht'] );
				$updates_needed[] = array(
					'meta_key' => 'geschlecht',
					'meta_value' => $_POST['geschlecht']
				);
				$updates_made = true;
			} elseif ($_POST['geschlecht'] === get_user_meta( $user_id, 'geschlecht', true )) {
				// there is nothing to update, go on
			} else {
				$errorMessages[] = "geschlecht: Bitte wählen Sie ein Geschlecht aus.";
				$hasError = true;
			}
		}
	}
	
	if ( !empty($_POST['status']) && $_POST['status'] != get_user_meta( $user_id, 'status', true )) {
		$status = $_POST['status'];
		update_user_meta( $user_id, 'status', $status );
		$updates_made = true;
	}

	// checking if user is set and id exists before saving 
	if (isset($_POST['new_user_id']) && (empty($_POST['new_user_id']))) {
		$hasError = true;
		$errorMessages[] = "new_user_id: Bitte geben Sie eine Benutzer-ID ein.";
		} else {
		if ( !empty($_POST['new_user_id']) && $_POST['new_user_id'] != get_user_meta( $user_id, 'new_user_id', true )) {
			$new_user_id=$_POST['new_user_id'];
			$args = array(
				  'meta_key'     => 'new_user_id',
				  'meta_value'   => $_POST['new_user_id'],
				  'meta_compare' => '=',
				  'fields'       => 'ID'
			);
	
			$existingUsers = get_users($args);
		if (!empty($existingUsers)) {
			$hasError = true;
			$errorMessages[] = "new_user_id: Benutzer-ID existiert bereits, wählen Sie eine andere.";
		} else {
			$updates_needed[] = array(
				'meta_key' => 'new_user_id',
				'meta_value' => $new_user_id
			);
			$updates_made = true;		
		}
	}
}	

	if ( !empty($_POST['allergies']) && $_POST['allergies'] != get_user_meta( $user_id, 'allergies', true )) {
		$allergies = $_POST['allergies'];
		update_user_meta( $user_id, 'allergies', $allergies );
		$updates_made = true;
	}

	if ( !empty($_POST['start_date']) && $_POST['start_date'] != get_user_meta( $user_id, 'start_date', true )) {
		$start_date = $_POST['start_date'];
		update_user_meta( $user_id, 'start_date', $start_date );
		$updates_made = true;
	}

	if (isset($_POST['insurance_company']) && $_POST['insurance_company'] != get_user_meta( $user_id, 'insurance_company', true )) {
		$insurance_company = $_POST['insurance_company'];
		update_user_meta( $user_id, 'insurance_company', $insurance_company );
		$updates_made = true;
		}
		
		if (isset($_POST['insurance_number']) && $_POST['insurance_number'] != get_user_meta( $user_id, 'insurance_number', true )) {
		$insurance_number = $_POST['insurance_number'];
		update_user_meta( $user_id, 'insurance_number', $insurance_number );
		$updates_made = true;
		}

	if (isset($_POST['krankheiten']) && $_POST['krankheiten'] != get_user_meta( $user_id, 'krankheiten', true )) {
		$krankheiten = $_POST['krankheiten'];
		update_user_meta( $user_id, 'krankheiten', $krankheiten );
		$updates_made = true;
		}

	if (isset($_POST['nrno']) && (empty($_POST['nrno']))) {
		$hasError = true;
		$errorMessages[] = "nrno: Bitte geben Sie Ihre Hausnummer ein";
	} else {
			if ( !empty($_POST['nrno']) && $_POST['nrno'] != get_user_meta( $user_id, 'nrno', true )) {
				$nrno = $_POST['nrno'];
				update_user_meta( $user_id, 'nrno', $nrno );
				$updates_made = true;
			}
		}

	if (isset($_POST['zusatz']) && $_POST['zusatz'] != get_user_meta( $user_id, 'zusatzinformationen', true )) {
		$zusatz = $_POST['zusatz'];
		update_user_meta( $user_id, 'zusatzinformationen', $zusatz );
		$updates_made = true;
	}

	if(isset($_POST['privat_or_gesetzlich'])) {
		$privat_or_gesetzlich = $_POST['privat_or_gesetzlich'];
		if ($privat_or_gesetzlich != get_user_meta( $user_id, 'privat_or_gesetzlich', true )) {
			update_user_meta( $user_id, 'privat_or_gesetzlich', $privat_or_gesetzlich );
			$updates_made = true;
		}
	}

	   // debug
	   // $rezept_input[0]['rezept_id'] = $_POST['rez
	/// remove all elements 

	// Blister job and medikament in the Rezeptverwaltung-edit, those are nested and culprit of many sleepless night.

	$rezept_input = get_field('rezept_input', 'user_'.$user_id);
	$prescription_id = $_POST['rezept_id'];

	// basically checking if the prescription_id is inside a repeater field, and then taking the $post as array and update the correspondent field.

foreach ($rezept_input as &$record) {
  if ($record['prescription_id'] == $prescription_id) {
	if (!empty($_POST['prescription_id']) && $_POST['prescription_id'] != $record['prescription_id']) {
		// check if the value already exists in the array
		if (array_search($_POST['prescription_id'], array_column($rezept_input, 'prescription_id')) === false) {
			$record['prescription_id'] = $_POST['prescription_id'];
			$updates_needed[] = array(
				'meta_key' => 'prescription_id',
				'meta_value' => $record['prescription_id']
			);
			$updates_made = true;		
		} else {
			$hasError = true;
			$errorMessages[]= "prescription_id: Rezept-ID existiert bereits, wählen Sie eine andere.";
		}
	}
	
	if (isset($_POST['doctor_name']) && (empty($_POST['doctor_name']))) {
		$hasError = true;
		$errorMessages[] = "doctor_name: Bitte geben Sie Ihre Artz ein";
		} else {
			if ( !empty($_POST['doctor_name']) && $_POST['doctor_name'] != $record['doctor_name'] ) {
				$record['doctor_name'] = $_POST['doctor_name'];
				$updates_made = true;
			}
		}
	
		if (isset($_POST['prescription_date_by_doctor'])) {
			if (!empty($_POST['prescription_date_by_doctor'])) {
			  $record['prescription_date_by_doctor'] = $_POST['prescription_date_by_doctor'];
			  $updates_made = true;
			} else {
			  $hasError = true;
			  $errorMessages[] = "prescription_date_by_doctor: Bitte geben Sie ein Datum ein.";
			}
		  }
		  
		  if (isset($_POST['prescription_end_date'])) {
			if (!empty($_POST['prescription_end_date'])) {
			  $record['prescription_end_date'] = $_POST['prescription_end_date'];
			  $updates_made = true;
			} else {
			  $hasError = true;
			  $errorMessages[]= "prescription_end_date: Bitte geben Sie ein Enddatum ein.";
			}
		  }
		  if (isset($_POST['prescription_start_date'])) {
			if (!empty($_POST['prescription_start_date'])) {
			  $record['prescription_start_date'] = $_POST['prescription_start_date'];
			  $updates_made = true;
			} else {
			  $hasError = true;
			  $errorMessages[]= "prescription_start_date: Bitte geben Sie ein Startdatum ein.";
			}
		  }
		 
	if (isset($_POST['status_prescription'])) {
		if ( !empty($_POST['status_prescription']) && $_POST['status_prescription'] != "Bitte wählen") {
			$record['status_prescription'] = $_POST['status_prescription'];
			$updates_made = true;
		} else {
			$hasError = true;
			$errorMessages[] = "status_prescription: Bitte wählen Sie einen Status aus.";
		}
	}

	foreach ($_POST['blister_jobs'] as $item) {
		if (empty($item['blister_job_id']) || empty($item['blister_start_date']) || empty($item['blister_end_date'])) {
			$errorMessages[] = "blister: Bitte füllen Sie alle Felder für den Blister-Job aus.";
			$hasError = true;
		} else {
			$record['blister_job'] = $_POST['blister_jobs'];
			$updates_made = true;
		}
	}
	
	foreach ($_POST['medikament'] as $item) {
		if (empty($item['medicine_name_pzn']) || empty($item['medicine_amount'])) {
			$errorMessages[] = "inhalt: Bitte füllen Sie alle Felder für den Medikamente aus.";
			$hasError = true;
		} else {
			$record['medicine_section'] = $_POST['medikament'];
			$updates_made = true;
		}
	}
	
	// if ( !empty($_POST['medikament']) && $_POST['medikament'] != $record['medikament'] ) {
		// $record['medicine_section'] = $_POST['medikament'];
		// echo "<li> Medikament aktualisiert </li> ";
	// }

    break; // exit loop
  }
}


update_field('rezept_input', $rezept_input, 'user_'.$user_id);


if (($updates_made) && (!$hasError)) {
    foreach ($updates_needed as $update) {
        update_user_meta( $user_id, $update['meta_key'], $update['meta_value'] );
    }
    $response = array(
        'status' => 'success',
        'message' => 'Änderungen erfolgreich gespeichert'
    );
} else {
	// if response message is empty, then no error message was set, so we set a default one :)
	if (empty($errorMessages)) {
		$errorMessages[] = "successdown: Es gab keine neuen Felder zum Speichern.";
	} 
    $response = array(
        'status' => 'error',
        'message' => $errorMessages
    );
}

echo json_encode($response);

	wp_die();
});

///////////////////////////////////////
// Function for /admin-new-rezepverwaltung
///////////////////////////////////////

add_action('wp_ajax_new_prescription', function() {
	$hasError = false;
	$updates_made = false;
	$errorMessages = array();
	$updates_needed = array();
	$user_id =  $_POST['user_id'];
	$rezept_input = get_field('rezept_input', 'user_'.$user_id);
 	// deutsche blister ID 
	$new_user_id = 	$_POST['patient_select'];

	// checking if the id is already existen, and then update 
	if (!empty($rezept_input)) {
		foreach ($rezept_input as $input) {
		  if ($input['prescription_id'] == $_POST['prescription_id_no']) {
			$hasError = true;
			$errorMessages[] = "successdown: Sie hatten so viel Pech, dass die zufällige ID dieselbe wie eine andere in der Datenbank war. Bitte erneut einreichen.";
			break;
		  }
		}
	  }
	  
	  if (!$hasError) {
		$new_row = array('prescription_id' => $_POST['prescription_id_no'], 'medicine_section' => [], 'blister_job' => []);
		$updated_made = true;
	  }
	// $new_row = array('prescription_id' => $_POST['prescription_id_no'], 'medicine_section' => [], 'blister_job' => []);
	


	if ( !empty($_POST['patient_select'])) {
		$new_row['new_user_id'] = $_POST['patient_select'];
		$updated_made=true;
	} else {
		$hasError = true;
		$errorMessages[]= "patient_select: Bitte wählen Sie einen Patienten aus der Liste aus.";
	}
	
	if ( !empty($_POST['doctor_name'])) {
		$new_row['doctor_name'] = $_POST['doctor_name'];
		$updates_made = true;
	} else {
		$errorMessages[]= "doctor_name: Bitte schreiben Sie einen Arzt.";

	}

	if (!empty($_POST['rezept_type'])) {
		$new_row['rezept_file'][0]['rezept_type'] = $_POST['rezept_type'];
		$updates_made = true;
		} else {
		$errorMessages[]= "rezept_type: Bitte geben Sie einen Rezepttyp an.";
		}
	
	if ( !empty($_POST['prescription_date_by_doctor'])) {
		$new_row['prescription_date_by_doctor'] = $_POST['prescription_date_by_doctor'];
		$updates_made = true;
	} else {
		$hasError = true;
		$errorMessages[]= "prescription_date_by_doctor: Bitte geben Sie ein Datum ein.";
	}
	
	if ( !empty($_POST['prescription_start_date'])) {
		$new_row['prescription_start_date'] = $_POST['prescription_start_date'];
		$updates_made = true;
	} else {
		$hasError = true;
		$errorMessages[]= "prescription_start_date: Bitte geben Sie ein Startdatum ein.";
	}

	if ( !empty($_POST['prescription_end_date'])) {
		$new_row['prescription_end_date'] = $_POST['prescription_end_date'];
		$updates_made = true;
	} else {
		$hasError = true;
		$errorMessages[]= "prescription_end_date: Bitte geben Sie ein Enddatum ein.";
	}
	
	if (isset($_POST['status_prescription'])) {
		if ( !empty($_POST['status_prescription']) && $_POST['status_prescription'] != "Bitte wählen") {
		$new_row['status_prescription'] = $_POST['status_prescription'];
		$updates_made = true;
		} else {
		$hasError = true;
		$errorMessages[] = "status_prescription: Bitte wählen Sie einen Status aus.";
		}
		}
	
	foreach ($_POST['medikament'] as $item) {
		if (empty($item['medicine_name_pzn']) || empty($item['medicine_amount'])) {
				$errorMessages[] = "Bitte füllen Sie alle Felder für den Medikamente aus.";
				$hasError = true;
			} 
		else
			{
				$new_row['medicine_section'][] = array('medicine_name_pzn' => $item['medicine_name_pzn'], 'medicine_amount' => $item['medicine_amount']);
				$updates_made = true;	
			}
		}

	foreach ($_POST['blister_jobs'] as $item) {
    	if (empty($item['blister_job_id']) || empty($item['blister_start_date']) || empty($item['blister_end_date'])) {
       			$errorMessages[] = "Bitte füllen Sie alle Felder für den Blister-Job aus.";
       			$hasError = true;
    		} 
		else 
			{
        		$new_row['blister_job'][] = array('blister_job_id' => $item['blister_job_id'], 'blister_start_date' => $item['blister_start_date'], 'blister_end_date' => $item['blister_end_date']);
        		$updates_made = true;
			}
		}

	// cleaning later, debug 
	// update_field('rezept_input', array('blister_job' => $blister_job), 'user_'.$user_id);

	
	// update_field('rezept_input', $rezept_input, 'user_' . $user_id);

	// $response = array(
	// 	'status' => 'success',
	// 	'message' => 'Änderungen erfolgreich gespeichert'
	// );



	if (($updates_made) && (!$hasError)) {
	// 	foreach ($updates_needed as $update) {
			$rezept_input[] = $new_row;
	// 	}
		update_field('rezept_input', $rezept_input, 'user_' . $user_id);
		$response = array(
			'status' => 'success',
			'message' => 'Änderungen erfolgreich gespeichert'
		);
	} else {
	//  if response message is empty, then no error message was set, so we set a default one :)
		if (empty($errorMessages)) {
			$errorMessages[] = "successdown: Es gab keine neuen Felder zum Speichern.";
		} 
		$response = array(
			'status' => 'error',
			'message' => $errorMessages
		);
	}
	
echo json_encode($response);

wp_die();
});


 // fill patient/caregiver filed in ninja form, with the custom field for patient/caregiver taken from the registration form
 add_filter( 'ninja_forms_render_default_value', 'fill_ninja_patient', 10, 3 );
 function fill_ninja_patient( $default_value, $field_type, $field_settings ) {
    if ( $field_settings['key'] == 'patient_caregiver_input' ) {
// default value of the acf field patient_caregiver 
		$default_value = get_field('patient_caregiver', 'user_'.get_current_user_id());
	}
	return $default_value;
   
 } 


add_filter( 'manage_users_columns', 'column_register_wpse_101322' );

add_filter( 'manage_users_custom_column', 'column_display_wpse_101322', 10, 3 );

function column_register_wpse_101322( $columns )
{

    $columns['patient_caregiver'] = 'Client Role';
	$columns['confirmed_or_not'] = 'Confirmed email';
    return $columns;
}

 function column_display_wpse_101322( $value, $column_name, $user_id )
{
  $user_info = get_user_meta( $user_id, 'patient_caregiver', true );
  $user_info2 = get_user_meta( $user_id, 'confirmed_or_not', true );


  if($column_name == 'patient_caregiver') 
  return $user_info;

  if($column_name == 'confirmed_or_not') 
  return $user_info2;

  return $value;
}

// add a new input field, after field nf-field-588, in ninja form
add_action( 'ninja_forms_after_fields', 'add_new_field' );
function add_new_field() {
	$field_id = 588;
	$field = Ninja_Forms()->form()->get_field( $field_id );
	$form_id = $field->get_form_id();
	$form = Ninja_Forms()->form( $form_id )->get();
	$fields = $form->get_fields();
	$field_index = array_search( $field_id, array_keys( $fields ) );
	$new_field = Ninja_Forms()->form()->field()->get();
	$new_field->update_settings( array(
		'key' => 'patient_caregiver_input',
		'label' => 'Patient/Caregiver',
		'type' => 'textbox',
		'order' => $field_index + 1,
		'parent_id' => $form_id,
		'default_value' => get_field('patient_caregiver', 'user_'.get_current_user_id()),
	) );
	$new_field->save();
	$form->add_field( $new_field );
	$form->save();
}