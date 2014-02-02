<?PHP
	
	require ('../../includes/php-includes.php');
	
	$circle_id = $_POST['circle-id'];
	$query = "DELETE FROM circle WHERE id=$circle_id)";
	
	if (!$mysqli->query($query)) {
		
		echo "DB Error, could remove circle with id $circle_id in database\n";
    	echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
?>