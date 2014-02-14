<?PHP
	require($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$owner_id = $_SESSION["user_id"];
	//$circle_name = $_POST["circle_name"];
	error_log(var_dump($_POST));
	
	$query = "INSERT INTO circle (user_owner_id, name) VALUES ($owner_id, '$circle_name')";
	
	if (!$mysqli->query($query)) {
		echo "DB Error, could not create new circle in database\n";
		echo "MySQL Error: " . mysql_error();
		exit;	
	}
?>