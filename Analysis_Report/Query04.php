<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
 
$sql="SELECT p.PartyName,COUNT(*) AS members,FORMAT((COUNT(*)*100 ,2)
FROM politicalparty p,councilmember m
WHERE m.PartyName = p.PartyName
GROUP BY m.PartyName
ORDER BY members;";
 
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
