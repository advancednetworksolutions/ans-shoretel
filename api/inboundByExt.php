<?php
include('../../../config/shoretel_config.php');


  $query = 'SELECT Extension as extension,COUNT(*) as calls FROM shorewarecdr.call, shorewarecdr.connect WHERE shorewarecdr.connect.CallTableID = shorewarecdr.call.ID AND shorewarecdr.connect.PartyIDFlags = 12 AND shorewarecdr.connect.TalkTimeSeconds > 0 AND shorewarecdr.call.CallType=2 AND shorewarecdr.call.StartTime like "2016-09-15%"  group by extension;';

 //echo $query;


$results=mysqli_query($con,$query);


$all_rows = array();

while($row = mysqli_fetch_assoc($results)){
  //print_r($row);
  $all_rows [] = $row;
}




header("Content-Type: application/json");
echo json_encode($all_rows);
mysqli_close($con);


?>
