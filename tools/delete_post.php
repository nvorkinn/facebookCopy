<?PHP

    require_once("../includes/php-includes.php");

    $id = $mysqli->real_escape_string($_POST["id"]);
    
    $query = "DELETE FROM post WHERE id = $id LIMIT 1";
    $mysqli->query($query);
    
    $query = "DELETE FROM activity WHERE type = 3 AND sub_type = 0 AND object_id = $id LIMIT 1";
    $mysqli->query($query);
    
?>
