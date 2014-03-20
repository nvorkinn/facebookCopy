<?PHP

    require_once("../../includes/php-includes.php");

    /* disable autocommit */
    $mysqli->autocommit(FALSE);
	$from_user_id=$_SESSION["user_id"];
    $message_text=$_POST["message_text"];
	$convo_id=isset($_POST["convo-id"])?$_POST["convo-id"]:null;
    $creation_date=date("Y-m-d H:i:s");

	//Create a new message
    $insert_message="INSERT INTO message(from_user_id,text,creation_date) VALUES($from_user_id,'$message_text','$creation_date')";
	
	//Add message to the conversation if it exists
	if(isset($convo_id)){
		if ($result= $mysqli->query($insert_message)) {
			$message_id = $mysqli->insert_id;
			
			//Register message with conversation
			$register_message="INSERT INTO conversation_message(conversation_id,message_id) VALUES($convo_id,$message_id)";
			if (!$result= $mysqli->query($register_message)) {
				$mysqli->rollback();
				echo -1;
				exit;
			}
			$mysqli->commit();
			echo json_encode(array("creation_date"=>$creation_date));
			exit;
		}else{
			$mysqli->rollback();
            echo -1;
            exit;
		}	
	}
	
    $friends_to=json_decode($_POST["friends_to"]);
    $circles_to=json_decode($_POST["circles_to"]);

	
    if ($result= $mysqli->query($insert_message)) {
        $message_id = $mysqli->insert_id;
	
		//Create a new conversation
		$insert_conversation = "INSERT INTO conversation (creation_date) VALUES ('$creation_date')";
		if (!$result= $mysqli->query($insert_conversation)) {
			$mysqli->rollback();
            echo -1;
            exit;
		}
		
		 $convo_id = $mysqli->insert_id;
	
		
		//Register the message with the new conversation
		$insert_conversation = "INSERT INTO conversation_message (conversation_id,message_id) VALUES ($convo_id,$message_id)";
		if (!$result= $mysqli->query($insert_conversation)) {
			$mysqli->rollback();
            echo -1;
            exit;
		}
		
		//Register the conversation with the combination of users: current_user+friends_to+circles_to
	
        foreach ($friends_to as $friend) {
            $friend_id=$friend->id;
            $insert_user_convo = "INSERT INTO user_conversation(conversation_id,user_id) VALUES($convo_id,$friend_id)";
            
            if (!$result= $mysqli->query($insert_user_convo)) {
                $mysqli->rollback();
                echo -1;
                exit;
            }
        }
		
		//insert current_user in the conversation aswell
		$insert_user_convo = "INSERT INTO user_conversation(conversation_id,user_id) VALUES($convo_id,$from_user_id)";
            
            if (!$result= $mysqli->query($insert_user_convo)) {
                $mysqli->rollback();
                echo -1;
                exit;
            }
			
		//Insert circle combination in conversation 
		foreach ($circles_to as $circle) {
            $circle_id=$circle->id;
            $insert_circle_convo = "INSERT INTO circle_conversation(conversation_id,circle_id) VALUES($convo_id,$circle_id)";
            
            if (!$result= $mysqli->query($insert_circle_convo)) {
                $mysqli->rollback();
                echo -1;
                exit;
            }
        }
		
        /* commit insert */
        $mysqli->commit();
		 echo json_encode(array("creation_date"=>$creation_date,"convo_id"=>$convo_id));
    }else {
        $mysqli->rollback();
        echo -1;
    }

?>