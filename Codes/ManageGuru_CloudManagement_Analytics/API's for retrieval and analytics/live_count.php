<?php

		set_time_limit(0);
		
		for($x=0;$x<100;$x++){
			
			$file=fopen("order_count.txt","w");
            
            $con = mysqli_connect("127.0.0.1:49985","azure","6#vWHD_$","manageguru");

            // Check connection
            if (mysqli_connect_errno())
              {
              echo "Failed to connect to MySQL: " . mysqli_connect_error();
              }

                $sql = "SELECT COUNT(*) FROM orders WHERE DATE(`order_time`) = CURDATE()";



            $result = $con->query($sql);

            $data=0;
           


            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    foreach ($row as $key => $value) {
                         echo $value;
                         $data=$value;
                        }
                }
            } 
            else {
                echo "0 results";
            }
            $con->close();
			
			fwrite($file,$data);
			sleep(4);			
			
		}


?>