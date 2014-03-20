<?PHP
    require_once("../../includes/php-includes.php");

    $main_type=$_POST["main_type"];

    $query = "SELECT * FROM activity,profile,user,notification WHERE notification.activity_id=activity.id AND seen=0 AND activity.main_type='$main_type' AND notification.target_id=".$_SESSION["user_id"]." AND profile.id=(SELECT profile_id FROM user WHERE user.id=activity.from_user_id LIMIT 1) AND user.id=activity.from_user_id";
    
    if ($result = $mysqli->query($query)){
            $str='';
            while($row = $result->fetch_assoc()){
                
                $str = generateNotifItems($row,$str,$main_type);	
				
				if($main_type!=0){
				$mark_seen = "UPDATE notification SET seen=1 WHERE activity_id=".$row["activity_id"]." AND target_id=".$_SESSION["user_id"];
                $mysqli->query($mark_seen);
				}
            }
        echo $str;	
    }else{
        echo -1;
    }
        

        function generateNotifItems($row,$str,$main_type){
            
            $item_str='';
        
            if($main_type==0){
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
            if($main_type==2){
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