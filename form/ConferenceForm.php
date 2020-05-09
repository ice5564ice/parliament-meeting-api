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
	$chairmanID = null;
	$ConferenceID = null;
	$ConferenceTopic = null;
	$StartTime = null;
	$StartTimeMin = null;
	$EndTime = null;
	$EndTimeMin = null;
	$Dates = null;
    $ConferenceTypeID = null;
    $BuildingName = null;
	$RoomNo = null;


	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	print_r($array);
	foreach($array as $key => $output) {
		if($key === 'topicname') {
			$ConferenceTopic = $output;
			echo $ConferenceTopic."\n";
		}elseif($key === 'dateconference'){
			$Dates = $output;
			echo $Dates."\n";
		}elseif($key === 'chairmanID'){
			$chairmanID = $output;
			echo $chairmanID."\n";
		}elseif($key === 'endtime'){
			$EndTime = $output;
			echo $EndTime."\n";
		}elseif($key === 'endtimemin'){
			$EndTimeMin = $output;
			echo $EndTimeMin."\n";
		}elseif($key === 'starttime'){
			$StartTime = $output;
			echo $StartTime."\n";
		}elseif($key === 'starttimemin'){
			$StartTimeMin = $output;
			echo $StartTimeMin."\n";
		}elseif($key === 'buildingname'){
			$BuildingName = $output['BuildingName'];
			echo $BuildingName."\n";
		}
		elseif($key === 'conferencetype'){
			$ConferenceTypeID = $output['ConferenceTypeID'];
			echo $ConferenceTypeID."\n";
		}elseif($key === 'roomnumber'){
			$RoomNo = $output['RoomNo'];
			echo $RoomNo."\n";
		}
	} 

$sql = "INSERT INTO councilconference (ConferenceID,ConferenceTopic,StartTime,Endtime,Dates,
ConferenceTypeID,BuildingName,RoomNo,ChairmanID)
VALUES ('$ConferenceID','$ConferenceTopic','$StartTime:$StartTimeMin','$EndTime:$EndTimeMin','$Dates','$ConferenceTypeID','$BuildingName','$RoomNo','$chairmanID')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();

?>
