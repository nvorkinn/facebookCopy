<?PHP
	require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
	
	$query = "SELECT id, name FROM circle WHERE owner_user_id=".$_SESSION["user_id"];
	
	if ($result = $mysqli->query($query)) {
		$str='';
		while($row = $result->fetch_assoc()) {
			
			$str = generateNotifItems($row,$str);
		}	
		echo $str;	
	}
	else {
		echo -1;
	}
	
	function generateNotifItems($row,$str){
		
		$option = '';
		$option = '<li><a tabindex="-1" href="#" onclick="addToCircle(' . $row["id"] . ');">' . $row["name"] . '</a></li>';
		
		return $str.$option;
	}
?>
