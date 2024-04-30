<?php
include "checksession.php";
include "function/database_connection.php";

$apst = 0;
 
	  if(isset($_POST['BTNsearch']))
{  
	 
	$lv_id = $_POST['leave_id'];
	
	$date_from = $_POST['date_from']; 
	$date_to = $_POST['date_to']; 
	
	$get_date_from = $_POST['date_from']; 
	$from_date = str_replace('/', '-', $get_date_from);
	$date_from = date('Y-m-d', strtotime($from_date));

	$get_date_to = $_POST['date_to']; 
	$to_date = str_replace('/', '-', $get_date_to);
	$date_to = date('Y-m-d', strtotime($to_date));
	 $click = "yes";
}else{
	$click = "no";
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
							<div class="form-group col-md-5">
							</div>
							
							<div class="form-group col-md-2">
								<div class="form-group">
									 
										<div class="controls">
											<input type="text" name="leave_id" id="leave_id"  class="form-control font" value="" placeholder="ເລກທີລາພັກ" > 
										</div> 
								</div> 	 
							</div>
							<div class="form-group col-md-3"> 
							 
							</div>
							 
							<div class="form-group col-md-3"> 
							 
							</div>
							
							<div class="form-group ">
							 
							<div class="input-daterange input-group col-md-12" id="flight-datepicker">
							<div class="form-item text-center">
							<span  >ລາວັນທີ </span>
							<input class="input-sm form-control font text-center" type="text" id="start-date" name="date_from" placeholder=" ກົດເລືອກວັນທີ "  />

							</div>
							<div class="form-item text-center">
							<span  >ຫາວັນທີ </span>
							<input class="input-sm form-control font text-center" type="text" id="end-date" name="date_to" placeholder=" ກົດເລືອກວັນທີ "  />

							</div>
							</div>
							 
								 
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
							<th style="width:5%" > ເລກທີ </th>
							<th style="width:10%" > ຊື່-ນາມສະກຸນ ຜູ້ຂໍ </th>
							<th style="width:10%" > ຈຳນວນທີ່ຈະພັກ </th> 
							<th style="width:10%" > ລົງທະບຽນ </th> 
							<th style="width:10%" > ວັນທີເລີ້ມ </th> 
							<th style="width:10%" > ຫາວັນທີຊີ້ນສຸດ </th>  
							<th style="width:30%" > ເຫດຜົນ </th>  
							<th style="width:10%" > ກວດສອບ </th> 
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
						 	 // echo "asdsad $lv_id - $date_from - $date_to ";
							
						  
							 
							 if($click == "yes"){
								 if(($date_from =='1970-01-01' ) &&  ($date_to=='1970-01-01') && !empty($lv_id)){
								$syntax ="where lr_id = $lv_id ";
								}
								else if(($date_from != '1970-01-01') && ($date_to != '1970-01-01' ) &&  empty($lv_id)){
										$syntax ="where date_from between   '$date_from' and '$date_to' and date_to between '$date_from' and '$date_to' ";
								}else{
									$syntax ="where lr_id = $lv_id and date_from between   '$date_from' and '$date_to' and date_to between '$date_from' and '$date_to'";
								}
								 
							 }else{
								 $syntax ="where date_from between   now() and now() and date_to between now() and now() ";
							 }
							 
							 
							
							
							$stmt = $connect->prepare(" 
							select lr_id,date_leave, hours_leave  , DATE_FORMAT(date_from,'%d-%m-%Y') as date_from ,time_from, 
							DATE_FORMAT(date_to,'%d-%m-%Y') as date_to ,time_to,reason,minus_leave,
							concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end) ,staff_first_name, ' ' ,staff_last_name) as requester_full_name, DATE_FORMAT(date_request,'%d-%m-%Y') as date_request
							from tbl_leave_request a
							left join tbl_user b on a.user_ids = b.user_ids
							left join tbl_staff c on b.staff_id = c.staff_id
                
							$syntax
							order by lr_id desc
							");
							//where lr_id = $lv_id and approve_status = $apst  
							
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
							$date_request = $row['date_request'];
							
							 
							 
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
								
								?>
								
								
								
								<?php
							
							if($date_leave==0){
								?>
								<td><?php echo " $show_hour $show_minus ";?></td> 
								<td><?php echo " $date_request ";?></td>
								
								
								<td><?php echo " $time_from ໂມງ";?></td>
								<td><?php echo " $time_to ໂມງ";?></td>
								<?php
							}else{
								
								?>
								
								<td>
								<?php 
								
								
								echo "$date_leave ວັນ $show_hour $show_minus ";?>
								</td> 
								<td><?php echo " $date_request ";?></td>
								<td><?php echo " $date_from ";?></td>
								<td><?php echo " $date_to ";?></td>
								<?php
							}
							
							?>
					  
							<td><?php echo "$reason";?></td>
						 
					
					
							<td><a href="check_leave_detail.php?request_id=<?php echo "$lr_id"; ?>"  class="btn btn-outline-info btn-rounded"  class="btn btn-outline-info btn-rounded"><i class="fa fa-list-alt"></i> ກວດສອບ </a></td>
							 	
							


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
	<script src="js/bootstrap-datepicker.min.js"></script>
<script src='js/jquery.dateFormat.js'></script>
<script src="js/date_picker.js"></script>

	<?php include "javascript.php";?>
</body>

</html>
