<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
 
$sql="select m.Surname, m.Lastname, p.CouncilPosName, p.CouncilPosDetail
from councilmember m JOIN councilpos p ON m.CouncilPosID = p.CouncilPosID;";
 
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
