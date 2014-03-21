<?PHP

    require_once("../../includes/php-includes.php");

	$user_id=$_SESSION["user_id"];
	$action=$_POST["action"];

	function append_message_string($message_string,$conversation_id,$recepients,$photo_url){
		$message_string=$message_string.'<div style="border-top: 1px solid rgba(0, 0, 0, 0.1);border-bottom: 1px solid rgba(255, 255, 255, 0.3);width:110%"><div><div class="convo-item" style="padding-bottom:5px" id="'.$conversation_id.'"><div class="item">
													<img src="'.$photo_url.'" alt="user image" class="offline" style="margin-top:6px;"/>
														<p class="message">
														<a href="#" class="name">
															<span class="convo_header">'.$recepients.'</span>
														</a>
													</p>
													</div></div>';
		return $message_string;
	}
	
	if($action=="get_conversations"){
	
								$message_string='';
								//Get All the conversations that the current user is part of 		
								$convo_query = "SELECT user_conversation.conversation_id,user_conversation.user_id,conversation.creation_date FROM conversation,user_conversation WHERE user_conversation.user_id=$user_id AND user_conversation.conversation_id=conversation.id";
								if ($result = $mysqli->query($convo_query)) {
									while ($row = $result->fetch_assoc()) {
										
										$first=0;
										$recepients='';
										$photo_url="img/avatar3.png";
										
										//Get all the users that are part of the conversation
										$user_convo_query = "SELECT user_id,name,surname,profile_photo_id FROM user_conversation,profile,user WHERE conversation_id=".$row["conversation_id"]." AND user_id<>$user_id AND user.id=user_id AND user.profile_id=profile.id";
										
										
										if ($result_convo_user = $mysqli->query($user_convo_query)) {
											while ($row_convo_user = $result_convo_user->fetch_assoc()) {
												
												if($result_convo_user->num_rows==1 && isset($row_convo_user['profile_photo_id'])){
													$photo_query = "SELECT photo_url FROM photo WHERE photo.id=".$row_convo_user['profile_photo_id'];
														if ($result_photo_query = $mysqli->query($photo_query)) {
															$row_photo= $result_photo_query->fetch_assoc();
															$photo_url=	$row_photo["photo_url"];
														}
												}
												
												$from_name=$row_convo_user['name'];
												$from_surname=$row_convo_user['surname'];
												if($first==0){
													$recepients=$recepients.$from_name.' '.$from_surname;
													$first=1;
												}else{
													$recepients=$recepients.','.$from_name.' '.$from_surname;
												}
												
											}
											if($recepients!=''){
												$message_string =append_message_string($message_string,$row["conversation_id"],$recepients,$photo_url);
											}
										}else{
											echo -1;
											exit;
										}
									
										
									}
								}else{
									echo -1;
								}
									
										//Get all the circle conversations that the user either owns or is part of
										$circle_convo_query = "SELECT DISTINCT circle_conversation.circle_id,circle.owner_user_id,circle.name,circle_conversation.conversation_id FROM circle_conversation,circle,user_circle WHERE circle.id=circle_conversation.circle_id AND user_circle.circle_id=circle_conversation.circle_id AND( circle.owner_user_id=$user_id OR user_circle.user_id=$user_id)";
										
						
										if ($result_convo_circle= $mysqli->query($circle_convo_query)) {
											while ($row_convo_circle = $result_convo_circle->fetch_assoc()) {

												$first=0;
												$recepients='';
												$photo_url="img/avatar3.png";
												
												//Check if the current user owns this circle
												if($row_convo_circle['owner_user_id']==$user_id){
													$circle_name=$row_convo_circle['name'];
													if($first==0){
														$recepients=$recepients.$circle_name;
														$first=1;
													}else{
														$recepients=$recepients.', '.$circle_name;
													}
												}else{
													$circle_id=$row_convo_circle["circle_id"];
													
													$member_query = "SELECT DISTINCT user.id AS user_id,hash, profile.name, surname FROM user, profile, user_circle,circle WHERE user_circle.circle_id =$circle_id AND circle.id =user_circle.circle_id AND (user.id = user_circle.user_id OR user.id=circle.owner_user_id) AND user.profile_id = profile.id";
													
													if ($member_result = $mysqli->query($member_query)) {
														while ($row_members = $member_result->fetch_assoc()) {
																if($row_members["user_id"]!=$user_id){
																	if($first==0){
																		$recepients=$recepients.$row_members["name"].' '.$row_members["surname"];
																		$first=1;
																	}else{
																		$recepients=$recepients.', '.$row_members["name"].' '.$row_members["surname"];
																	}																
																}
														}
													}
												}
												
												$message_string =append_message_string($message_string,$row_convo_circle["conversation_id"],$recepients,$photo_url);

											}
											echo $message_string;
										}else{
											echo -1;
											exit;
										}
	}else if($action=="get_convo_members"){
		$convo_id= $_POST["convo_id"];
		if(!isset($convo_id)){
			echo -1;
			exit;
		}
		
		$get_all_convo_friends = "SELECT DISTINCT user_id,hash FROM user_conversation,user WHERE user_conversation.conversation_id=$convo_id AND user_id<>$user_id AND user_id=user.id";
		
		$users =array();
		if ($result_message= $mysqli->query($get_all_convo_friends)) {
			while ($row_convo_message = $result_message->fetch_assoc()) {
				array_push($users,$row_convo_message);
			}
			echo json_encode($users);
		}else{
			echo -1;
			exit;
		}
		
	}else if($action=="get_convo_messages"){
		$convo_id= $_POST["convo_id"];
		if(!isset($convo_id)){
			echo -1;
			exit;
		}
		
		$convo_message_query = "SELECT from_user_id,text,message.creation_date,photo_id,name,surname,profile_photo_id FROM message,conversation_message,profile,user WHERE conversation_message.conversation_id=$convo_id AND conversation_message.message_id=message.id AND user.id=from_user_id AND profile.id=user.profile_id ORDER BY message.creation_date";
		
		if ($result_message= $mysqli->query($convo_message_query)) {
			$convo_messages='';
			$usr_photo='img/avatar2.png';
			while ($row_convo_message = $result_message->fetch_assoc()) {
				if(isset($row_convo_message['profile_photo_id'])){
					$photo_query = "SELECT photo_url FROM photo WHERE photo.id=".$row_convo_message['profile_photo_id'];
					if ($result_photo_query = $mysqli->query($photo_query)) {
						$row_photo= $result_photo_query->fetch_assoc();
						$usr_photo=	$row_photo["photo_url"];
					}
				}
			
				$convo_messages=$convo_messages.'<div class="item">
													<img src="'.$usr_photo.'" alt="user image" class="offline"/>
														<p class="message">
														<a href="#" class="name">
															<small class="text-muted pull-right"><i class="fa fa-clock-o"><span data-livestamp="'.$row_convo_message["creation_date"].'" style="padding-left:3px;font-family:arial"></span></i></small>
															<span class="convo_header">'.$row_convo_message["name"].' '.$row_convo_message["surname"].'</span>
														</a>'.$row_convo_message["text"].'
													</p>
													</div>';
			
			}
			echo $convo_messages;			
		}else{
			echo -1;
			exit;
		}
	}
?>