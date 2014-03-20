	<!DOCTYPE HTML>
<html>


    <head>
	
         <?PHP 
        
            require_once("includes/php-includes.php"); 
            
            if(!isset($_SESSION["user_id"])){
                header("location: index.php");
            }
            
            require_once("includes/html-includes.php");
            
			$user_id=$_SESSION["user_id"];
			
            if ($result = $mysqli->query("SELECT * FROM profile WHERE id = (SELECT profile_id FROM user WHERE id =$user_id) LIMIT 1"))
            {
                $profile = $result->fetch_object();
            }
			
			//Get all messages
							
								$conversations_query = "SELECT * FROM `message_subscriptions`,`message` WHERE (to_user_id=$user_id OR from_user_id=$user_id) AND message_id=message.id GROUP BY message.id";
								
								if ($result = $mysqli->query($conversations_query)) {
									while ($row = $result->fetch_assoc()) {
										
									}
								}
							
								$message_query = "SELECT DISTINCT hash,user.id, name, surname 
									FROM user, profile,message_subscriptions
								WHERE user.profile_id = profile.id
								AND user.id
								IN (
									SELECT * FROM message WHERE message_subscriptions.to_user_id = $user_id
									
									WHERE message.from_user_id = message.from_user_id AND message_subscriptions.message_id=message.id
								)";
								$message_count=0;
								$message_string;
							
								if ($result = $mysqli->query($message_query)) {
									while ($row = $result->fetch_assoc()) {
										$message_count=$message_count+1;
										$from_name=$row=['name'];
										$from_surname=$row['surname'];
										$message_string=$message_string.'<div class="item">
                                        <img src="img/avatar2.png" alt="user image" class="offline"/>
                                        <p class="message">
                                            <a href="#" class="name">
                                                <small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
												'.$from_name.' '.$from_surname.'
                                            </a>'.
											$message_text.'
                                        </p>
                                    </div>';
										echo $row["name"];
									}
								}
        ?>
 	<script type="text/javascript" src="js/jquery.tokeninput.js"></script>
	<link rel="stylesheet" href="css/token-input-facebook.css" type="text/css" />
	<link rel="stylesheet" href="css/token-input.css" type="text/css" />
    </head>


    <body class="skin-blue">
		 
        <?PHP
			require("includes/header.php"); 
        ?>    
		
        <div class="wrapper row-offcanvas row-offcanvas-left">
        

            <?PHP include_once('includes/sidebar.php'); ?>
			
			
            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">

                <!-- Main content -->
                <section class="content">

						
						<div id="friends_wrapper" style="width:30%;float:left">
							<!-- Friends -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-envelope"></i> Conversations</h3>
									<a class="btn btn-app" style="float:right;" id="new_message_btn">
                                        <i class="fa fa-plus"></i> New message
                                    </a>		
								</div>
                                <div class="box-body chat" id="chat-box" style="max-height:500px;overflow-x:hidden;">
                                    <?PHP if($message_count==0){
										echo '<span style="text-align:center"><p>You have no messages</p></span>';
									}else{
										echo $message_string;
									}
									?>
								</div><!-- /.chat -->
                                
                            </div><!-- /.box (chat box) -->
						</div>

						<div id="messages_wrapper" style="width:69%;float:right">
							<!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title" style="width:100%"><i class="fa fa-comments-o"></i><span id="chat-box-title"> </span></h3>
                                    
									<div class="input-group" id="message_recipients" style="margin-left:10px">
										<span class="input-group-addon"><i class="fa fa-group"></i></span>
										<input type="text" id="recipients_entry" class="form-control">
									</div>							
                                </div>
                                <div class="box-body chat" id="instance-chat-box" style="height:350px;overflow-x:hidden;">		
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" id="message_text" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="message_send_btn"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.box (chat box) -->
						</div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
