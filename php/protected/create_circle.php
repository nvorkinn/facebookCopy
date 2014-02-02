<?PHP
	
	require ('../../includes/php-includes.php');
	
	$circle_name = strip_tags(stripslashes(mysql_real_escape_string($_POST['circle-name'])));
	$query = "INSERT INTO circle (name) VALUES ('$circle_name')";
	
	if (!$mysqli->query($query)) {
		
		echo "DB Error, could not create new circle in database\n";
    	echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
?>	