<?php
class Notification
{
	var $activity_id;
	var $target_id;
	var $created_date;
	var $mysqli;
	
	function __construct($activity_id=NULL, $target_id=NULL) 
	{
	global $mysqli;
	$this->activity_id=$activity_id;
	$this->target_id=$target_id;
	$this->mysqli=$mysqli;
	}
	
	function save(){
	$this->created_date = date("Y-m-d H:i:s");
	
	$query="INSERT INTO notification (activity_id, target_id, seen, created_date)VALUES ('$this->activity_id', '$this->target_id',0, '$this->created_date')";
	
	if (!$result = $this->mysqli->query($query)){
		echo "DB Error, could not query the database\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	$this->id=$this->mysqli->insert_id;
	}
	
	function notify(){
	}
	
}
?>