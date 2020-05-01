<?php
  include_once("config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT PersonalID,PartyName,p.PartyPosName,SubMinistryName,c.CouncilposName,mn.MinistryPosName,
        Surname,Lastname,DOB,EducationDegree,m.Password,MemberPicture
FROM councilmember m,PartyPos p,councilpos c,ministrypos mn
WHERE m.PartyPosID = p.PartyPosID AND m.CouncilPosID = c.CouncilPosID
        AND m.MinistryPosID = mn.MinistryPosID AND m.PersonalID = $personalid;";
 
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
