<?PHP
	
	require ('../../includes/php-includes.php');
	
	$user_id = $POST['user-id'];
	$circle_id = $_POST['circle-id'];
	$query = "DELETE FROM user_circle WHERE user_id=$user_id AND circle_id=$circle_id)";
	
	if (!$mysqli->query($query)) {
		
		echo "DB Error, could remove user id $user_id from circle $circle_id in database\n";
    	echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
?>