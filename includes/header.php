<?PHP
	
	$friend_requests = array();
	$messages = array();
	$general_notifs = array();
				
	if ($result = $mysqli->query("SELECT * FROM notification,activity WHERE notification.seen=0 AND notification.activity_id=activity.id AND notification.target_id=" . $_SESSION["user_id"]))
            {
				while($row = $result->fetch_assoc()){
					if($row['type']==0){
						array_push($friend_requests, $row);
					}else if($row['type']==1){
						array_push($messages, $row);
					}else if($row['type']==2){
						array_push($general_notifs, $row);
					}
				}
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
        