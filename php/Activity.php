<?php
require ('../includes/php-includes.php');
require_once('Notification.php');
class Activity
{
	var $id;
	var $from_user_id;
	var $to_user_id;
	var $type;
	var $created_date;
	
	function __construct($from_user_id=NULL, $to_user_id=NULL,$type=NULL) 
	{
	$this->from_user_id=$from_user_id;
	$this->to_user_id=$to_user_id;
	$this->type=$type;
	}
	
	function save(){
		$this->created_date = date("Y-m-d H:i:s");
		global $mysqli;
		
		if($this->type==0){
			$this->makeFriendRequest($mysqli);
		}	
	}
	
	private function makeFriendRequest($mysqli){
		$if_friend_request ="SELECT from_user_id,to_user_id,type FROM activity WHERE from_user_id='$this->from_user_id' AND to_user_id='$this->to_user_id' AND type='$this->type'";
			
			if ($result = $mysqli->query($if_friend_request)){
				if ($result->num_rows == 0){
					$query="INSERT INTO activity (from_user_id, to_user_id, type, created_date)VALUES ('$this->from_user_id', '$this->to_user_id','$this->type','$this->created_date')";
					$mysqli->query($query);
					$this->id=$mysqli->insert_id;
				}
			}
	}
	
	function notify(){
		if(isset($this->id)){
		$notif = new Notification($this->id,$this->to_user_id);
		$notif->save();
		$notif->notify();
		}
	}
	
}
?>