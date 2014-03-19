<?PHP

    require_once("../../includes/php-includes.php");

    $friends_to=json_decode($_POST["friends_to"]);
    $circles_to=json_decode($_POST["circles_to"]);
    $message_text=$_POST["message_text"];
    $creation_date=date("Y-m-d H:i:s");


    /* disable autocommit */
    $mysqli->autocommit(FALSE);
	$from_user_id=$_SESSION["user_id"];

    $insert_message="INSERT INTO message(from_user_id,text,creation_date) VALUES($from_user_id,'$message_text','$creation_date')";

	
    if ($result= $mysqli->query($insert_message)) {
        $message_id = $mysqli->insert_id;
        foreach ($friends_to as $friend) {
            $friend_id=$friend->id;
            $insert_subscription = "INSERT INTO message_subscriptions(message_id,to_user_id) VALUES($message_id,$friend_id)";
            
            if (!$result= $mysqli->query($insert_subscription)) {
                $mysqli->rollback();
                echo -1;
                exit;
            }
        }
        /* commit insert */
        $mysqli->commit();
		 echo json_encode(array("creation_date"=>$creation_date));
    }else {
        $mysqli->rollback();
        echo -1;
    }

?>