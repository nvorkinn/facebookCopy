<?php
require_once ('Activity.php');

$action = $_POST['action']; 

switch ($action) {
	case "newActivity":
	$from_user_id = $_SESSION['user_id'];
	$to_user_id = $_POST['to_user_id'];
	$type = $_POST['type'];
	$activity = new Activity($from_user_id,$to_user_id,$type);
	$activity->save();
	$activity->notify();
	break;
}


?>
