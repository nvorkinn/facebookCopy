<?php
include '../includes/php-includes.php';

// Ensure both email and hash are present in URL
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	
	// Get data off URL
	$email = mysqli_escape_string($link, $_GET['email']);
	$hash = mysqli_escape_string($link, $_GET['hash']);
	
	// Search for un-verified entry
	$search = mysqli_query($link, "SELECT email, hash, verified FROM user u, profile p
				WHERE email='".$email."'AND hash='".$hash."' AND verified=0
				AND p.id = u.profile_id") or die(mysql_error($link));
	$match = mysqli_num_rows($search);
	
	// If there was a match, set it to active
	if ($match > 0) {
		
		mysqli_query($link, "UPDATE user u, profile p SET verified=1
		WHERE email='".$email."' AND hash='".$hash."'AND verified=0
		AND p.id = u.profile_id") or die(mysqli_error($link));
	}
	else {
		
		echo 'There were no results in the database with that email and hash,
				or it has already been verified.';
	}
}
else {
	
	echo "Either email or hash isn't set properly in URL";
}