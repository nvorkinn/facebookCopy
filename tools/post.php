<?PHP

    require_once("../includes/php-includes.php");

    $query = "INSERT INTO post (user_id, type, privacy_settings_id, location, content, deleted) VALUES (" . $_SESSION["user_id"] . ", 0, 1, 'London, United Kingdom', '" . strip_tags(stripslashes($_POST["content"])) . "', 0)";
    $mysqli->query($query);
    
    $query = "INSERT INTO activity (from_user_id, type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 3, 0, $mysqli->insert_id)";
    $mysqli->query($query);
    
?>
