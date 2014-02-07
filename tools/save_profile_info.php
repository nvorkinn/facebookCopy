<?PHP

    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");
    
    // Parse key/value
    $key = strip_tags(stripslashes($mysqli->real_escape_string($_POST["key"])));
    $value = strip_tags(stripslashes($mysqli->real_escape_string($_POST["value"])));
    
    // Form query
    $profile_id = "SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"];    
    
    $mysqli->query("UPDATE profile SET " . $key . " = '" . $value . "' WHERE id = () LIMIT 1");
    
    // Return value for confirmation
    echo $mysqli->query("SELECT " . $key . " FROM profile WHERE id = " . $profile_id . " LIMIT 1")->fetch_object()->$key;

?>
