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
  
  $BillingID = null;
  $ConferenceID = null;
  $CostTypeID = null;
  $CostValue = null;
  $ReceiptName = null;
  $ReceiptApproverID = null;

	$data = file_get_contents("php://input");
	$array = json_decode($data,true);
	print_r($array);
  
	foreach($array[jsonform] as $key => $output) {
		print_r($output);
		if($key === 'BillingID') {
			$BillingID = $output;
			print_r($BillingID."\n");
			echo $BillingID."\n";
		}elseif($key === 'ConferenceID'){
			$ConferenceID = $output;
			echo $ConferenceID."\n";
		}elseif($key === 'CostTypeID'){
			$CostTypeID = $output;
			echo $CostTypeID."\n";
		}elseif($key === 'CostValue'){
			$CostValue = $output;
			echo $CostValue."\n";
		}elseif($key === 'ReceiptName'){
			$ReceiptName = $output;
			echo $ReceiptName."\n";
		}elseif($key === 'ReceiptApproverID'){
			$ReceiptApproverID = $output;
			echo $ReceiptApproverID."\n";
		}
	} 

$sql = "INSERT INTO costs (BillingID,ConferenceID,CostTypeID,CostValue,ReceiptName,ReceiptApproverID)
VALUES ($BillingID,$ConferenceID,$CostTypeID,$CostValue,'$ReceiptName','$ReceiptApproverID')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
     echo "Error: " . $sql . "<br>" . $conn->error;
}
 $conn->close();

?>
