<?PHP

    require_once("../includes/php-includes.php");
    
    $output = Array();
    
    if ($result = $mysqli->query("SELECT * FROM (SELECT LOWER(CONCAT(name, ' ', surname)) AS fullname, id, name, surname, profile_photo_id FROM profile) profile WHERE fullname LIKE (LOWER('%" . $_POST["term"] . "%')) LIMIT 20")){
        for ($i = 0; $i < $result->num_rows; $i++) {
            $profile = $result->fetch_object();
            if ($result2 = $mysqli->query("SELECT * FROM user WHERE profile_id = " . $profile->id . " LIMIT 1")){
                $user = $result2->fetch_object();
                
				$output[$user->id] = Array("name" => $profile->name . " " . $profile->surname);
				
				if ($result3 = $mysqli->query("SELECT * FROM photo WHERE user_id = $user->id AND photo.id=$profile->profile_photo_id LIMIT 1")){
					$photo = $result3->fetch_object();						
					$output["photo_url"]= $photo->photo_url;
				}	
				$result2->close();
            }
        }
        $result->close();
    }
    
    echo json_encode($output);
    
?>
