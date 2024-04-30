
					<?php
					include('../database_connection.php');
					
					$dp_id=$_POST['dp_id'];
					 
					echo "<option value='0'> ເລືອກຝ່າຍ </option>";
					
					 
					$stmt = $connect->prepare(" SELECT unit_id,unit_name FROM tbl_depart_unit where depart_id = '$dp_id'  ");
					$stmt->execute();
					if($stmt->rowCount() > 0)
					{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
					$unit_id = $row['unit_id'];
					$unit_name = $row['unit_name'];
						echo "<option value='$unit_id'>$unit_name</option>";
					   
					}
					}
					 
					 
					?> 
					
					 