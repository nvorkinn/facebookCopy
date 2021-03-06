<?PHP
    require_once("../../includes/php-includes.php");
    require_once("Notification.php");
      
    $action= $_POST["action"];
    $from=$_SESSION["user_id"];
    $created_date = date("Y-m-d H:i:s");
	
    if($action=="newFriendRequest"){
        $to=$_POST["to_user_id"];
        $if_friend_request = "SELECT from_user_id, to_user_id, main_type FROM activity WHERE from_user_id = '$from' AND to_user_id = '$to' AND main_type = '0' LIMIT 1";
              
        if ($result = $mysqli->query($if_friend_request)){
                    if ($result->num_rows == 0){
                        $query = "INSERT INTO activity (from_user_id, to_user_id, main_type, sub_type, object_id, created_date) VALUES ('$from', '$to', '0', '0', '-1', '$created_date')";
                        $mysqli->query($query);
                        echo $mysqli->error;
                        $notif = new Notification($mysqli->insert_id, $from, $to);
                        $notif->save();
                        if ($result = $mysqli->query("SELECT * FROM user WHERE id =$to LIMIT 1"))
						{
						$user = $result->fetch_object();
						echo json_encode(array("to_hash"=>$user->hash));
						}
                    }
                }
            		
    }else if($action=="acceptFriendRequest"){
        $friend_hash=$_POST["friend_hash"];
        $activity_id=$_POST["activity_id"];	
        
        $query_hash="SELECT id FROM user WHERE hash='$friend_hash' LIMIT 1";
        
        if ($result = $mysqli->query($query_hash)){
            if ($result->num_rows == 1){
                $to_entity_id = $result->fetch_assoc()['id'];
                $query="INSERT INTO relationship (activity_id, to_entity_id, privacy_setting_id, since) VALUES ('$activity_id', '$to_entity_id', 1, '$created_date')";
                if ($mysqli->query($query)){
                    $query_activity = "INSERT INTO activity (from_user_id, to_user_id, main_type, sub_type, object_id, created_date) VALUES ('$from', '$to_entity_id', '2','1', '-1', '$created_date')";
                    if($mysqli->query($query_activity)){
                        $notif = new Notification($mysqli->insert_id, $from, $to_entity_id);
                        $notif->save();
						$mark_seen = "UPDATE notification SET seen=1 WHERE activity_id=$activity_id AND target_id=".$_SESSION["user_id"];
						$mysqli->query($mark_seen);
						echo 1;	
                    }else{
                        echo -1;
                    }
                }else{
                    echo -1;
                }
            }else{
                    echo -1;
            }
        }else{
            echo -1;
        }
    }
?>