<?php 
$link = mysql_connect('localhost', 'root', '');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db('facebookcopy', $link);
if (!$db_selected) {
    die ('Can\'t use database : ' . mysql_error());
}

?>