<?php
  include_once("../config.php");
 
$postdata = file_get_contents("php://input");
$personalid=$_GET["username"];
 
$sql="SELECT 'Less than 30' AS age_Interval , 
      COUNT(*) AS Numbers,
      FORMAT((COUNT(*) /(SELECT COUNT(*) 
      FROM councilmember )*100),2) AS Percentage
FROM councilmember
WHERE  FLOOR(DATEDIFF(CURRENT_DATE,DOB)/365)  < 30
UNION 
SELECT '30 - 40' AS age_Interval , 
      COUNT(*) AS Numbers,
      FORMAT((COUNT(*) /(SELECT COUNT(*) 
      FROM councilmember )*100),2) AS Percentage
FROM councilmember
WHERE  FLOOR(DATEDIFF(CURRENT_DATE,DOB)/365)  BETWEEN 30 AND 40
UNION
SELECT '41 - 50' AS age_Interval , 
      COUNT(*) AS Numbers,
      FORMAT((COUNT(*) /(SELECT COUNT(*) 
      FROM councilmember )*100),2) AS Percentage
FROM councilmember
WHERE  FLOOR(DATEDIFF(CURRENT_DATE,DOB)/365)  BETWEEN 41 AND 50
UNION
SELECT '51 - 60' AS age_Interval , 
      COUNT(*) AS Numbers,
      FORMAT((COUNT(*) /(SELECT COUNT(*) 
      FROM councilmember )*100),2) AS Percentage
FROM councilmember
WHERE  FLOOR(DATEDIFF(CURRENT_DATE,DOB)/365)  BETWEEN 51 AND 60
UNION
SELECT 'more than 60' AS age_Interval , 
     COUNT(*) AS Numbers,
      FORMAT((COUNT(*) /(SELECT COUNT(*) 
      FROM councilmember )*100),2) AS Percentage
FROM councilmember
WHERE  FLOOR(DATEDIFF(CURRENT_DATE,DOB)/365)  > 60;";
 
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
