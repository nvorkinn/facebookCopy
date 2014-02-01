<?php
include '../includes/php-includes.php';

// Adding privacy_setting entry. This is required to make a profile
$privacy_setting_insert = "INSERT INTO privacy_setting (visible_to, name) VALUES (99, 'somename')";

if (!mysqli_query($link, $privacy_setting_insert)) {
	echo "Could not insert entry into the privacy_setting table";
	die('Error: ' . mysqli_error($link));
}

// Get the auto-incremented value
$privacy_id = mysqli_insert_id($link);

// Get and escape values of web page fields
$email = mysqli_real_escape_string($link, $_POST["email"]);
$firstname = mysqli_real_escape_string($link, $_POST["firstname"]);
$lastname = mysqli_real_escape_string($link, $_POST["lastname"]);
$birthdate = mysqli_real_escape_string($link, $_POST["birthdate"]);
$password = rand(1000, 5000);

// Use fields to create a new entry in the profile table
$profile_insert = "INSERT INTO profile (type, privacy_setting_id, photo_code, username, name, surname, dob, email, password) VALUES (99, $privacy_id, 99, '". $email ."', '". $firstname ."', '". $lastname ."', '". $birthdate ."', '". $email ."', '". md5($password) ."') ";
if (!mysqli_query($link ,$profile_insert)) {
	echo "Could not insert entry into the profile table";
	die('Error: ' . mysqli_error($link));
}

// Get the auto-incremented value from the profile entry and create a random hash
$profile_id = mysqli_insert_id($link);
$hash = md5(rand(0, 1000));

// Add a new user table entry with the hash and the profile_id
$user_insert = "INSERT INTO user (profile_id, admin, verified, online, hash) VALUES (".$profile_id.", 99, 0, 99, '". $hash ."')";
if (!mysqli_query($link, $user_insert)) {
	echo "Could not insert entry into user table";
	die('Error: '.mysqli_error());
}

// Send email verification message to user with hash
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
?>