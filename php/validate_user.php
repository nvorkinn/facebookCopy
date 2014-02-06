<?PHP
	
	require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/php-includes.php');

	// Ensure both email and hash are present in URL
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	
		// Get data off URL
		$email = mysqli_escape_string($mysqli, $_GET['email']);
		$hash = mysqli_escape_string($mysqli, $_GET['hash']);
	
		// Search for un-verified entry
		$search = mysqli_query($mysqli, "SELECT email, hash, verified FROM user u, profile p
					WHERE email='".$email."'AND hash='".$hash."' AND verified=0
					AND p.id = u.profile_id") or die(mysql_error($mysqli));
		$match = mysqli_num_rows($search);
	
		// If there was a match, set it to active
		if ($match > 0) {
		
			mysqli_query($mysqli, "UPDATE user u, profile p SET verified=1
			WHERE email='".$email."' AND hash='".$hash."'AND verified=0
			AND p.id = u.profile_id") or die(mysqli_error($mysqli));
		}
		else {
		
			echo 'There were no results in the database with that email and hash,
					or it has already been verified.';
		}
	}
	else {
	
		echo "Either email or hash isn't set properly in URL";
	}
