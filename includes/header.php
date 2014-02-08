<?PHP
	
	$friend_requests = array();
	$messages = array();
	$general_notifs = array();
	
	$friend_request_str='';
				
	if ($result = $mysqli->query("SELECT * FROM notification,activity,profile WHERE notification.activity_id=activity.id AND notification.target_id=".$_SESSION["user_id"]." AND profile.id=(SELECT profile_id FROM user WHERE user.id=activity.from_user_id LIMIT 1)"))
            {
				while($row = $result->fetch_assoc()){
					if($row['type']==0){
						if($row['seen']==0){
						array_push($friend_requests, $row);
						}
						$friend_request_str = generateNotifItems($row,$friend_request_str,0);
					}else if($row['type']==1){
						array_push($messages, $row);
					}else if($row['type']==2){
						array_push($general_notifs, $row);
					}
				}
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

<!-- header logo: style can be found in header.less -->
        <header class="header">
        
            <a href="index.php" class="logo">Commy</a>
            
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
            
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                
                <div class="navbar-right">
                
                    <ul class="nav navbar-nav">
                    
                        <!-- Friend Request: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-users"></i>
								<?PHP
									$friend_notif_count = count($friend_requests);
									if($friend_notif_count>0){
										echo '<span class="label label-success">'.$friend_notif_count.'</span>';
									}
								?>
                            </a>
							<ul class="dropdown-menu">
								<li class="header">
									<?PHP if($friend_notif_count>0){
											echo 'Friend Requests</li>';
										}else{
											echo 'No Friend Requests</li>';
										}
									?>
								<li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?PHP
											echo $friend_request_str;
										?>
                                    </ul>
                                </li>
							</ul>
                        </li>
                        
						<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
								<?PHP
									$messages_notif_count = count($messages);
									if($messages_notif_count>0){
										echo '<span class="label label-success">'.$messages_notif_count.'</span>';
									}
								?>
							</a>
                        </li>
                        
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-globe"></i>
								<?PHP
									$general_notifs_count = count($general_notifs);
									if($general_notifs_count>0){
									echo '<span class="label label-success">'.$general_notifs_count.'</span>';
									}
								?>
							</a>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-cog"></i>
                                <span><?PHP
                            
                                    if (isset($profile)) {
                                        echo $profile->name . " " . $profile->surname;
                                    }
                            
                                ?><i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?PHP
                            
                                            if (isset($profile)) {
                                                echo $profile->name . " " . $profile->surname;
                                            }
                            
                                        ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right" onclick="signOut();">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        
                    </ul>
                    
                </div>
                
            </nav>
            
        </header>