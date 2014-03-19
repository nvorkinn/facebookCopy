<?PHP

    require_once("../includes/php-includes.php");
    
    header("Content-type: text/xml");
    
    $user = $mysqli->query("SELECT * FROM user WHERE id = " . $_SESSION["user_id"] . " LIMIT 1")->fetch_object();
    $profile = $mysqli->query("SELECT * FROM profile WHERE id = $user->profile_id LIMIT 1")->fetch_object();
    
    $profilePhotoUrl = null;
    $result = $mysqli->query("SELECT * FROM photo WHERE id = $profile->profile_photo_id LIMIT 1");
    if ($result->num_rows != 0)
    {
        $profilePhotoUrl = $result->fetch_object()->photo_url;
    }
    
    $coverPhotoUrl = null;
    $result = $mysqli->query("SELECT * FROM photo WHERE id = $profile->cover_photo_id LIMIT 1");
    if ($result->num_rows != 0)
    {
        $coverPhotoUrl = $result->fetch_object()->photo_url;
    }
    
    echo "<user id='$user->id' admin='$user->admin' verified='$user->verified' hash='$user->hash'>";
    echo "    <profile id='$profile->id'>";
    echo "        <name>$profile->name</name>";
    echo "        <surname>$profile->name</surname>";
    echo "        <dob>$profile->dob</dob>";
    echo "        <email>$profile->email</email>";
    
    $result = $mysqli->query("SELECT * FROM photo WHERE user_id = $user->id");
    for ($i = 0; $i < $result->num_rows; $i++)
    {
        $photo = $result->fetch_object();
        echo "        <photo url='$photo->photo_url'></photo>";
    }
    
    $result = $mysqli->query("SELECT * FROM post WHERE user_id = $user->id");
    for ($i = 0; $i < $result->num_rows; $i++)
    {
        $post = $result->fetch_object();
        echo "        <post date='$post->date' location='$post->location'>$post->content</post>";
    }
    
    echo "    </profile>";
    echo "</user>";
    
?>
