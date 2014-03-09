<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/includes/php-includes.php'); 
require_once ($_SERVER['DOCUMENT_ROOT'].'/tools/protected/AzureStorageService.php');

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
		
	if($photo_type=="cover-photo"){
		$photo_id = mysqli_insert_id($mysqli);
		$user_select="SELECT profile_id FROM user WHERE id=".$_SESSION['user_id']." LIMIT 1";
		
		if ($result = $mysqli->query($user_select)){
			$row= $result->fetch_assoc();
			$profile_id=$row['profile_id'];
			
			$photo_update="UPDATE profile SET cover_photo_id=$photo_id WHERE profile.id=$profile_id";
			if (!$result = $mysqli->query($photo_update)){
				echo 'Could not update profile' . mysql_error();
				exit;
			}
		}else{
			echo 'Could not run query: ' . mysql_error();
			exit;
		}
		return;
	}
}
?>