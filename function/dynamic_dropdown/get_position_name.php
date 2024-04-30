
					<?php
					include('../database_connection.php');
					
					$un_id=$_POST['unit_id'];
					 
					echo "<option value='0'> ເລືອກຝ່າຍ </option>";
					
					 
					$stmt = $connect->prepare(" select ps_id, position_name from tbl_position where unit_id = '$un_id'  ");
					$stmt->execute();
					if($stmt->rowCount() > 0)
					{
					while($row=$stmt->fetch(PDO::FETCH_ASSOC))
					{
					$ps_id = $row['ps_id'];
					$position_name = $row['position_name'];
						echo "<option value='$ps_id'>$position_name</option>";
					   
					}
					}
					 
					 
					?> 
					
					 