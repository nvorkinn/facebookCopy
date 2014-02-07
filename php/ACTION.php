<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/includes/php-includes.php');
require_once ('protected/Activity.php');
require_once ('protected/Circle.php');

$action = $_POST['action']; 

switch ($action) {
	case "newActivity":
		$from_user_id = $_SESSION['user_id'];
		$to_user_id = $_POST['to_user_id'];
		$type = $_POST['type'];
		$activity = new Activity($from_user_id,$to_user_id,$type);
		echo 1;
		break;
	case "newCircle":
		$circle_owner_id = $_SESSION['user_id'];
		$circle_name = $_POST['circle_name'];
		$circle = new Circle($circle_name, $circle_owner_id);
		echo 1;
		break;
}


?>
