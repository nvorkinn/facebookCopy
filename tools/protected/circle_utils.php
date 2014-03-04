<?PHP
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$owner_id = $_SESSION["user_id"];
	$action = $_POST["action"];
	
	if ($action == "create_circle") {
		
		$circle_name = $_POST["circle_name"];
	
		$query = "INSERT INTO circle (owner_user_id, name) VALUES ($owner_id, '$circle_name')";
	
		if ($mysqli->query($query)) {
			echo $mysqli->insert_id;
		}
	    else {
	        echo -1;
	    }
	}
	else if ($action == "delete_circle") {
		
		$circle_id = $_POST["circle_id"];
		
		$query = "DELETE FROM circle WHERE owner_user_id = $owner_id AND id = $circle_id";
		
		if ($mysqli->query($query)) {
			echo 1;	
		}
		else {
			echo -1;
		}
	}
	else if ($action == "add_to_circle") {
	
		$circle_id = $_POST["circle_id"];
		$member_hash = $_POST["member_to_add"];
	
		$member_id = $mysqli->query("SELECT id FROM user WHERE hash = '" . $member_hash . "' LIMIT 1")->fetch_object()->id;
		$query = "INSERT INTO user_circle (user_id, circle_id) VALUES (" . $member_id . ", " . $circle_id . ")";
    
		if ($mysqli->query($query)) {
			echo 1;	
		}
		else {
			echo -1;
		}
	}
	else if ($action == "delete_user_from_circle") {
		
		$circle_id = $_POST["circle_id"];
		$member_hash = $_POST["member_to_delete"];
	
	    $member_id = $mysqli->query("SELECT id FROM user WHERE hash = '" . $member_hash . "' LIMIT 1")->fetch_object()->id;
		$query = "DELETE FROM user_circle WHERE circle_id = '$circle_id' AND user_id = '$member_id'";
    
		if ($mysqli->query($query)) {
			echo 1;	
		}
		else {
			echo -1;
		}
	}

?>