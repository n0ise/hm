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
    // save field to user profile 
	if ( !empty( $_POST['first_name'] ) ) {
		$first_name = $_POST['first_name'];
		update_user_meta( $user_id, 'first_name', $first_name );
	}
	if ( !empty( $_POST['last_name'] ) ) {
		$last_name = $_POST['last_name'];
		update_user_meta( $user_id, 'last_name', $last_name );
	}
	if ( !empty( $_POST['user_email'] ) ) {
		$email = $_POST['user_email'];
		update_user_meta( $user_id, 'user_email', $email );
	}
	if ( !empty( $_POST['telephone'] ) ) {
		$phone = $_POST['telephone'];
		update_user_meta( $user_id, 'telephone', $phone );
	}
	if ( !empty( $_POST['strasse'] ) ) {
		$address = $_POST['strasse'];
		update_user_meta( $user_id, 'strasse', $address );
	}
	if ( !empty( $_POST['stadt'] ) ) {
		$city = $_POST['stadt'];
		update_user_meta( $user_id, 'stadt', $city );
	}
	if ( !empty( $_POST['postcode'] ) ) {
		$zip = $_POST['postcode'];
		update_user_meta( $user_id, 'postcode', $zip );
	}
	if ( !empty( $_POST['geburt'] ) ) {
		$birthday = $_POST['geburt'];
		update_user_meta( $user_id, 'geburt', $birthday );
	}
	if ( !empty( $_POST['geschlecht'] ) ) {
		$gender = $_POST['geschlecht'];
		update_user_meta( $user_id, 'geschlecht', $gender );
	}
	if ( !empty( $_POST['status'] ) ) {
		$status = $_POST['status'];
		update_user_meta( $user_id, 'status', $status );
	}
	if ( !empty( $_POST['new_user_id'] ) ) {
		$new_user_id = $_POST['new_user_id'];
		update_user_meta( $user_id, 'new_user_id', $new_user_id );
	}
	if ( !empty( $_POST['allergies'] ) ) {
		$allergies = $_POST['allergies'];
		update_user_meta( $user_id, 'allergies', $allergies );
	}
	if ( !empty( $_POST['start_date'] ) ) {
		$start_date = $_POST['start_date'];
		update_user_meta( $user_id, 'start_date', $start_date );
	}
	if ( !empty( $_POST['insurance_company'] ) ) {
		$insurance_company = $_POST['insurance_company'];
		update_user_meta( $user_id, 'insurance_company', $insurance_company );
	}
	if ( !empty( $_POST['insurance_number'] ) ) {
		$insurance_number = $_POST['insurance_number'];
		update_user_meta( $user_id, 'insurance_number', $insurance_number );
	}
	if ( !empty( $_POST['krankheiten'] ) ) {
		$krankheiten = $_POST['krankheiten'];
		update_user_meta( $user_id, 'krankheiten', $krankheiten );
	}
	if ( !empty( $_POST['nrno'] ) ) {
		$nrno = $_POST['nrno'];
		update_user_meta( $user_id, 'nrno', $nrno );
	}
	if ( !empty( $_POST['zusatz'] ) ) {
		$zusatz = $_POST['zusatz'];
		update_user_meta( $user_id, 'zusatzinformationen', $zusatz );
	}
	if ( !empty( $_POST['privat_or_gesetzlich'] ) ) {
		$privat_or_gesetzlich = $_POST['privat_or_gesetzlich'];
		update_user_meta( $user_id, 'privat_or_gesetzlich', $privat_or_gesetzlich );
	}
	
	// update_user_meta( $user_id, 'medikamente', $_POST['medikamente'] );

	// update prescription_id 
	$rezept_input = get_field('rezept_input', 'user_' . $user_id);
	
	// $rezept_input[0]['rezept_id'] = $_POST['rezept_id'];

	// if is not empty and different value from before 
	if ( !empty($_POST['prescription_id']) && $_POST['prescription_id'] != $rezept_input[0]['prescription_id'] ) {
		// update prescription_id 
		$rezept_input[0]['prescription_id'] = $_POST['prescription_id'];
		update_field('rezept_input', $rezept_input, 'user_' . $user_id);
	}
	if ( !empty($_POST['doctor_name']) && $_POST['doctor_name'] != $rezept_input[0]['doctor_name'] ) {
		// update doctor_name 
		$rezept_input[0]['doctor_name'] = $_POST['doctor_name'];
		update_field('rezept_input', $rezept_input, 'user_' . $user_id);
	}
	if ( !empty($_POST['prescription_date_by_doctor']) && $_POST['prescription_date_by_doctor'] != $rezept_input[0]['prescription_date_by_doctor'] ) {
		$rezept_input[0]['prescription_date_by_doctor'] = $_POST['prescription_date_by_doctor'];
		update_field('rezept_input', $rezept_input, 'user_' . $user_id);
	}
	// update status_prescription
	if ( !empty($_POST['status_prescription']) && $_POST['status_prescription'] != $rezept_input[0]['status_prescription'] ) {
		$rezept_input[0]['status_prescription'] = $_POST['status_prescription'];
		update_field('rezept_input', $rezept_input, 'user_' . $user_id);
	}

//debug stuff, might remove later 
		echo 'success' .$first_name;
			//return success message
			wp_send_json_success(); 
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