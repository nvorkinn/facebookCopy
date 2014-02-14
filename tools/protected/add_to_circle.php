<?PHP
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$circle_id = $_POST["circle_id"];
	$owner_id = $_SESSION["user_id"];
	$member_hash = $_POST["member_to_add"];
	
    $member_id = $mysqli->query("SELECT id FROM user WHERE hash = '" . $member_hash . "' LIMIT 1")->fetch_object()->id;
    
	$query = "INSERT INTO user_circle (user_id, circle_id) VALUES (" . $member_id . ", " . $circle_id . ")";
    
	if (!$mysqli->query($query)) {
		echo "DB Error, could not add member to circle\n";
		echo "MySQL Error: " . mysql_error();
		exit;	
	}
?>