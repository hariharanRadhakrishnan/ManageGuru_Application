<?php

$con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

//query item name and number of times it has been ordered
$sql = "SELECT m.dish_name,count(*) FROM menu as m,orders as o WHERE m.dish_id=o.dish_id group by m.dish_name order by count(*) DESC";
$result = $con->query($sql);

$names=array();//array which stores the item names
$vals=array();//array which stores the item order quanities
$count=0;
$in1=0;//index of names array
$in2=0;//index of vals array


if ($result->num_rows > 0) {
    // output data of each row
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