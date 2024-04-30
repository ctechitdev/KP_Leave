<?php
include "checksession.php";
include "function/database_connection.php";

 
 
	  if(isset($_POST['BTNsearch']))
{  
 
	$date_from = $_POST['date_from']; 
	$date_to = $_POST['date_to']; 
	
	$get_date_from = $_POST['date_from']; 
	$from_date = str_replace('/', '-', $get_date_from);
	$date_from = date('Y-m-d', strtotime($from_date));

	$get_date_to = $_POST['date_to']; 
	$to_date = str_replace('/', '-', $get_date_to);
	$date_to = date('Y-m-d', strtotime($to_date));
	
	
}else{
	$date_from =""; 
	$date_to =  ""; 
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
							
							
							
							<h1 class="card-title text-center"> ລາຍງານ ຂໍລາພັກ </h1>
							
							<div class="row p-t-20 text-center" id="result">
							
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
							
							 
							
							<div class="form-group col-md-4"> 
							 
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
							<th style="width:15%"  > ຊື່-ນາມສະກຸນ ຜູ້ຂໍ </th>
							<th style="width:8%"  > ລາປ່ວຍ </th> 
							<th style="width:8%" > ລາປະຈຳປີ </th> 
							<th style="width:8%"  > ລາເກີດລູກ </th>  
							<th style="width:8%"  > ລາກິດ </th> 
							<th style="width:8%"  > ລາແຕ່ງງານ </th> 
							<th style="width:8%"  > ລາບວດ </th> 
							<th style="width:8%"  > ລາສຶກສາຕໍ່ </th> 
							<th style="width:8%"  > ລາບໍ່ໄດ້ຮັບຄ່າຈ້າງ </th> 
							<th style="width:8%"  > ອື່ນໆ </th> 
							</tr>
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
							$stmt = $connect->prepare("SELECT distinct a.user_ids as staff_user,concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end), staff_first_name ,' ', staff_last_name) as full_name
														FROM   tbl_leave_request a
														left join tbl_user b on a.user_ids = b.user_ids
														left join tbl_staff c on b.staff_id = c.staff_id 
														where date_from between  '$date_from' and '$date_to' and date_to between '$date_from' and  '$date_to'
							");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						
							$staff_user = $row['staff_user']; 
							$full_name = $row['full_name'];  
							

						 
							?>

							<tr>  
							<td><?php echo "$i";?></td> 
							<td style=" text-align: left;"><a href="show_rpt_leave_detail.php?  SID=<?PHP ECHO"$staff_user"?> && DF=<?PHP ECHO"$date_from"?> && DT=<?PHP ECHO"$date_to"?>" target="_blank"><?php echo " $full_name";?></a></td>
                                                       
							<?php
							
							$stmt2 = $connect->prepare(" select user_ids, sum(sick_leave)as sick_leave ,sum(anual_leave)as anual_leave,sum(pagneg_leave)as pagneg_leave,
								sum(mission_leave)as mission_leave,sum(married_leave)as married_leave,sum(mong_leave)as mong_leave,sum(learn_leave)as learn_leave,
								sum(nopayment_leave)as nopayment_leave,sum(other_leave)as other_leave
								 from pre_count_leave
								 where user_ids = '$staff_user' 
								 and date_from between  '$date_from' and '$date_to' and date_to between '$date_from' and  '$date_to'
								 group by user_ids
							");
							
							$stmt2->execute();
							
							if($stmt2->rowCount() > 0)
							{
							while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
							{
								
							$sick_leave = $row2['sick_leave'];
							$anual_leave = $row2['anual_leave'];
							$pagneg_leave = $row2['pagneg_leave'];
							$mission_leave = $row2['mission_leave'];
							$married_leave = $row2['married_leave'];
							$mong_leave = $row2['mong_leave'];
							$learn_leave = $row2['learn_leave'];
							$nopayment_leave = $row2['nopayment_leave'];
							$other_leave = $row2['other_leave'];
							
							
							}
							
							 
							
							?>
					  
							<td><?php echo "$sick_leave";?></td>
							<td><?php echo "$anual_leave";?></td>
							<td><?php echo "$pagneg_leave";?></td>
							<td><?php echo "$mission_leave";?></td>
							<td><?php echo "$married_leave";?></td>
							<td><?php echo "$mong_leave";?></td>
							<td><?php echo "$learn_leave";?></td>
							<td><?php echo "$nopayment_leave";?></td>
							<td><?php echo "$other_leave";?></td>
							
					 
					<?php
					
							}
							 
	   		 
				
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
                                            <td colspan="12">
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
