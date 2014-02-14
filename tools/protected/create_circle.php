<?PHP
	require($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$owner_id = $_SESSION["user_id"];
	$circle_name = $_POST["circle_name"];
	
	$query = "INSERT INTO circle (owner_user_id, name) VALUES ($owner_id, '$circle_name')";
	
	if (!$mysqli->query($query)) {
		echo -1;	
	}
?>