</div>


		
	<script>
                        
                $( document ).ready(function() {
					var friends_list=[];
					var circles_list=[];
											
					$("#message_recipients").hide();
					
					$("#new_message_btn").click(function() {
						
						$("#chat-box-title").html(" New message");
						$("#message_recipients").show();
					});
					
					     $('#message_send_btn').attr('disabled','disabled');
						 $('#message_text').keyup(function() {
							if($(this).val() != '' && (friends_list.length!=0 || circles_list.length!=0)) {
							   $('#message_send_btn').removeAttr('disabled');
							}else{
								$('#message_send_btn').attr('disabled','disabled');
							}
						 });
					
					
					$("#message_send_btn").click(function() {
					
						var message_text = $("#message_text").val();
						$("#message_text").val("");
						var friends_str = JSON.stringify(friends_list);
						var circles_str = JSON.stringify(circles_list);
						$( "#message_recipients" ).fadeTo( "slow" , 0.7,function(){
								$('#message_recipients :input').attr('disabled','disabled');
								$('#message_recipients :input').css({'opacity':'0'});
						});
						
						
	
						$.ajax({
							type: "post",
							url: "tools/protected/message_utils.php",
							data: {"friends_to":friends_str,"circles_to":circles_str,"message_text":message_text},
							success: function(data){
								if(data!=-1){
									var response = $.parseJSON(data);
									var nameSurname = '<?PHP echo $profile->name . " " . $profile->surname; ?>';
									var chat_item = $.parseHTML('<div class="item"><img src="img/avatar2.png" alt="user image" class="online"/> <p class="message"><a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o" style="margin-right:3px"></i><span data-livestamp="'+response.creation_date+'"></span></small>'+nameSurname+'</a>'+message_text+'</p></div>');
                                    
									$(chat_item).hide();
									$("#instance-chat-box").append(chat_item);
									$(chat_item).fadeIn("slow");
									
								}
							} 
						});							
					});
                    $(function () {
								
							 //Get all the friends if they exist
							 $.ajax({
										type: "post",
										url: "tools/protected/circle_utils.php",
										data: {"action":"get_all_friends_from_all_circles"},
										success: function (response) {
											
											if(response==-1) {
												return;
											}
											
											var friends = $.parseJSON(response);
											for(var i=0; i<friends.length; i++){	
												friends[i]["first_name"]=friends[i]["name"];
												friends[i]["name"]=friends[i]["name"]+" "+friends[i]["surname"];
												friends[i]["category"]="friends";
											}	
												
											//Get all circles if they exist
												$.ajax({
													type: "post",
													url: "tools/protected/circle_utils.php",
													data: {"action":"get_all_circles"},
													success: function(data){
														if(data==-1){
															data_show(friends);
															return;
														}
														var circles = $.parseJSON(data);
														for(var i=0; i<circles.length; i++){
															circles[i]["name"]="Circle: "+circles[i]["name"];														
															circles[i]["category"]="circles";
														}
														var result = friends.concat(circles);	
														data_show(result);
													} 
												});
																								
											
											function data_show (data) {		
												
												$("#recipients_entry").tokenInput(data, {
													searchDelay: 0,
													theme: "facebook",
													hintText: "send a private message , group message or message to an entire circle",
													noResultsText: "No matches",
													searchingText: "Searching...",
													preventDuplicates: true,
													animateDropdown: false,
													onAdd: function (item) {
														if(item.category=="friends"){
															friends_list.push(item);
														}else if(item.category=="circles"){
															circles_list.push(item);
														}
														$('#message_send_btn').removeAttr('disabled');
													},
													onDelete: function (item) {
														if(item.category=="friends"){
															var index= friends_list.indexOf(item);															 
															if (index != -1) {
																friends_list.splice(index, 1);		
															}
														}
														else if(item.category=="circles"){
															var index= circles_list.indexOf(item);															 
															if (index != -1) {
																circles_list.splice(index, 1);		
															}
														}
														if(friends_list.length==0 && circles_list.length==0){
															$('#message_send_btn').attr('disabled','disabled');
														}else{
															$('#message_send_btn').removeAttr('disabled');
														}
													}
												});
											}
										}
								});
							});
                    });
            </script>
	
    </body>


</html>
