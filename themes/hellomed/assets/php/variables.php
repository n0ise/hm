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
$user_phone = get_field('telephone', 'user_' . $user_id);
$allerg = get_field('allergies', 'user_' . $user_id);
$user_city = get_field('stadt', 'user_' . $user_id);
$rezept = get_field('rezept', 'user_' . $user_id);
$user_zip = get_field('postcode', 'user_' . $user_id);
$user_country = get_field('strasse', 'user_' . $user_id);
$status = get_field('status', 'user_' . $user_id);
$status = get_field('status', 'user_' . $user_id);
// if status is disabled, make it red. this is a visual silly test
 if ($status == 'Aktive') {
     $status = '<span style="color:green;">' . $status . '</span>';
 }
else {  $status = '<span style="color:red;">' . $status . '</span>'; }
// show the rezept with dmy
$rezept_enddmy = get_field('rezept_end', 'user_' . $user_id);

// show the rezept, and how many days are left (it's in unix time)

$rezept_end = get_field('rezept_end', 'user_' . $user_id);
$rezept_end = strtotime($rezept_end);
$rezept_end = date('d.m.Y', $rezept_end);
$rezept_end = strtotime($rezept_end);
$today = strtotime(date('d.m.Y'));
$days_left = ($rezept_end - $today) / (60 * 60 * 24);
$days_left = round($days_left);
$days_left = $days_left . ' days left';
// test purposes, follow "if" needs to be refactored, perhaps with switch case or something not this ugly
 if ($days_left == '0 days left') {
     $days_left = 'Today is the last day';
 }
 if ($days_left == '1 days left') {
     $days_left = 'Tomorrow is the last day';
 }
 if ($days_left == '-1 days left') {
     $days_left = 'Yesterday was the last day';
 }
 if ($days_left < 0) {
     $days_left = 'Rezept is expired';
 }
 if ($days_left == '1 days left') {
     $days_left = 'Tomorrow is the last day';
 }
 if ($days_left == '2 days left') {
     $days_left = 'In 2 days is the last day';
 }
 if ($days_left == '3 days left') {
     $days_left = 'In 3 days is the last day';
 }
 if ($days_left == '4 days left') {
     $days_left = 'In 4 days is the last day';
 }
 if ($days_left == '5 days left') {
     $days_left = 'In 5 days is the last day';
 }
 if ($days_left == '6 days left') {
     $days_left = 'In 6 days is the last day';
 }
 if ($days_left == '7 days left') {
     $days_left = 'In a week is the last day';
 }

// it is same for $user_id, this is for testing, it is inside acf, may be deleted later
 $new_user_id = get_field('new_user_id');

} else {
    
}
?>