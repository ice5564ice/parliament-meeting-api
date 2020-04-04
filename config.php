<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
 
	$db_username = 'b30ea52d3aa952';
	$db_password = '918a5c13';
	$db_name = 'heroku_1c39a65d43a5546';
	$db_host = 'us-cdbr-iron-east-01.cleardb.net';				
	$mysqli = new mysqli($db_host, $db_username, $db_password, $db_name);
 
	if ($mysqli->connect_error) {
		die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
	}
?>