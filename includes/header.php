
		<script>
		$( document ).ready(function() {
			var conn = connectToNotifServer();
			
			conn.onmessage = function(e) {
				console.log(e.data);
				if(e.data=="newFriendRequest"){
					var elem = document.getElementById('friend-request-count');
					if(elem){
						var notifCount = +($("#friend-request-count").text());
						$("#friend-request-count").html(notifCount+1);
					}else{
						$("#friend-request-notif").append('<span class="label label-success" id="friend-request-count">1</span>');
					}
				}else if(e.data=="friendRequestAccepted"){
					var elem = document.getElementById('general-notif-count');
					if(elem){
						var notifCount = +($("#general-notif-count").text());
						$("#general-notif-count").html(notifCount+1);
					}else{
						$("#general-notif").append('<span class="label label-success" id="general-notif-count">1</span>');
					}
				}
			};
			
			$(document.body).on( "click",".friend-notif-accept", function() {
				var friend_hash = $(this).attr('id');
				var activity_id = $(this).attr('data-activity-id');
				$.ajax({
                        type: "post",
                        data: {"action" : "acceptFriendRequest","friend_hash":friend_hash,"activity_id":activity_id},
                        url: "tools/protected/friend_utils.php",
                        success: function (response) {
							if(response==1){
								registerNotification(conn,friend_hash, "friendRequestAccepted");
							}
                        }
                    });

			});
	
			$("#general-notif-icon").click(function() {
                    $.ajax({
                        type: "post",
                        data: {"type" : "2"},
                        url: "tools/protected/notif_utils.php",
                        success: function (response) {
                            if(response!=-1){
								$("#general-notif-data").html(response);
								$("#general-notif-count").html('');
							}
                        }
                    });
			});
				
			$("#friend-request-icon").click(function() {
                    $.ajax({
                        type: "post",
                        data: {"type" : "0"},
                        url: "tools/protected/notif_utils.php",
                        success: function (response) {
                            if(response!=-1){
								$("#friend-notif-data").html(response);
								$("#friend-request-count").html('');
							}
                        }
                    });
			});
			
			
			$(".logo").click(function() {
                    $.ajax({
                        type: "post",
                        data: {"action" : "newFriendRequest", "to_user_id" : "2"},
                        url: "tools/protected/friend_utils.php",
                        success: function (response) {
                            if(response == 1){
								registerNotification(conn,"ebddd6b268d91849108444d7fc5c9941138e8ee0", "newFriendRequest");
							}
                        }
                    });
			});
			
		});
		</script>
<?PHP
	
	$friend_requests = 0;
	$messages = 0;
	$general_notifs = 0;
	
	$friend_request_str='';
				
	if ($result = $mysqli->query("SELECT * FROM notification,activity WHERE notification.activity_id=activity.id AND notification.target_id=".$_SESSION["user_id"]))
            {
				while($row = $result->fetch_assoc()){
					if($row['type']==0){
						if($row['seen']==0){
							$friend_requests++;
						}
					}else if($row['type']==1){
						if($row['seen']==0){
							$messages++;
						}
					}else if($row['type']==2){
						if($row['seen']==0){
							$general_notifs++;
						}
					}
				}
            }
?>

<!-- header logo: style can be found in header.less -->
        <header class="header">
        
            <a class="logo">Commy</a>
            
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
                        <li class="dropdown messages-menu" id="friend-request-icon">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="friend-request-notif">
                                <i class="fa fa-users"></i>
								<?PHP
									if($friend_requests>0){
										echo '<span class="label label-success" id="friend-request-count">'.$friend_requests.'</span>';
									}
								?>
                            </a>
							<ul class="dropdown-menu">
								<li class="header">
									<?PHP if($friend_requests>0){
											echo 'Friend Requests</li>';
										}else{
											echo 'No Friend Requests</li>';
										}
									?>
								<li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="friend-notif-data">
                                        
                                    </ul>
                                </li>
							</ul>
                        </li>
						
						<!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                                <i class="fa fa-envelope"></i>
								<?PHP
									if($messages>0){
										echo '<span class="label label-success">'.$messages.'</span>';
									}
								?>
							</a>
							
                        </li>
                        
						<!-- General notifications: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu" id="general-notif-icon">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="general-notif">
                                <i class="fa fa-globe"></i>
								<?PHP
									if($general_notifs>0){
										echo '<span class="label label-success" id="general-notif-count">'.$general_notifs.'</span>';
									}
								?>
                            </a>
							<ul class="dropdown-menu">
								<li class="header">
									<?PHP if($general_notifs>0){
											echo 'Notifications</li>';
										}else{
											echo 'No Notifications</li>';
										}
									?>
								<li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu" id="general-notif-data">
                                        
                                    </ul>
                                </li>
							</ul>
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