<?php
  include_once("config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT ConferenceTopic,TIME(EndTime - StartTime) AS duration
      FROM councilconference
      LIMIT 3;";
 
if($result = mysqli_query($mysqli,$sql))
{
 $rows = array();
  while($row = mysqli_fetch_assoc($result))
  {
    $rows[] = $row;
  }
 
  echo json_encode($rows);
}
else
{
  http_response_code(404);
}
?>
