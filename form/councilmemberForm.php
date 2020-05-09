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
	$id = null;
	$firstname = null;
	$lastname = null;
	$dob = null;
	$education = null;
    $councilpos = null;
    $partyname = null;
	$subministryname = null;
	$ministrypos = null;
	$image = null;
	$password = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	foreach($array["jsonform"] as $key => $output) {
		if($key === 'id') {
			$id = $output;
			//echo $id."\n";
		}elseif($key === 'firstname'){
			$firstname = $output;
			//echo $firstname."\n";
		}elseif($key === 'lastname'){
			$lastname = $output;
			//echo $lastname."\n";
		}elseif($key === 'dob'){
			$dob = $output;
			//echo $dob."\n";
		}elseif($key === 'education'){
			$education = $output;
			//echo $education."\n";
		}elseif($key === 'councilpos'){
			$councilpos = $output;
			//echo $councilpos."\n";
		}elseif($key === 'partyname'){
			$partyname = $output;
			//echo $partyname."\n";
		}elseif($key === 'subministryname'){
			$subministryname = $output;
			//echo $subministryname."\n";
		}elseif($key === 'ministrypos'){
			$ministrypos = $output;
			//echo $ministrypos."\n";
		}elseif($key === 'password'){
			$password = $output;
			//echo $password."\n";
		}

	} 
		$image = $array["image"];
		$image = explode(',', $image);
		$image = base64_encode($image[1]);
		$image = base64_decode($image);
		//echo $image."\n";

$sql = "INSERT INTO councilmember (personalID,PartyName,PartyPosID,SubministryName,CouncilPosID,
MinistryPosID,Surname,Lastname,DOB,EducationDegree,Password,MemberPicture)
VALUES ('$id','$partyname',1,null,1,1,'$firstname','$lastname','$dob','$education','$password','$image')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();
	


?>
