<?php
  include_once("config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT t.ConferenceTypeName,COUNT(*) AS Times
      FROM councilconference c,conferencetype t
      WHERE c.conferencetypeID = t.conferencetypeID
      GROUP BY t.conferencetypeID
      ORDER BY Times;";
 
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
