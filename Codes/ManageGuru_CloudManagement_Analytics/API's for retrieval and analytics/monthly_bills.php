<?php
header("Access-Control-Allow-Origin: *");
extract( $_POST );

$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//query returns day of the month and total number of bills generated for that day
$sql = "SELECT extract(day from bill_time),count(*) from billing where extract(month from bill_time)=".$select." group by extract(day from bill_time)";

$result = $con->query($sql);

$names=array();//array which stores the dates
$vals=array();//array which stores the bill count
$count=0;
$in1=0;//index of names array
$in2=0;//index of vals array

if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
		foreach ($row as $key => $value) {
			 //echo $value." ";
             if($count++%2==1)
                 $vals[$in2++]=$value;
             else
                 $names[$in1++]=$value;
			}
    }
    
    echo json_encode([$names,$vals]);
} 
else {
    echo "0 results";
}
$con->close();

?>
