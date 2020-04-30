<?php
  include_once("config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT  m.SurName,m.LastName,
    FORMAT(SUM(TIME(DATE_FORMAT(A.AttendantTime,'%H:%i:%s'))<=TIME(c.startTime) ),0) AS ONTIME,
    FORMAT(SUM(TIME(DATE_FORMAT(A.AttendantTime,'%H:%i:%s'))>TIME(c.startTime) ),0) AS LATE,
    (SELECT conferencetypeName
    FROM councilconference c,Attendees A,conferencetype t
    WHERE A.PersonalID = m.PersonalID AND A.ConferenceID = c.ConferenceID
        AND c.conferencetypeID = t.conferencetypeID
    GROUP BY A.PersonalID,c.conferencetypeID
    HAVING FORMAT(SUM(TIME(DATE_FORMAT(A.AttendantTime,'%H:%i:%s'))>TIME(c.startTime) ),0) != 0
    ORDER BY FORMAT(SUM(TIME(DATE_FORMAT(A.AttendantTime,'%H:%i:%s'))>TIME(c.startTime) ),0)
    LIMIT 1 ) AS MaxLateType
FROM councilconference c,councilmember m,Attendees A
WHERE A.PersonalID = m.PersonalID AND A.ConferenceID = c.ConferenceID
GROUP BY A.PersonalID;";
 
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
