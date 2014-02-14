<?PHP
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$circle_name = $_POST["circle_name"];
	$owner_id = $_SESSION["user_id"];
	$member_id = $_POST["member_to_add"];
	
	$query = "INSERT INTO user_circle (user_id, circle_id) SELECT $member_id, id FROM circle WHERE name = '$circle_name'";
	
	if (!$mysqli->query($query)) {
		echo "DB Error, could not add member to circle\n";
		echo "MySQL Error: " . mysql_error();
		exit;	
	}
?>