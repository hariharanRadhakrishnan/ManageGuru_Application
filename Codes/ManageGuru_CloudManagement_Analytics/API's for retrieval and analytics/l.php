<?php
 header("Access-Control-Allow-Origin: *");
  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  $sql = "SELECT filled FROM tables";


$result = $con->query($sql);
$sum=0
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
         $sum+=$row["filled"];
    }
} else {
    echo "0 results";
}
echo "sum=".$sum;
$con->close();

   


?>