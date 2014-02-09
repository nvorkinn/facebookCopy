<?PHP

    require_once("../includes/php-includes.php");
    
    // Parse variables
    $name = strip_tags(stripslashes($mysqli->real_escape_string($_POST["name"])));
    $surname = strip_tags(stripslashes($mysqli->real_escape_string($_POST["surname"])));
    $dob = strip_tags(stripslashes($mysqli->real_escape_string($_POST["dob"])));
    $email = strip_tags(stripslashes($mysqli->real_escape_string($_POST["email"])));
    $password = strip_tags(stripslashes($mysqli->real_escape_string($_POST["password"])));    
    
    // Form query
    $profile_id = "SELECT profile_id FROM user WHERE id = " . $_SESSION["user_id"];
    $query = "UPDATE profile SET name = '" . $name . "', surname = '" . $surname . "', email = '" . $email . "' ";
    
    if (strlen($dob) != 0)
    {
        $query = $query . ", dob = " . $dob . " ";
    }
    
    if (strlen($password) != 0)
    {
        $query = $query . ", password = '" . sha1($password) . "' ";
    }
    
    $query = $query . "WHERE id = (" . $profile_id . ") LIMIT 1";
    
    $mysqli->query($query);
    
    echo $query . " " . $mysqli->error;
?>
