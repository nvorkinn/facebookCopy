<?PHP 
	include_once($_SERVER['DOCUMENT_ROOT']."/includes/php-includes.php");
    
	function post_helper($privacy,$post_type,$photo_id,$photo_caption){
	
		 global $mysqli;
		 
    $privacySettingsId = 1;
	
    
    if ($privacy == "Friends")
    {
        $privacySettingsId = 2;
    }
    else
    if ($privacy == "Friends of friends")
    {
        $privacySettingsId = 3; 
    }
    else
    {
        // Make sure $privacy is a valid circle id
        $result = $mysqli->query("SELECT * FROM circle WHERE id = $privacy LIMIT 1");
        if ($result)
        {
            // Find the circle's privacy setting or create one if there isn't one already
            $result = $mysqli->query("SELECT * FROM privacy_setting WHERE circle_id = $privacy LIMIT 1");
            if ($result->num_rows != 0)
            {
                $privacySettingsId = $result->fetch_object()->id;
            }
            else
            {
                $mysqli->query("INSERT INTO privacy_setting (circle_id, name) VALUES ($privacy, (SELECT name FROM circle WHERE id = $privacy LIMIT 1))");
                $privacySettingsId = $mysqli->insert_id;
            }
        }
    }
    
	if($post_type=="STATUS"){
		$content = strip_tags(stripslashes($_POST["content"]));
		$user_id = $_SESSION["user_id"];
		$query = "INSERT INTO post (user_id, main_type, privacy_setting_id, location, content, deleted) VALUES ($user_id, 0, $privacySettingsId, 'London, United Kingdom', '$content', 0)";
    if (!$result =$mysqli->query($query)){
		echo -1;
		exit;
	}
    
    echo $mysqli->insert_id;
    
    $query = "INSERT INTO activity (from_user_id, main_type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 3, 0, $mysqli->insert_id)";
    $mysqli->query($query);
   
		
	}else if($post_type=="PHOTO" && isset($photo_id)){
		$content = strip_tags(stripslashes($photo_caption));
		$user_id = $_SESSION["user_id"];
		$query = "INSERT INTO post (user_id, main_type, privacy_setting_id, location,content,photo_id, deleted) VALUES ($user_id, 1, 1, 'London, United Kingdom','$content',$photo_id, 0)";
			
			 if (!$result = $mysqli->query($query)){
                    echo 'Could not post photo' . mysql_error();
                    exit;
                }
				
				 
    echo $mysqli->insert_id;
    
    $query = "INSERT INTO activity (from_user_id, main_type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 3, 1, $mysqli->insert_id)";
    $mysqli->query($query);
   
	}
	
	}
?>