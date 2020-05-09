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
	$image = null;
	$image2 = null;
	$partyName = null;
	$FounderID = null;
	$FoundingTime = null;
	$PartyTel = null;
	$BuildingName = null;
    $BuildingNO = null;
    $BuildingStreet = null;
	$BuildingDetail = null;
	$BuildingPicture = null;
	$SubDistrictName = null;
	$Zipcode = null;
	$BuildingType = null;
	$PartyLogo = null;
	$leaderID = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	
	foreach($array["jsonform"] as $key => $output) {
		if($key === 'buildingdetail') {
			$BuildingDetail = $output;
			echo $BuildingDetail."\n";
		}elseif($key === 'buildingname'){
			$BuildingName = $output;
			echo $BuildingName."\n";
		}elseif($key === 'buildingnumber'){
			$BuildingNO =   $output;
			echo  $BuildingNO."\n";
		}elseif($key === 'buildingstreet'){
			$BuildingStreet = $output;
			echo $BuildingStreet."\n";
		}elseif($key === 'buildingtype'){
			$BuildingType = $output;
			echo $BuildingType."\n";
		}elseif($key === 'founderID'){
			$FounderID = $output;
			echo $FounderID."\n";
		}elseif($key === 'founderdate'){
			$FoundingTime = $output;
			echo $FoundingTime."\n";
		}elseif($key === 'leaderID'){
			$leaderID = $output;
			echo $leaderID."\n";
		}
		elseif($key === 'partyname'){
			$partyName = $output;
			echo $partyName."\n";
		}
		elseif($key === 'subdistrict'){
			$SubDistrictName = $output;
			echo $SubDistrictName."\n";
		}
		elseif($key === 'telephone'){
			$PartyTel = $output;
			echo $PartyTel."\n";
		}
		elseif($key === 'zipcode'){
			$Zipcode = $output;
			echo $Zipcode."\n";
		}
	} 
	if($FounderID === ''){
		$FounderID = "NULL";
	}else{
		$FounderID = "'".$FounderID."'";
	}

	if($BuildingName === ''){
		$BuildingName = "NULL";
	}else{
		$BuildingName = "'".$BuildingName."'";
	}

	if($BuildingStreet === ''){
		$BuildingStreet = "NULL";
	}else{
		$BuildingStreet = "'".$BuildingStreet."'";
	}

	if($BuildingDetail === ''){
		$BuildingDetail= "NULL";
	}else{
		$BuildingDetail = "'".$BuildingDetail."'";
	}
	
		$image = $array["image"];
		$image = explode(',', $image);
		$image = base64_encode($image[1]);
		$image = base64_decode("'".$image."'");
		//echo $image."\n";
		if($image !== null){
			$image = "'".$image."'";
		}else{
			$image = "NULL";
		}

		$image2 = $array["image2"];
		$image2 = explode(',', $image2);
		$image2 = base64_encode($image2[1]);
		$image2 = base64_decode("'".$image2."'");
		//echo $image2."\n";
		if($image2 !== null){
			$image2 = "'".$image2."'";
		}else{
			$image2 = "NULL";
		}
		
		
		
	
	
$sql = "INSERT INTO politicalparty (partyName,FounderID,FoundingTime,PartyTel,BuildingName,
BuildingNO,BuildingStreet,BuildingDetail,BuildingPicture,SubDistrictName,Zipcode,BuildingType,PartyLogo)
VALUES ('$partyName',$FounderID,'$FoundingTime','$PartyTel',$BuildingName,'$BuildingNO',$BuildingStreet,$BuildingDetail,$image2,'$SubDistrictName','$Zipcode','$BuildingType',$image)";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();
	


?>
