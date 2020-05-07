<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT 	SubTopicName,NumberRejector,
    FORMAT((NumberRejector/(NumberRejector+	NumberAcceptor+NumberNonvoter)),2) AS Percentage
    FROM   subtopic
    GROUP BY subtopicname
    ORDER BY NumberRejector DESC;";
 
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
