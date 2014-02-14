<?PHP

    require_once("../includes/php-includes.php");

    $query = "INSERT INTO post (user_id, type, privacy_settings_id, location, content, deleted) VALUES (" . $_SESSION["user_id"] . ", 0, 1, 'London, United Kingdom', '" . strip_tags(stripslashes($_POST["content"])) . "', 0)";
    $mysqli->query($query);
    
?>
