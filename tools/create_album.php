<?PHP

    require_once("../includes/php-includes.php");
	
	$user_id = $_SESSION["user_id"];
	$album_name = $_POST["album_name"];
	$check_exists = "SELECT * FROM album WHERE album.owner_user_id=$user_id AND album.name=$album_name";

	if ($result = $mysqli->query($user_select)){
                $if(!result->num_rows==0){
					echo -1;
				}
                
    }else{
                echo 'Could not run query: ' . mysql_error();
                exit;
    }	
   
?>
