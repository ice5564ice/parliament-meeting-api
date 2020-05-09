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
//building
$sql = "SELECT * FROM building ";
$result = mysqli_query($conn,$sql) or die("Bad query: $sql");

if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $json_data[] = array(
            "BuildingName" => $row['BuildingName'],   
            "BuildingType" => $row['BuildingType'],  
            "BuildingNO" => $row['BuildingNO'],  
            "BuildingStreet" => $row['BuildingStreet'],  
            "BuildingDetail" => $row['BuildingDetail'],  
            "BuildingPicture" => $row['BuildingPicture'],  
            "Zipcode" => $row['Zipcode'], 
            "BuildingPicture" => $row['BuildingPicture'] 
        );
    }
}

// แปลง array เป็นรูปแบบ json string  
if(isset($json_data)){  
    $json= json_encode($json_data);    
    if(isset($_GET['callback']) && $_GET['callback']!=""){    
    echo $_GET['callback']."(".$json.");";        
    }else{    
    echo $json;    
    }    
}

?>