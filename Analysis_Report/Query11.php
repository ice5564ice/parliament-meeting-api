<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT m.PartyName,
        (SELECT count(*) 
        FROM attendees a ,councilmember m2
        WHERE a.PersonalID = m2.PersonalID AND m2.partyName = m.partyName) AS Number,
        FORMAT(( (SELECT count(*) 
        FROM attendees a ,councilmember m2
        WHERE a.PersonalID = m2.PersonalID AND m2.partyName = m.partyName) 
        /(SELECT COUNT(*) 
        FROM attendees )*100),2) AS Percentage
FROM   councilmember m
GROUP BY m.partyName
ORDER BY Number;";
 
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
