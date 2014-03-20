<?PHP

    require_once("../includes/php-includes.php");
    
    $post = $mysqli->real_escape_string($_POST["post"]);
    $content = $mysqli->real_escape_string($_POST["content"]);
    
    $query = "INSERT INTO comment (user_id, post_id, content, deleted) VALUES (" . $_SESSION["user_id"] . ", $post, '$content', 0)";
    $mysqli->query($query);
    
    echo $mysqli->insert_id;
    
?>
