<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT p.PartyName,COUNT(*) AS members,CONCAT(FORMAT((COUNT(*)*100 / 
            (SELECT count( * ) 
            FROM councilmember 
            WHERE PartyName IS NOT NULL)),2) ,  "%") AS percentage
      FROM politicalparty p,councilmember m
      GROUP BY m.PartyName = p.partyName
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
