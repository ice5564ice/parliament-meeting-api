<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT  BuildingName,
        (SELECT t.conferencetypeName
         FROM conferencetype t,councilconference c2
         WHERE c2.buildingName = c.buildingName  AND c2.conferencetypeID = t.conferencetypeID
         GROUP BY c2.conferencetypeID
         ORDER BY COUNT(*) DESC
         LIMIT 1) AS ConferenceType,
        (SELECT SUM(Costs.CostValue)
         FROM costs
         WHERE c.ConferenceID = costs.ConferenceID) AS Costs
FROM councilconference c  
GROUP BY BuildingName;";
 
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
