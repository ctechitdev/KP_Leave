<?php
include "checksession.php";
include "function/database_connection.php";

$apst = 0;
 
	  if(isset($_POST['BTNsearch']))
{  
	$apst = $_POST['approver_id'];  
	 
}

?>
<!DOCTYPE html>
<html lang="en">
<?php 

include "stylesheet.php"; 

?>
 
<body class="fix-header fix-sidebar card-no-border">

    <div id="main-wrapper">
      <?php
	  include "header.php";
	  include "menu.php";
	  ?>
        <div class="page-wrapper">
            <!-- Container fluid  -->

            <div class="container-fluid">
              <div class="row">
			   <div class="col-12">
                        <div class="card">
							 
							<div class="card-block" id="result">
							
							<form class="m-t-40" novalidate action="" method="post" >
							
							
							
							<h1 class="card-title text-center">ລາຍການຂໍລາພັກ</h1>
							
							<div class="row p-t-20 text-center" id="result">
							
							 <div class="form-group col-md-4">
								 
							</div>
							
							 
							
							<div class="form-group col-md-4"> 
								<select class="form-control font" name="approver_id" id ="approver_id" required>
								<option value=""> ເລືອກ ສະຖານະຄຳຂໍ </option> 
								<option value="0"> ລໍຖ້າ </option> 
								<option value="1"> ອານຸມັດ </option> 
								<option value="2"> ຍົກເລີກ </option> 
								</select>
							</div>
                                             
									 
                            </div>
							 
							<div class="col-md-12">
								<div class="form-group text-center">
									<button type="submit" name="BTNsearch" class="btn btn-success btn-lg btn-rounded waves-effect waves-light m-b-40 font"> <i class="ti-search"></i> ຄົ້ນຫາ</button>

								</div>
							</div>
							
							 
							
							<div class="table-responsive ">
							 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr class="">
							<th style="width:5%"  > ເລກທີ </th>
							<th style="width:12%"  > ຊື່-ນາມສະກຸນ ຜູ້ຂໍ </th>
							<th style="width:8%"  > ຈຳນວນທີ່ຈະພັກ </th> 
							<th style="width:10%" > ວັນທີເລີ້ມ </th> 
							<th style="width:10%"  > ຫາວັນທີຊີ້ນສຸດ </th>  
							<th style="width:30%"  > ເຫດຜົນ </th> 
							<th style="width:10%"  > ສະຖານະ </th> 
							<th style="width:10%"  > ກວດສອບ </th> 
							</tr>
							</thead>
									<div class='m-t-40'>
										<?php
										
							
								 
							//	 echo "$staff_id";		
										?>
                                    <div class='d-flex'> 
									<div class='ml-auto'>
										<div class='form-group'>
										
											<input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
										</div>
									</div>
                                    </div>
									
                                    </div>	  
                                    <tbody>
									  <?PHP
						 	// echo "$apst";
						 
							
							$stmt = $connect->prepare(" select lr_id,concat(a.staff_gender,' ',full_name) as full_name,reason,date_leave,hours_leave,minus_leave,date_from,date_to,
							DATE_FORMAT(time_from, '%H:%i') as time_from, DATE_FORMAT(time_to, '%H:%i') as time_to,
							concat((case when b.staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,approve_status
							from list_leave_view a
							left join tbl_staff b on a.staff_id = b.staff_id 
							where approve_by = $staff_id  and approve_status = $apst  
							order by lr_id desc
							");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						
							$lr_id = $row['lr_id'];
						 
							$full_name = $row['requester_full_name']; 
							$date_leave = $row['date_leave'];
							$hours_leave = $row['hours_leave'];
							$date_from = $row['date_from'];
							$time_from = $row['time_from'];
							$date_to = $row['date_to'];
							$time_to = $row['time_to'];
							$reason = $row['reason'];
							$approve_status = $row['approve_status'];
							$minus_leave = $row['minus_leave'];
							
						 
							?>

							<tr>  
							<td><?php echo "$lr_id";?></td>
							<td style=" text-align: left;"><?php echo " $full_name";?></td>
							
							
							
							<?php
							
								if($hours_leave == 0){
									$show_hour = "";
								}else{
									$show_hour = $hours_leave ." ຊົ່ວໂມງ";
								}
								if($minus_leave == 0){
									$show_minus = "";
								}else{
									$show_minus = $minus_leave ." ນາທີ";
								}
							
							if($date_leave==0){
								?>
								<td><?php echo " $show_hour $show_minus ";?></td> 
								<td><?php echo "   $time_from ໂມງ";?></td>
								<td><?php echo "  $time_to ໂມງ";?></td>
								<?php
							}else{
								?>
								<td>
								<?php 
								
								
								echo "$date_leave ວັນ $show_hour $show_minus ";?>
								</td> 
								<td><?php echo "ວັນທີ່ $date_from  ";?></td>
								<td><?php echo "ວັນທີ່ $date_to ";?></td>
								<?php
							}
							
							?>
					  
							<td><?php echo "$reason";?></td>
							<td> 
					<?php
					
				
	   		
				 
					if ($approve_status ==1 ){
					?>
					<h5 style="color:green;"><?php echo "ອານຸມັດ"; ?></h5>
					<?php
					}
					else if($approve_status ==2){
					?>
					<h5 style="color:red;"><?php echo "ຍົກເລີກ"; ?></h5>
					<?php
					}  else{ 
				?>
				<h5 style="color:blue;"><?php echo "ລໍຖ້າ"; ?></h5>
				<?php
				}
				
				?>
					
					</td> 
					
					
							<td><a href="check_leave.php?request_id=<?php echo "$lr_id"; ?>"  class="btn btn-outline-info btn-rounded"  class="btn btn-outline-info btn-rounded"><i class="fa fa-list-alt"></i> ກວດສອບ </a></td>
							 	
							


							</td>

							</tr>

							<?php
						 
								}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="8">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
							</form>
                            </div>
                        </div>
                        </div>
                </div>
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
		
    </div>
	<?php include "javascript.php";?>
</body>

</html>
