<?PHP 
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'facebookcopy');
if($mysqli->connect_errno > 0){
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}


?>