<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT m.surname AS Speaker_Surname,m.lastname AS Speaker_Lastname,
       m2.surname AS Argumentator_Surname,m2.lastname AS Argumentator_Lastname
       ,TIME(SUM(EndArgumentTime-StartArgumentTime)) AS Time
FROM subtopic s,councilmember m,argumentation a,councilmember m2
WHERE s.SpeakerID = m.personalID AND s.subtopicName IN 
                                       (SELECT subtopicName
                                        FROM argumentation)
      AND s.subtopicName = a.subtopicName
      AND a.ArgumentatorID = m2.personalID
GROUP BY s.SpeakerID,a.ArgumentatorID
ORDER BY Time DESC
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
