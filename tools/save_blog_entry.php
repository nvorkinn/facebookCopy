<?PHP

    require_once("../includes/php-includes.php");

    $title = $mysqli->real_escape_string($_POST["title"]);
    $content = $mysqli->real_escape_string($_POST["content"]);

    $privacy = $mysqli->real_escape_string($_POST["privacy"]);
    
    $privacySettingsId = 1;
    
    if ($privacy == "Friends")
    {
        $privacySettingsId = 2;
    }
    else
    if ($privacy == "Friends of friends")
    {
        $privacySettingsId = 3; 
    }
    else
    {
        // Make sure $privacy is a valid circle id
        $result = $mysqli->query("SELECT * FROM circle WHERE id = $privacy LIMIT 1");
        if ($result->num_rows != 0)
        {
            // Find the circle's privacy setting or create one if there isn't one already
            $result = $mysqli->query("SELECT * FROM privacy_setting WHERE circle_id = $privacy LIMIT 1");
            if ($result->num_rows != 0)
            {
                $privacySettingsId = $result->fetch_object()->id;
            }
            else
            {
                $mysqli->query("INSERT INTO privacy_setting (circle_id, name) VALUES ($privacy, (SELECT name FROM circle WHERE id = $privacy LIMIT 1))");
                $privacySettingsId = $mysqli->insert_id;
            }
        }
    }
    
    $query = "INSERT INTO blog (user_id, title, content, privacy_setting_id) VALUES (" . $_SESSION["user_id"] . ", '$title', '$content', $privacySettingsId)";
    $mysqli->query($query);
    
    echo $mysqli->insert_id;
    
    $query = "INSERT INTO activity (from_user_id, main_type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 4, 0, $mysqli->insert_id)";
    $mysqli->query($query);
    
?>
