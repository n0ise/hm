<?php
// taking the global user variable from WP
global $current_user;
get_currentuserinfo();
// and declaring... each field as a variable, eventually we can exclude or include just on select pages, with a condition like this:
// if (is_page('profile')) {
// } bla bla bla ...now it is set for ALL
// if user is not logged in show a message 
if (is_user_logged_in()) { 

$user_id = $current_user->ID;
$user = get_userdata( $user_id );
$user_roles = $user->roles;
$user_role = array_shift( $user_roles );
$user_role = $user_role;
$user_role = ucfirst($user_role);
$user_email = $user->user_email;
$user_name = $user->user_login;
$user_first_name = $user->user_firstname;
$user_last_name = $user->user_lastname;
$user_display_name = $user->display_name;
$gebur= get_field('geburt', 'user_' . $user_id);
// convert date into ymd format
$gebur_ymd = date('Y-m-d', strtotime($gebur));
$user_phone = get_field('telephone', 'user_' . $user_id);
$allerg = get_field('allergies', 'user_' . $user_id);
$user_city = get_field('stadt', 'user_' . $user_id);
$rezept = get_field('rezept', 'user_' . $user_id);
$user_zip = get_field('postcode', 'user_' . $user_id);
$user_strasse = get_field('strasse', 'user_' . $user_id);
$insurance_company = get_field('insurance_company', 'user_' . $user_id);
$insurance_number = get_field('insurance_number', 'user_' . $user_id);
$sickness = get_field('sickness', 'user_' . $user_id); 
$gender = get_field('geschlecht', 'user_' . $user_id);
$medikamente= get_field('medikamente', 'user_' . $user_id);
$start_date = get_field('start_date', 'user_' . $user_id);
$status = get_field('status', 'user_' . $user_id);
$patient_caregiver = get_field('patient_caregiver', 'user_' . $user_id);
// if status is disabled, make it red. this is a visual silly test
 if ($status == 'Aktive') {
     $status = '<span style="color:green;">' . $status . '</span>';
 }
else {  $status = '<span style="color:red;">' . $status . '</span>'; }
$rezept_end = get_field('rezept_end', 'user_' . $user_id);
// show how many days left in human readable format
 $days_left = human_time_diff( strtotime($rezept_end), current_time('timestamp') );

// if days left are less than 30, make it red. this is another visual silly test
  if ($days_left > 14) {
      $days_left = '<span style="color:red;">Expired ' . $days_left . '</span>';
  }
 else {  $days_left = '<span style="color:green;">Expiring in ' . $days_left . '</span>'; }

// it is same for $user_id, this is for testing, it is inside acf, may be deleted later (or used for matching with AVOCADO API Request)
 $new_user_id = get_field('new_user_id');

} else {
    
}
?>