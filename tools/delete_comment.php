<?PHP

    require_once("../includes/php-includes.php");

    $id = $mysqli->real_escape_string($_POST["id"]);
    
    $query = "DELETE FROM comment WHERE id = $id LIMIT 1";
    $mysqli->query($query);
    
?>
