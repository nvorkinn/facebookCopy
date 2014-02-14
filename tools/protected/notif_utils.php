<?PHP
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");

$type=$_POST["type"];

$query = "SELECT * FROM activity,profile,user,notification WHERE notification.activity_id=activity.id AND activity.type='$type' AND notification.target_id=".$_SESSION["user_id"]." AND profile.id=(SELECT profile_id FROM user WHERE user.id=activity.from_user_id LIMIT 1) AND user.id=activity.from_user_id LIMIT 1";

if ($result = $mysqli->query($query)){
		$str='';
		while($row = $result->fetch_assoc()){
			$str = generateNotifItems($row,$str,$type);
			$mark_seen = "UPDATE notification SET seen=1 WHERE activity_id=".$row["activity_id"]." AND target_id=".$_SESSION["user_id"];
			$mysqli->query($mark_seen);
		}
	echo $str;	
}else{
	echo -1;
}
    

	function generateNotifItems($row,$str,$type){
		
		$item_str='';
	
		if($type==0){
		$item_str = '<li>
                                            <a>
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
													<div style="width:60px;float:right" class="friend-notif-respond" id="'.$row["hash"].'" data-activity-id="'.$row["activity_id"].'">
														<button class="btn btn-default btn-block btn-sm">Respond	</button>
													</div>'.
                                                    $row["name"].' '.$row["surname"].'
													<div class="pull-left">
														<small><i class="fa fa-clock-o"></i><span data-livestamp="'.$row["created_date"].'" style="padding-left:3px"></span></small>
													</div>
													
												</h4>
                                            </a>
                                        </li>';
		}
		if($type==2){
		$message='';
		if($row["sub_type"]==1){
		$message = '<p>Accepted your friend request!</p>';
		}
		$item_str = '<li>
                                            <a>
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4><div class="pull-right">
														<small><i class="fa fa-clock-o"></i><span data-livestamp="'.$row["created_date"].'" style="padding-left:3px"></span></small>
													</div>'.
                                                    $row["name"].' '.$row["surname"].'
												</h4>'.$message.'
                                            </a>
                                        </li>';
										
		
		}
		return $str.$item_str;
	}
?>