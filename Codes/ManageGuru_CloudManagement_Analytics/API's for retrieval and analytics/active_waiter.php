<?php

  extract($_GET);
  
  $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

// Check connection

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

  $sql = "SELECT w.user_id, u.user_name from waiters w, users u WHERE u.user_id=w.user_id GROUP BY w.user_id ORDER BY count(w.user_id) DESC LIMIT 1";
  //$sql = "SELECT user_id,count(user_id) as number from waiters GROUP BY user_id ";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
		$data["user_id"] = $row["user_id"];
		$data["user_name"] = $row["user_name"];
        echo json_encode($data);
    }
} else {
    echo "0 results";
}
$con->close();

?>