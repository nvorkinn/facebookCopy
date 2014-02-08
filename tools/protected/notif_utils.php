<?PHP
require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");

$type=$_POST["type"];

$query = "SELECT * FROM notification,activity,profile WHERE notification.activity_id=activity.id AND activity.type='$type' AND notification.target_id=".$_SESSION["user_id"]." AND profile.id=(SELECT profile_id FROM user WHERE user.id=activity.from_user_id LIMIT 1)";

if ($result = $mysqli->query($query)){
		$str='';
		while($row = $result->fetch_assoc()){
			$str = generateNotifItems($row,$str,$type);
		}
	echo $str;	
}else{
	echo -1;
}
    

	function generateNotifItems($row,$str,$type){
		
	
	
		$item_str = '<li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
													<div style="width:60px;float:right">
														<button class="btn btn-default btn-block btn-sm">Accept</button>
													</div>'.
                                                    $row["name"].' '.$row["surname"].'
													<div class="pull-left">
														<small><i class="fa fa-clock-o"></i><span data-livestamp='.$row["created_date"].' style="padding-left:3px"></span></small>
													</div>
													
												</h4>
                                            </a>
                                        </li>';
		
		return $str.$item_str;
	}
?>