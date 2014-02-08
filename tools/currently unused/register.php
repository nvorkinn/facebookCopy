<?PHP

	require_once ($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");

	// Adding privacy_setting entry. This is required to make a profile
	$privacy_setting_insert = "INSERT INTO privacy_setting (visible_to, name) VALUES (99, 'somename')";

	if (!mysqli_query($mysqli, $privacy_setting_insert)) {
		echo "Could not insert entry into the privacy_setting table";
		die("Error: " . mysqli_error($mysqli));
	}

	// Get the auto-incremented value
	$privacy_id = mysqli_insert_id($mysqli);

	// Get and escape values of web page fields
	$email = mysqli_real_escape_string($mysqli, $_POST["email"]);
	$firstname = mysqli_real_escape_string($mysqli, $_POST["firstname"]);
	$lastname = mysqli_real_escape_string($mysqli, $_POST["lastname"]);
	$birthdate = mysqli_real_escape_string($mysqli, $_POST["birthdate"]);
	$password = sha1(mysqli_real_escape_string($mysqli, $_POST["password"]));

	// Use fields to create a new entry in the profile table
	$profile_insert = "INSERT INTO profile (type, privacy_setting_id, photo_code, name, surname, dob, email, password) VALUES (99, $privacy_id, 99, '$firstname', '$lastname', '$birthdate', '$email', '$password') ";
	if (!mysqli_query($mysqli ,$profile_insert)) {
		echo "Could not insert entry into the profile table";
		die("Error: " . mysqli_error($mysqli));
	}

	// Get the auto-incremented value from the profile entry and create a random hash
	$profile_id = mysqli_insert_id($mysqli);
	$hash = md5(rand(0, 1000));

	// Add a new user table entry with the hash and the profile_id
	$user_insert = "INSERT INTO user (profile_id, admin, verified, online, hash) VALUES (" . $profile_id . ", 99, 0, 99, '". $hash ."')";
	if (!mysqli_query($mysqli, $user_insert)) {
		echo "Could not insert entry into user table";
		die("Error: " . mysqli_error());
	}

	// Send email verification message to user with hash
	$subject = "FacebookCopy | Profile Verification";
	$message = "
	Thanks for signing up to FacebookCopy!
	A user account has been created for you. The username you need to log in are listed below:

	*************************************
	Username: " . $email . "
	*************************************
			
	Please click the link below to activate the account:

	http://localhost/php/validate_user.php?email=" . $email . "&hash=" . $hash . "
			
	";

	$headers = 'From: Me <nikolai.vorkinn.10@ucl.ac.uk>';

	mail($email, $subject, $message, $headers);

?>
