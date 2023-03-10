<?php

require_once('../../../wp-load.php');

global $current_user;
get_currentuserinfo();
$logged_in_user = $current_user->ID;

$uploaddir = 'uploads/' .$logged_in_user. '/'; 

if (!file_exists($uploaddir)) {
    mkdir($uploaddir);
    $index = fopen($uploaddir . "/index.html", "w");
    fclose($index);
}

$my_file = $_FILES['my_file'];
$file_path = $my_file['tmp_name']; // temporary upload path of the file
$file_name = $_POST['name']; // desired name of the file
move_uploaded_file($file_path, $uploaddir . basename($file_name)); 