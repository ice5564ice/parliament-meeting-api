<?php
	header("Access-Control-Allow-Origin: *");
	header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Content-type: application/json');
	
	$servername = "us-cdbr-iron-east-01.cleardb.net";
	$dbusername = "b30ea52d3aa952";
	$dbpassword = "918a5c13";
	$dbname = "heroku_1c39a65d43a5546";
	$conn = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$ArgumentatorID = null;
	$StartArgumentTime = null;
	$SubTopicName = null;
	$ConferenceID = null;
	$EndArguemntTime = null;

	$starttime =null;
	$starttimemin=null;
	$starttimesec=null;
	$endtime=null;
	$endtimemin=null;
	$endtimesec=null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	//print_r($array);
	foreach($array['argumentatorID'] as $key => $output) {
		if($key == "PersonalID"){
			$ArgumentatorID = $output;
		//	print_r($ArgumentatorID."\n");
		}
	} 
	foreach($array['subtopicname'] as $key => $output) {
		if($key == "SubTopicName"){
			$SubTopicName = $output;
			print_r($SubTopicName."\n");
		}else if($key == "ConferenceID"){
			$ConferenceID = $output;
			//print_r($ConferenceID."\n");
		}
	} 
	
	$StartArgumentTime = $array['starttime'].":".$array['starttimemin'].":".$array['starttimesec'];
	$EndArguemntTime = $array['endtime'].":".$array['endtimemin'].":".$array['endtimesec'];
	if($EndArguemntTime === "::"){
		$EndArguemntTime = "NULL";
	}else{
		$EndArguemntTime = "'".$array['endtime'].":".$array['endtimemin'].":".$array['endtimesec']."'";
	}
	//print_r($StartArgumentTime);
//	print_r($EndArguemntTime);
			
	
$sql = "INSERT INTO argumentation (ArgumentatorID,StartArgumentTime,SubtopicName,ConferenceID,EndArgumentTime)
VALUES ('$ArgumentatorID','$StartArgumentTime','$SubTopicName','$ConferenceID',$EndArguemntTime)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();
	


?>
