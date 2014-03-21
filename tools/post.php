<?PHP

    require_once("../includes/php-includes.php");
    require_once("post_helper.php");
	
	
    $privacy = $mysqli->real_escape_string($_POST["privacy"]);
	
	post_helper($privacy,"STATUS",null,null);

   
?>
