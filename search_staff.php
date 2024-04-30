
 <?php  
include"connect.php";
include "checksession.php";
 $output = '';  
 $fname=$_POST["F_NAME"];
			if (!empty($fname) ) {
				
				
				$stmt = $connect->prepare(" select  a.staff_id as staff_id,concat( (case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end ),staff_first_name,' ',staff_last_name) as full_name,staff_code,depart_name,
							unit_name,position_name 
							from tbl_user a
							left join tbl_staff b on a.staff_id = b.staff_id
							left join tbl_depart c on b.staff_depart = c.depart_id
							left join tbl_depart_unit d on b.staff_unit = d.unit_id
							left join tbl_position e on b.staff_position = e.ps_id 
							where a.staff_id != 0  and  staff_first_name like '%$fname%' ");
							$stmt->execute();
							 
							$output .= " <table class='table full-color-table full-muted-table hover-table'>
                                    <thead>
                                        <tr>
                                            <th> ເລກ CP</th>
                                            <th> ຊື່ ແລະ ນາມສະກຸນ </th>
										   <th> ພະແນກ </th>
										   <th> ຝ່າຍ </th>
										   <th> ຕຳແໜ່ງ </th>
										   <th><div class='col-sm-6 col-md-4 col-lg-3'><i class='fa fa-spin fa-cog'></i> </div></th>
                                        </tr>
                                    </thead>";
									
									if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
								$staff_code = $row['staff_code'];
								$full_name = $row['full_name'];
								$depart_name = $row['depart_name'];
								$unit_name = $row['unit_name']; 
								$position_name = $row['position_name']; 
								$staff_id = $row['staff_id'];



								$output .= '  
								<tr>  
								<td> CP.'.$staff_code.'  </td>
								<td>'.$full_name.'</td>  
								<td>'.$depart_name.'</td>  
								<td>   '.$unit_name.'</td>   
								<td> '.$position_name.' </td>  
								<td> <a href="leave_request_document.php?STID='.$staff_id.'  "  class="btn btn-outline-info btn-rounded"><i class="fa fa-send (alias) text-danger"></i> ຂໍລາພັກ </a>
								</td>  

								</tr>  

								';
		
		
							}
							}
										 
									 
	    echo $output;  // output
      }  
 else  
 {  
      echo '<tr>  <td rowspan="5" class="text-danger text-center">ບໍ່ພົບຂໍ້ມູນ</td></tr>  ';  
 }  
 
 ?> 
 
 
 