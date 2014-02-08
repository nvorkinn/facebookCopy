<?PHP

    require_once("../includes/php-includes.php");
    
    // Parse key/value
    $key = strip_tags(stripslashes($mysqli->real_escape_string($_POST["key"])));
    $value = strip_tags(stripslashes($mysqli->real_escape_string($_POST["value"])));
    
    // Form query
    $profile_id = "SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"];    
    
    $mysqli->query("UPDATE profile SET " . $key . " = '" . $value . "' WHERE id = (" . $profile_id . ") LIMIT 1");

?>
