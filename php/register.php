<?php
include '../includes/php-includes.php';

$privacy_setting_insert = "INSERT INTO privacy_setting (visible_to, name) VALUES (99, 'somename')";

if (!mysqli_query($connection, $privacy_setting_insert)) {
	echo "Could not insert entry into the privacy_setting table";
	die('Error: ' . mysqli_error($connection));
}
echo "1 record added in privacy_setting \n";

$privacy_id = mysqli_insert_id($connection);

$email = mysqli_real_escape_string($connection, $_POST["email"]);
$firstname = mysqli_real_escape_string($connection, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($connection, $_POST["lastname"]);
$birthdate = mysqli_real_escape_string($connection, $_POST["birthdate"]);
$password = rand(1000, 5000);

$profile_insert = "INSERT INTO profile (type, privacy_setting_id, photo_code, username, name, surname, dob, email, password) VALUES (99, $privacy_id, 99, '". $email ."', '". $firstname ."', '". $lastname ."', '". $birthdate ."', '". $email ."', '". md5($password) ."') ";
if (!mysqli_query($connection ,$profile_insert)) {
	echo "Could not insert entry into the profile table";
	die('Error: ' . mysqli_error($connection));
}
echo "1 record added in profile";

$profile_id = mysqli_insert_id($connection);
$hash = md5(rand(0, 1000));

$user_insert = "INSERT INTO user (profile_id, admin, verified, online, hash) VALUES (".$profile_id.", 99, 0, 99, '". $hash ."')";
if (!mysqli_query($connection, $user_insert)) {
	echo "Could not insert entry into user table";
	die('Error: '.mysqli_error());
}

$subject = 'FacebookCopy | Profile Verification';
$message = '
Thanks for signing up to FacebookCopy!
A user account has been created for you. The cridentials you need to log in are listed below:

*************************************
Username: '.$email.'
Password: '.$password.'
*************************************
			
Please click the link below to activate the account:

http://localhost/php/validate_user.php?email='.$email.'&hash='.$hash.'
			
';

$headers = 'From: Me <nikolai.vorkinn.10@ucl.ac.uk>';

mail($email, $subject, $message, $headers);

mysqli_close($connection);

?>