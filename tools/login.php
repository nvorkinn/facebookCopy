<?PHP

    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/php-includes.php");

    $data = array();
    $data["exists"] = false;

    //Extract login details from the form submission
    $email = strip_tags(stripslashes($mysqli->real_escape_string($_POST["login-email"])));
    $password = sha1(strip_tags(stripslashes($mysqli->real_escape_string($_POST["login-password"]))));
    
    //Query the database to check if the user exists and to extract further information regarding that user if they do exist
    $query = "SELECT user.id, user.admin, user.verified, user.profile_id, profile.name, profile.surname FROM user, profile WHERE profile.email = '$email' AND profile.password = '$password' AND user.profile_id = profile.id LIMIT 1";
    $data["q"] = "SELECT user.id, user.admin, user.verified, user.profile_id, profile.name, profile.surname FROM user, profile WHERE profile.email = '$email' AND profile.password = '$password' AND user.profile_id = profile.id LIMIT 1";
    
    if ($result = $mysqli->query($query)){
        if ($result->num_rows == 1){
            $row = $result->fetch_object();
            $data = $row;
            $data->exists = true;
            $_SESSION["user_id"] = $row->id;
            $_SESSION["admin"] = $row->admin;
        }
    }else{
        echo "DB Error, could not query the database\n";
        echo "MySQL Error: " . mysql_error();
        exit;
    }

    //Encode the results from the SQL as JSON and return it to the frontend for further processing	
    echo json_encode($data);

?>
