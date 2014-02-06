<?PHP 
//Start NotificationServer
require_once ($_SERVER['DOCUMENT_ROOT'].'/php/protected/NotificationServer.php');

//Start sessions
session_start();

//Configure database
$mysqli = new mysqli('localhost', 'root', '', 'facebookcopy');
if($mysqli->connect_errno > 0){
    die('Unable to connect to database [' . $mysqli->connect_error . ']');
}

?>