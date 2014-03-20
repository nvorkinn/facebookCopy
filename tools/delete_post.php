<?PHP

    require_once("../includes/php-includes.php");

    $id = $mysqli->real_escape_string($_POST["id"]);
    
    $query = "DELETE FROM post WHERE id = $id LIMIT 1";
    $mysqli->query($query);
    
    $query = "DELETE FROM comment WHERE post_id = $id";
    $mysqli->query($query);
        
    $query = "INSERT INTO activity (from_user_id, main_type, sub_type, object_id) VALUES (" . $_SESSION["user_id"] . ", 3, 1, -1)";
    $mysqli->query($query);
    
?>
