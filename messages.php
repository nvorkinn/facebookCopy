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
						
						<div id="friends_wrapper" style="width:35%;float:left">
							<!-- Friends -->
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title"><i class="fa fa-envelope"></i> Conversations</h3>
									<a class="btn btn-app" style="float:right;" id="new_message_btn">
                                        <i class="fa fa-plus"></i> New message
                                    </a>		
								</div>
                                <div class="box-body chat" id="chat-box" style="max-height:500px;overflow-x:hidden;">
                                    								</div><!-- /.chat -->
                                
                            </div><!-- /.box (chat box) -->
						</div>

						<div id="messages_wrapper" style="width:64%;float:right">
							<!-- Chat box -->
                            <div class="box box-success">
                                <div class="box-header">
                                    <h3 class="box-title" style="width:100%"><i class="fa fa-comments-o"></i><span id="chat-box-title"> </span></h3>
                                    
									<div class="input-group" id="message_recipients" style="margin-left:10px">
										<span class="input-group-addon"><i class="fa fa-group"></i></span>
										<input type="text" id="recipients_entry" class="form-control">
									</div>							
                                </div>
                                <div class="box-body chat" id="instant-chat-box" style="height:350px;overflow-x:hidden;">		
                                </div><!-- /.chat -->
                                <div class="box-footer">
                                    <div class="input-group">
                                        <input class="form-control" id="message_text" placeholder="Type message..."/>
                                        <div class="input-group-btn">
                                            <button class="btn btn-success" id="message_send_btn"><i class="fa fa-plus"> <span  style="font-family:arial">Send</span></i></button>
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
            
			   var current_conversation_friends;
			   var current_conversation=-1;
			   
			      
			  function message_handler(e){
					header_message(e);
					var message = $.parseJSON(e.data);
					if(message.name="imessage"){
						if(current_conversation!=-1){
							var chat_item = $.parseHTML(message.message);

							$(current_conversation).append(chat_item);
							$(current_conversation).animate({ scrollTop: $(current_conversation)[0].scrollHeight}, 0);

						}
					}
			   }
			   
			   
                $( document ).ready(function() {
					conn.onmessage=message_handler;
					getConversations();
					
					//get existing conversations		
					function getConversations(){
						$.ajax({
							type: "post",
							url: "tools/protected/convo_utils.php",
							data: {"action":"get_conversations"},
							success: function(data){
								
								if(data!=-1){
									if(data!=''){
										$("#chat-box").html(data);
									}else{
										$("#chat-box").html("<span style='text-align:center'><p>No conversations</p></span>");
									}
								}
							}
						});
					}
	
					
					//Register convo item click handler	
					$(document).on("click",".convo-item",function() {
						$("#message_recipients").hide();
						$("#chat-box-title").text(" "+$(this).find(".convo_header").text());	
						//get messages in the conversation
						var id=$(this).attr("id");
						current_conversation=$("#instant-chat-box");
						$.ajax({
							type: "post",
							url: "tools/protected/convo_utils.php",
							data: {"action":"get_convo_messages","convo_id":id},
							success: function(data){
								if(data!=-1){
									$("#instant-chat-box").html(data);
									$("#message_send_btn").attr("data-convo-id",id);
									
								}								
							}
						});

						$.ajax({
							type: "post",
							url: "tools/protected/convo_utils.php",
							data: {"action":"get_convo_members","convo_id":id},
							success: function(data){
								if(data!=-1){
									current_conversation_friends=$.parseJSON(data);
								}								
							}
						});						
					});
					
					var friends_list=[];
					var circles_list=[];
											
					$("#message_recipients").show();
					$("#chat-box-title").html(" New message");
						
					
					$("#new_message_btn").click(function() {
						
						$("#chat-box-title").html(" New message");
						$("#message_recipients").show();
						$("#instant-chat-box").html('');
						$("#message_send_btn").attr('data-convo-id',null);
						
					});
					
					     $('#message_send_btn').attr('disabled','disabled');
						 
						 $('#message_text').keyup(function() {
							if($(this).val() != '' && (friends_list.length!=0 || circles_list.length!=0)) {
							   $('#message_send_btn').removeAttr('disabled');
							}else if($("#message_send_btn").attr("data-convo-id")!=null && $(this).val() != ''){
								 $('#message_send_btn').removeAttr('disabled');
							}else{
								$('#message_send_btn').attr('disabled','disabled');
							}
						 });
					
					
					function post_message(){
					
						var message_text = $("#message_text").val();
						var current_convo_id = $("#message_send_btn").attr("data-convo-id");
						
					
						$("#message_text").val("");
						var friends_str = JSON.stringify(friends_list);
						var circles_str = JSON.stringify(circles_list);
			
						$( "#message_recipients" ).hide();
						
					
						$.ajax({
							type: "post",
							url: "tools/protected/message_utils.php",
							data: {"friends_to":friends_str,"circles_to":circles_str,"message_text":message_text,"convo-id":current_convo_id},
							success: function(data){
								if(data!=-1){
									var response = $.parseJSON(data);
									var nameSurname = '<?PHP echo $profile->name . " " . $profile->surname; ?>';
									var chat_msg='<div class="item"><img src="img/avatar2.png" alt="user image" class="online"/> <p class="message"><a href="#" class="name"> <small class="text-muted pull-right"><i class="fa fa-clock-o" style="margin-right:3px"></i><span data-livestamp="'+response.creation_date+'"></span></small>'+nameSurname+'</a>'+message_text+'</p></div>';
									var chat_item = $.parseHTML(chat_msg);
                                    
									$(chat_item).hide();
									$("#instant-chat-box").append(chat_item);
									$(chat_item).fadeIn("slow");
									
									var imessage = new Object();
									imessage.name = "imessage";
									imessage.message=chat_msg;
									imessage.conversation_id=response.convo_id;

									for (var i=0;i<current_conversation_friends.length;i++){
										registerNotification(conn,current_conversation_friends[i]["hash"], JSON.stringify(imessage));
									}
									
									if(current_convo_id==null){
										
										$("#message_send_btn").attr("data-convo-id",response.convo_id);
										getConversations();
										$("#message_recipients").hide();
									}
								}
							} 
						});
					}
					
					$("#message_send_btn").click(post_message);
					$('#message_text').bind("enterKey",post_message);
					
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
