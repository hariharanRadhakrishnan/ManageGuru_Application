<?php
    
        $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

        // Check connection
        if (mysqli_connect_errno())
          {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

         //query retrieves date and total sales(amount in Rs.) made on that date.
        $sql = "SELECT cast(order_time as time),COUNT(*) FROM orders WHERE DATE(`order_time`) = CURDATE() group by cast(order_time as time)";

        $result = $con->query($sql);

        $names=array();//array which stores the dates
        $vals=array(); //array which stores the corresponding sales
        $count=0;
        $in1=0;//index of vals array
        $in2=0;//index of names array

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                foreach ($row as $key => $value) {
                    
                     if($count++%2==1)
                         $vals[$in1++]=$value;
                     else
                         $names[$in2++]=$value;
                    }
            }
            
            echo json_encode([$names,$vals]);
        } 
        else {
            echo "0 results";
        }
        
        $con->close();             
                    
?>