<?PHP 

    //Start sessions
    session_start();

    //Configure database
    $mysqli = new mysqli("localhost", "root", "", "facebookcopy");
    
	$azure_storage_account_name="fbcopymedia";
	$azure_storage_key="ovHi3B1PiOZUsK6Hclo5yld68dOVpzl5CKPIvK0Gp7u7TX05A/XxdP5Hqli0Igb2dsF2M206cdvAL46CTzYH2w==";
	$azure_storage_url="http://".$azure_storage_account_name.".blob.core.windows.net/";
	
    if($mysqli->connect_errno > 0) {
        die("Unable to connect to database [" . $mysqli->connect_error . "]");
    }

?>
