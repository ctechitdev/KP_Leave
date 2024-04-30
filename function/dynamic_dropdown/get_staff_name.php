
					<?php
					include('../database_connection.php');
					include('../../checksession.php');
					include "checksession.php";

					$pos_id = $_POST['pos_id'];

					echo "<option value='0'> ເລືອກຝ່າຍ </option>";


					$stmt = $connect->prepare(" SELECT staff_id,concat((case when staff_gender = 2 then 'ນາງ ' else 'ທ້າວ ' end),staff_first_name, ' ', staff_last_name) as full_name
												FROM tbl_staff 
												where staff_position = '$pos_id' ");
					$stmt->execute();
					if ($stmt->rowCount() > 0) {
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$id_staff = $row['staff_id'];
							$full_name = $row['full_name'];
							echo "<option value='$id_staff'>$full_name</option>";
						}
					}


					?> 
					
					 