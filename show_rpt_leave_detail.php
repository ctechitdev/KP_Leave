<?php
include "checksession.php";
include "function/database_connection.php";

 

$SID = $_GET['SID'];
$DFrom = $_GET['DF'];
$DTo = $_GET['DT'];
 
 

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
							
							
							
							<h1 class="card-title text-center"> ລາຍການຂໍລາພັກ </h1>
							
							<div class="row p-t-20 text-center" id="result">
							
							<?php
							$stmt2 = $connect->prepare(" select concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end), staff_first_name ,' ', staff_last_name) as full_name,
									depart_name
									from tbl_user a
									left join tbl_staff b on a.staff_id = b.staff_id
									left join tbl_depart c on b.staff_depart = c.depart_id
									where a.user_ids = '$SID'
							"); 
							$stmt2->execute(); 
							if($stmt2->rowCount() > 0)
							{
							while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
							{
								
							$full_name = $row2['full_name'];
							$depart_name = $row2['depart_name'];
							
							}
							}
							
							?>
							
							
							
							
							
							<div class="form-group col-md-12"> 
							<h2> <?php echo "$full_name ($depart_name)";?></h2>
							</div>
							
							<div class="form-group col-md-3">  
							</div>
							
							<div class="form-group col-md-3"> 
							<h4  >ລາວັນທີ  <?php echo "$DFrom";?></h4>
							</div>
							
							<div class="form-group col-md-3"> 
							<h4  >ຫາວັນທີ <?php echo "$DTo";?> </h4>
							</div>
							
						 
							
						 
                                             
									 
                            </div>
							 
							<div class="table-responsive ">
							 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr class="">
							<th style="width:5%"  > ລຳດັບ </th>
							<th style="width:15%"  >ປະເພດ</th>
							<th style="width:15%"  > ຈຳນວນລາ </th> 
							<th style="width:20%" > ວັນທີລາ </th> 
							<th style="width:30%"  > ເຫດຜົນ </th>   
							</thead>
									<div class='m-t-40'>
										<?php
										
							
								 
						 	// echo "$date_from";	
							// echo "$date_to";
							 
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
						 
							$i = 1;
							$stmt = $connect->prepare("select   leave_name,date_leave,hours_leave,minus_leave,date_from,date_to, reason
								from tbl_leave_request a
								left join tbl_leave_type b on a.leave_type = b.lt_id
								where user_ids = '$SID'   and date_from between  '$DFrom' and '$DTo' and date_to between '$DFrom' and  '$DTo'
							");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						
							$leave_name = $row['leave_name']; 
							$date_leave = $row['date_leave'];  
							$hours_leave = $row['hours_leave']; 
							$minus_leave = $row['minus_leave']; 
							$date_from = $row['date_from']; 
							$date_to = $row['date_to']; 
							$reason = $row['reason']; 
							
							if($date_leave == 0){
								
								$show_date ="";
								}else{
									$show_date = $date_leave ." ວັນ";
								}
								
							 
							
							
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
							
							if($date_from == 0){
								$show_df = "";
							}else{
								$show_df = $date_from  ;
							}
							
							if($date_to == 0){
								$show_dt = "";
							}else{
								$show_dt = $date_to ;
							}

						 
							?>

							<tr>  
							<td><?php echo "$i";?></td> 
							                         
							 
							<td><?php echo "$leave_name";?></td>
							<td><?php echo "$show_date $show_hour $show_minus";?></td>
							<td>
							 
							<?php 
							if($show_df == $show_dt){
								echo "$show_df ";
							}else{
								echo "$show_df ຫາ $show_dt";
							}
							
							
							
							
							?>
							
							</td> 
							<td><?php echo "$reason";?></td> 
							
					 
					<?php
					
							 
							 
	   		 
				
				?>
					
				 

							 

							</tr>

							<?php
						 $i++;
								}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="5">
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
