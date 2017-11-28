<?php
	include "connect.php";
	include "checkinternet.php";
	$franchise = 'F1';
	while (true) {
		if(is_connected())
		{
			$sql = "SELECT * FROM upload WHERE upload_id = (SELECT min(upload_id) FROM upload)";
			$result = $conn->query($sql);
			if($result->num_rows > 0)
			{
				$row = $result->fetch_assoc();
				$upload_id = $row["upload_id"];
				$query = $row["upload_info"];
				$query = explode("$", $query);
				$data = array();
				$url = '';
				if($row["upload_type"] == "inventory")
				{
					$url = "http://manageguru.azurewebsites.net/insert_inventory_orders.php";
					$username = $query[3];
					$sql = "SELECT user_id from users where user_name = '$username'";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						$row = $result->fetch_assoc();
						$user_id = $row["user_id"];
					}
					else
					{
						exit();
					}
					$data["item_code"] = $query[0];
					$data["item_type"] = $query[1];
					$data["quantity"] = $query[2];
					$data["user_id"] = 'U'.$user_id;
					$data["order_time"] = $query[4];
					$data["franchise_id"] = $franchise; 				
				}
				elseif($row["upload_type"] == "order")
				{
					$url = "http://manageguru.azurewebsites.net/insert_order.php";
					$data["order_id"] = 'O'.($query[0] + 6666);
					$dish_name = $query[1];
					$dish_type = $query[2];
					$sql = "SELECT dish_id from menu where dish_name = '$dish_name' and dish_type = '$dish_type'";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						$row = $result->fetch_assoc();
						$dish_id = $row["dish_id"];
					}
					else
					{
						exit();
					}
					$data['dish_id'] = $dish_id;
					$data['table_id'] = $query[3];
					$data['order_time'] = $query[4];
					$data['franchise_id'] = $franchise;
				}
				elseif($row["upload_type"] == "bill")
				{
					$url = "http://manageguru.azurewebsites.net/insertbill.php";
					$data["bill_id"] = 'B'.($query[0]+6520);
					$data["bill_time"] = $query[1];
					$data["amount"] = $query[2];
					$data["table_id"] = $query[3];
					$data["payment_type"] = $query[4];
					$data["customer_name"] = $query[5];
					$data["franchise_id"] = $franchise;
				}
				else //Waiter
				{
					$url = "http://manageguru.azurewebsites.net/update_waiters.php";
					$data['table_id'] = $query[0];
					$username = $query[1];
					$sql = "SELECT user_id from users where user_name = '$username'";
					$result = $conn->query($sql);
					if($result->num_rows > 0)
					{
						$row = $result->fetch_assoc();
						$user_id = $row["user_id"];
					}
					else
					{
						exit();
					}
					$data['user_id'] = $user_id;
					$date_time = explode(" ", $query[2]);
					$data["date"] = $date_time[0];
					$data["time"] = $date_time[1];
					$data["franchise_id"]= $franchise;
				}
				$data = http_build_query($data);
				echo "<br>".$data."<br>";
				$options = array(
				    'http' => array(
				        'header'=> "Content-type: application/x-www-form-urlencoded\r\n"."Content-Length: ".strlen($data) . "\r\n",
				        'method'  => 'POST',
				        'content' => $data
				    )
				);
				$context  = stream_context_create($options);
				$result = file_get_contents($url, false, $context);
				if ($result === FALSE) 
				{ 
					echo "error"; 
				}
				else
				{
					$sql = "DELETE FROM upload WHERE upload_id = $upload_id";
					$result = $conn->query($sql);
				}
				var_dump($result);
			}
			else
			{
				echo "No Uploads Available<br>";
			}
		}
		else
		{
			echo "No Internet Connection<br>";
		}
	}