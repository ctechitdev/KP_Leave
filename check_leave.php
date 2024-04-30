<?php
 include "checksession.php";

  
 include "function/database_connection.php";
 $error_reason ="";
 $submit ="";
 	  if(isset($_POST['btnapply']))
{
	 
	$submit ="yes";
	$approve_status = 1;
}
			 
			if(isset($_POST['btnreject']))
{ 	$submit ="yes";
	$approve_status = 2;

}

if($submit =="yes"){
	
		
	 
		$request_id = $_POST['request_id'];
		
		$approve_reason = $_POST['approve_reason'];
		$date_request = date("Y-m-d");
		
		$get_next_level = $_POST['next_level'];
		$approver_id = $_POST['approver_id'];
		$ap_level = $_POST['approve_level'];
		$count_row = $_POST['count_row'];
		
		
		if(empty($approver_id)){
			$approver_id = 0; 
			
		}
		
	 
		
		if($approve_status == 1 && $approver_id == "" && $ap_level == 1 && $count_row == 2){
			$error_message ="ກະລຸນາເລືອກຜູ້ອານຸຍາດ "; 

		}else if($approve_status == 2 && $approve_reason == "" ){
			$error_reason =" ກະລຸນາຕື່ມເຫດຜົນບໍ່ອານຸຍາດ";
		}
		else{
			
			if ($ap_level == 1 && $count_row == 2){
				$next_level = $get_next_level;
			}else{
				$next_level = 3;
			}
			 

		if($ap_level == 3){
			$stmt1 = $connect->prepare('update tbl_approval  set approve_status = :apstate,approve_reason =:aprs,approve_by = :stc where lr_id = :rlid and approve_by = 0 '); 
		}else{
			$stmt1 = $connect->prepare('update tbl_approval  set approve_status = :apstate,approve_reason =:aprs where lr_id = :rlid and approve_by = :stc '); 
		}
		
		$stmt1->bindParam(':apstate',$approve_status); 
		$stmt1->bindParam(':aprs',$approve_reason);
		$stmt1->bindParam(':stc',$staff_id); 
		$stmt1->bindParam(':rlid',$request_id);
		$stmt1->execute();
		
		
		
		
		 
 if($stmt1->execute())
{ 
		if($approve_status == 1){
			
			if($ap_level != 3){
				
			
		$stmt = $connect->prepare('INSERT INTO tbl_approval ( lr_id,approve_status,approve_by,approve_level,approve_date )
		VALUES(:rlid, 0, :apby, :apnl, :apdate  )'); 
		$stmt->bindParam(':rlid',$request_id);  
		$stmt->bindParam(':apby',$approver_id); 
		$stmt->bindParam(':apnl',$next_level); 
		$stmt->bindParam(':apdate',$date_request); 
		$stmt->execute();
		
		
		// prepare select  email forward hrm@kplaocompany.com
	 
		$stmt2 = $connect->prepare(" select  lr_id,Full_name,reason,leave_name,start_date,to_date,(case when approve_by = 0 then 'hrm@kplaocompany.com' else app_email end) as app_email ,line_token,
		(case when depart_email is null then 'hrm@kplaocompany.com' else depart_email end) as depart_email 
		from pre_email_leave_id 
		where lr_id = '$request_id'  and approve_by = '$approver_id'");
		
		// end email forward 	
		
		}else {
		$stmt2 = $connect->prepare("  select lr_id,Full_name,depart_name,position_name,reason,leave_name,start_date,to_date,staff_email as app_email,line_token,  depart_email
		from staff_email_leave
		where lr_id = '$request_id'  "); 
		}
			
			$message_approve = "approve";
		}else{
			
		$stmt2 = $connect->prepare("  select lr_id,Full_name,depart_name,position_name,reason,leave_name,start_date,to_date,staff_email as app_email,line_token,  depart_email
		from staff_email_leave
		where lr_id = '$request_id'  ");
			
			$message_approve = "reject";
		}

		
		 
			$stmt2->execute();
			while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
			{
				
			extract($row2); 
			$lr_id = $row2['lr_id']; 
			$Full_name = $row2['Full_name']; 
			$reason = $row2['reason']; 
			$leave_name = $row2['leave_name']; 
			$start_date = $row2['start_date']; 
			$to_date = $row2['to_date'];
			$app_email = $row2['app_email']; 
			$depart_name = $row2['depart_name'];
			$position_name = $row2['position_name']; 
			$line_token = $row2['line_token']; 
			$depart_email = $row2['depart_email']; 
			
			
			 
			
			}
			
$_SESSION['request_id'] = $lr_id; 
$_SESSION['Full_name'] = $Full_name;
$_SESSION['reason'] = $reason;
$_SESSION['leave_name'] = $leave_name;
$_SESSION['start_date'] = $start_date; 
$_SESSION['to_date'] = $to_date; 
$_SESSION['app_email'] = $app_email; 
$_SESSION['ap_level'] = $ap_level; 
$_SESSION['message_approve'] = $message_approve; 
$_SESSION['depart_name'] = $depart_name; 
$_SESSION['position_name'] = $position_name;
$_SESSION['line_token'] = $line_token;
$_SESSION['depart_email'] = $depart_email;
 

 if($stmt2->execute())
{ 
header("location:request_approve.php");	
}


} 
}			  			
			
	
}
 
 

?>

<!DOCTYPE html>
<html lang="en">
 
<head>
 
 <script type="text/javascript" src="js/jquery.min.js"></script>      <!-- jQuery -->
 	<script>
		$(function(){
			
	 
		
		$('#dp_id').change(function(){
			var dp_id=$('#dp_id').val();
			$.post('get_unit_name.php',{
				dp_id:dp_id
			},
			function(output){
				$('#unit_id').html(output).show();
			});
		});
		
		$('#unit_id').change(function(){
			var unit_id=$('#unit_id').val();
			$.post('get_position.php',{
				unit_id:unit_id
			},
			function(output){
				$('#pos_id').html(output).show();
			});
		});
		
		$('#pos_id').change(function(){
			var pos_id=$('#pos_id').val();
			$.post('get_staff_name.php',{
				pos_id:pos_id
			},
			function(output){
				$('#approver_id').html(output).show();
			});
		});
		
		
		});
	</script>
 

</head>



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
              <div class="row" id="row">
			      <div class="col-12">
                        <div class="card"> 
						<form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data">
						<div class="card-block">
					 
		 
					 
					 
						<h2 class="card-title text-center">ຂໍ້ມູນ ຂໍລາພັກ </h2>
						 
						
						  
                            
								
									<?php
									if($role_level == 4){
										$syntax = "  approve_by in ($staff_id,'0') ";
									}else {
										$syntax = "  approve_by = $staff_id ";
									}
									
									$stmt_select = $connect->prepare(" select * from detail_leave_request   where lr_id =:rqid  and $syntax "); 
									$stmt_select->execute(array(':rqid'=>$_GET['request_id']));
									  
									 
									$row=$stmt_select->fetch(PDO::FETCH_ASSOC);
									$lr_id = $row['lr_id'];		 
									$leave_name = $row['leave_name'];
									$date_leave = $row['date_leave'];
									$hours_leave = $row['hours_leave'];
									$minus_leave = $row['minus_leave'];
									 
									 
									$rq_staff_id = $row['staff_id'];
									$date_from = $row['date_from'];
									$time_from = $row['time_from'];
									$date_to = $row['date_to'];
									$time_to =  $row['time_to'];
									$reason =  $row['reason'];

									$approve_level = $row['approve_level'];
									
									$next_level = $approve_level+1;

									$attatch_status = $row['attatch_status'];
									$attatch_file = $row['attatch_file'];

									$date_request = $row['date_request'];		 
									$staff_code = $row['staff_code'];
									$staff_first_name = $row['staff_first_name'];
									$staff_last_name = $row['staff_last_name'];
									$staff_gender = $row['staff_gender'];
									$staff_position = $row['staff_position'];
									$select_staff_depart = $row['staff_depart'];
									$staff_unit =  $row['staff_unit'];
								 
									
									$approve_status = $row['approve_status']; 
									
									if($approve_status == 1 ){
									$message_status = "ອານຸຍາດແລ້ວ";
									}
									else if ($approve_status == 2 ){
									$message_status = "ບໍ່ອານຸຍາດ";
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

									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                                             <div class="form-group col-md-12">
                      <label for="inputEmail"> ຄຳຂໍເລກທີ :  </label> <label for="inputEmail"> <?php echo "$lr_id ";?> </label>
					  <input type="hidden" name = "request_id" class="form-control" placeholder="" value ="<?php echo "$lr_id ";?> ">
					  <input type="hidden" name = "next_level" class="form-control" placeholder="" value ="<?php echo "$next_level ";?> ">
					  <input type="hidden" name = "approve_level" class="form-control" placeholder="" value ="<?php echo "$approve_level ";?> ">
                     </div>
				   
				  <?php
				  
				  	$stmt_count = $connect->prepare(" SELECT  (count(distinct level_ap)) as count_approve FROM tbl_set_approval where rq_by = '$rq_staff_id' "); 
					$stmt_count->execute(); 
					$rc=$stmt_count->fetch(PDO::FETCH_ASSOC);
					$count_row = $rc['count_approve'];	
				  
				  
				  
						//debug
						//  echo"$count_row";
						?>
					<input type="hidden" name = "count_row" class="form-control" placeholder="" value ="<?php echo "$count_row";?> ">	
                    <div class="form-group col-md-6">
                      <label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_gender $staff_first_name $staff_last_name";?> </label>
                     </div>
					 
					  <div class="form-group col-md-6">
                      <label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_code  ";?> </label>
                     </div>
					 
					 <div class="form-group col-md-4">
                      <label for="inputEmail"> ຕຳແໜ່ງ :  </label> <label for="inputEmail"> <?php echo "$staff_position  ";?> </label>
                     </div>
					 <div class="form-group col-md-4">
                      <label for="inputEmail"> ພະແນກ :  </label> <label for="inputEmail"> <?php echo "$select_staff_depart  ";?> </label>
                     </div>
					 <div class="form-group col-md-4">
                      <label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"> <?php echo "$staff_unit  ";?> </label>
                     </div>
					 
					  
					 
					 <div class="form-group col-md-6">
                      <label for="inputEmail"> ປະເພດການລາ :  </label> <label for="inputEmail"> <?php echo "$leave_name  ";?> </label>
                     </div>
					 
					 <div class="form-group col-md-3>
                      <label for="inputEmail"> ຈຳນວນວັນລາ :  </label> <label for="inputEmail"> <?php echo "$date_leave ວັນ $hours_leave ຊົ່ວໂມງ  ";?> </label>
                     </div>
					 
					 <div class="form-group col-md-12">
                      <label for="inputEmail"> ມີຄວາມຈຳເປັນຕ້ອງລາພັກວຽກ (ຈຳນວນວັນລາ) :  </label> <label for="inputEmail">
					  <?php
					   
					  echo " $date_leave ວັນ $show_hour $show_minus  ";
					  
					  
					  ?></label>
                     </div>
					 
					 <div class="form-group col-md-2">
                      <label for="inputEmail"> ຕັ້ງແຕ່ວັນທີ່ :  </label> <label for="inputEmail">  </label>
                     </div>
					 
					 <div class="form-group col-md-3">
                      <label for="inputEmail">    </label> <label for="inputEmail"><?php echo "$date_from ເວລາ $time_from   ";?></label>
                     </div>
			 
					 <div class="form-group col-md-2">
                      <label for="inputEmail"> ຫາວັນທີ່ :  </label> <label for="inputEmail">  </label>
                     </div>
					 
					 <div class="form-group col-md-5">
                      <label for="inputEmail">    </label> <label for="inputEmail"><?php echo "$date_to ເວລາ $time_to  ";?></label>
                     </div>
					 
					  <div class="form-group col-md-1">
                      <label for="inputEmail"> ເຫດຜົນ :  </label> <label for="inputEmail">  </label>
                     </div>
					 
					 <div class="form-group col-md-11">
                      <label for="inputEmail">    </label> <label for="inputEmail"><?php echo "$reason ";?></label>
                     </div>
					 
					 <div class="form-group col-md-2">
                      <label for="inputEmail"> ຫຼັກຖານການລາ :  </label> <label for="inputEmail">  </label>
                     </div> 
					 
					<div class="form-group col-md-10">
					<label for="inputEmail">    </label> <label for="inputEmail"> 
					<?php 

					if($attatch_status == 'ສະແດງເອກະສານ'){

					?> 
					<a href="view_attach_doc.php?leave_id=<?php echo "$lr_id"; ?>" target="_blank" ><?php echo"$attatch_status"; ?></a>   

					<?php


					}else {
					echo "$attatch_status ";

					}

					?>


					</label>
					</div>
					<?php
					
					
				 
											
								if($count_row == 2 && $approve_level == 1){
							 
									   
								?>
								<div class="form-group col-md-3"> 
								<label for="inputEmail"> ຊື່ຜູ້ອະນຸຍາດ   </label> 
								
								<select class="form-control font" name="approver_id" id ="approver_id" >
								<option value=""> ເລືອກ ຊື່ຜູ້ອะນຸຍາດ </option> 
								<?php
								 
								$stmt = $connect->prepare(" 
								SELECT staff_id,CONCAT( staff_first_name, ' ', staff_last_name) AS FULL_NAME   from tbl_set_approval a
								left join tbl_staff b on a.ap_by = b.staff_id 
								where rq_by = $rq_staff_id and level_ap >= 2
								
								 
								");
								$stmt->execute();
								if($stmt->rowCount() > 0)
								{
								while($row=$stmt->fetch(PDO::FETCH_ASSOC))
								{
								?> <option value="<?php echo $row['staff_id']; ?>"> <?php echo $row['FULL_NAME']; ?></option> 
								<?php   
								}
								} 
								?>
								</select> 
									<label  style="color:red"> <?php echo "$error_message"; ?> </label>  
								</div>
								<?php
								}   
										 
					  
						
					 if($approve_status == 0) {
					
					?>
					
					<div class="form-group   col-md-12">                      
                      <label for="inputEmail"> ເຫດຜົນ ອານຸຍາດ </label>
                      <input type="text" name = "approve_reason" class="form-control" placeholder=" ເຫດຜົນ "  >   
 					  <label  style="color:red"> <?php echo "$error_reason"; ?> </label>  
                    </div>
					  
					
					<div class="form-group    col-md-12" align = "center">
                       
						<button type="submit"  name="btnapply"  class="btn btn-success font"> <i class="fa fa-check"></i> ອານຸຍາດ </button>
						<button type="submit"  name="btnreject"  class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ປະຕິດເສດ </button>
                    </div>
					<?php
					}else{
					?>	
						<div class="form-group   col-md-12" align="center">                      
                      <label for="inputEmail"> 
					  <?php
					  if($approve_status == 1){
					  ?>
					  <h1 style="color:green;"><?php echo "$message_status";?> </h1> 
					  <?php
					  } else if ($approve_status == 2){
						  ?>
						  <h1 style="color:red;"><?php echo "$message_status";?> </h1> 
						 <?php 
					  } 
					   
					}
					?>
					  
					  
					 
						
					  
					
					  </label>
                                                     
                    </div>
						
					
					
											
											
											
                                            </div>
                                        </div>
											<div class="text-center" align = "center">
											
											
											</div>
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
