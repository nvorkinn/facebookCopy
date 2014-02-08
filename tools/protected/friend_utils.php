<?PHP
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
require_once("Notification.php");
  
$action= $_POST["action"];

if($action=="newFriendRequest"){
	$from=$_SESSION["user_id"];
	$to=$_POST["to_user_id"];
	
	$if_friend_request = "SELECT from_user_id, to_user_id, type FROM activity WHERE from_user_id = '$from' AND to_user_id = '$to' AND type = '0'";
          
	if ($result = $mysqli->query($if_friend_request)){
                if ($result->num_rows == 0){
					$created_date = date("Y-m-d H:i:s");
                    $query = "INSERT INTO activity (from_user_id, to_user_id, type, created_date) VALUES ('$from', '$to', '0', '$created_date')";
                    $mysqli->query($query);
                    
                    $notif = new Notification($mysqli->insert_id, $from, $to);
                    $notif->save();
					echo 1;
                }
            }
}


?>