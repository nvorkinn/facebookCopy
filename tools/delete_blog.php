<?PHP

    require_once("../includes/php-includes.php");

    $id = $mysqli->real_escape_string($_POST["id"]);
    
    $query = "DELETE FROM blog WHERE id = $id LIMIT 1";
    $mysqli->query($query);
    
    $query = "INSERT INTO activity (from_user_id, main_type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 4, 1, -1)";
    $mysqli->query($query);
    
?>
