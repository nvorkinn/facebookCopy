<?php
    require_once("../../includes/php-includes.php");
    require_once ("AzureStorageService.php");

    $photo_type= $_POST["photo-type"];
    $files = $_POST["files"];

    $azure_ss = new AzureStorageService();

    foreach ($files as $f) {
            //Upload to azure
            $blob = $azure_ss->upload_blob($_SESSION["user_hash"],$f['name'],$f['url']);	
            
            //Record image upload in the database
            $blob_url=$azure_storage_url.$_SESSION["user_hash"].'/'.$f['name'];
            $photo_insert="INSERT INTO photo (user_id,photo_url,privacy_setting_id) VALUES (".$_SESSION['user_id'].", '$blob_url',1)";
            
            if (!$result=$mysqli->query($photo_insert)) {
                echo "Could not insert entry into the photo table";
                die("Error: " . mysqli_error($mysqli));
            }
            
		$photo_id = mysqli_insert_id($mysqli);
        $user_select="SELECT profile_id FROM user WHERE id=".$_SESSION['user_id']." LIMIT 1";
		$profile_id=0;
        if ($result = $mysqli->query($user_select)){
                $row= $result->fetch_assoc();
                $profile_id=$row['profile_id'];
        }else{
                echo 'Could not run query: ' . mysql_error();
                exit;
        }
				
        if($photo_type=="cover-photo"){
                $photo_update="UPDATE profile SET cover_photo_id=$photo_id WHERE profile.id=$profile_id";
                if (!$result = $mysqli->query($photo_update)){
                    echo 'Could not update profile' . mysql_error();
                    exit;
                }
        }else if($photo_type=="profile-photo"){
				$photo_update="UPDATE profile SET profile_photo_id=$photo_id WHERE profile.id=$profile_id";
                if (!$result = $mysqli->query($photo_update)){
                    echo 'Could not update profile' . mysql_error();
                    exit;
                }
		}else if($photo_type=="share-photo"){
			$user_id = $_SESSION['user_id'];
			$query = "INSERT INTO post (user_id, main_type, privacy_setting_id, location, content,photo_id, deleted) VALUES ($user_id, 1, 1, 'London, United Kingdom', '',$photo_id, 0)";
			
			 if (!$result = $mysqli->query($query)){
                    echo 'Could not post photo' . mysql_error();
                    exit;
                }
		}	
    }
?>