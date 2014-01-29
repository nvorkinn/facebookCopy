<?php
include '../includes/php-includes.php';

$data = array();
$data['exists'] = false;

$email = mysql_real_escape_string($_POST['login-email']);
$password = mysql_real_escape_string($_POST['login-password']);
$query = "SELECT user.id,user.admin,user.verified,user.profile_id,profile.name,profile.surname FROM user,profile WHERE profile.email='$email' AND profile.password='$password' AND user.profile_id=user.profile_id";

$result = mysql_query($query,$link);

if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

$row = mysql_fetch_row($result);

if(mysql_num_rows($result) == 1) {
    $data = $row;
	$data['exists'] = true;
}else if(mysql_num_rows($result)>1){
	echo 'Error: found more than one user, this should never happen!!!!!';
    exit;
}

echo json_encode($data);
?>