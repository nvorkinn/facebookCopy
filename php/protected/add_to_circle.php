<?PHP
	
	require ('../../includes/php-includes.php');
	
	$user_id = $POST['user-id'];
	$circle_id = $_POST['circle-id'];
	$query = "INSERT INTO user_circle VALUES ($user_id, $circle_id)";
	
	if (!$mysqli->query($query)) {
		
		echo "DB Error, could not add user id $user_id to circle $circle_id in database\n";
    	echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
?>