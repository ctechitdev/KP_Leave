<?php
include "checksession.php"; 
include "function/database_connection.php";
error_reporting(0);
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


<?php  include "stylesheet.php"; ?> 
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
						<div class="card-block">
					 
		 
					 
					 
						<h2 class="card-title text-center">ຂໍ້ມູນ ຂໍລາພັກ </h2>
						 
						
						  
                                <form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data">
								
									<?php
									
									$stmt_select = $connect->prepare(" select * from full_view_doc where lr_id =:rqid ");  
									$stmt_select->execute(array(':rqid'=>$_GET['request_id']));
									  
									 
									$row=$stmt_select->fetch(PDO::FETCH_ASSOC);
									$lr_id = $row['lr_id'];		 
									$leave_name = $row['leave_name'];
									$date_leave = $row['date_leave'];
									$hours_leave = $row['hours_leave'];
									$minus_leave = $row['minus_leave']; 
									$date_from = $row['date_from']; 
									$time_from = $row['time_from'];  
									$date_to = $row['date_to'];  
									$time_to = $row['time_to'];  
									$reason =  $row['reason']; 
									 
									 
									$attatch_file = $row['attatch_file']; 
								 		 
									$staff_code = $row['staff_code'];
									$requester_full_name = $row['requester_full_name']; 
									 
									$staff_position = $row['position_name'];
									$select_staff_depart = $row['depart_name'];
									$staff_unit =  $row['unit_name'];
								 
								 

									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                                             <div class="form-group col-md-12">
                      <label for="inputEmail"> ຄຳຂໍເລກທີ :  </label> <label for="inputEmail"> <?php echo "$lr_id ";?> </label>
					  <input type="hidden" name = "request_id" class="form-control" placeholder="" value ="<?php echo "$lr_id ";?> ">
					  
					  <input type="hidden" name = "approve_level" class="form-control" placeholder="" value ="<?php echo "$approve_level ";?> ">
                     </div>
				  
				  <?php
						//debug
						// echo"$approve_level";
						?>
						
                    <div class="form-group col-md-6">
                      <label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$requester_full_name";?> </label>
                     </div>
					 
					  <div class="form-group col-md-6">
                      <label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$staff_code ";?> </label>
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
					 
					 
					 
					 <div class="form-group col-md-6">
                      <label for="inputEmail"> ມີຄວາມຈຳເປັນຕ້ອງລາພັກວຽກ : </label> <label for="inputEmail"><?php echo "$date_leave ມື້ $hours_leave ຊົ່ວໂມງ $minus_leave ນາທີ ";?></label>
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
					 
					 <div class="form-group col-md-12">
                      <label for="inputEmail"> ຫຼັກຖານການລາ :  </label> 
					  <label for="inputEmail"> 
					  <?php
					  if($attatch_file =='ບໍ່ມີເອກະສານແນບ'){
						  echo"$attatch_file";
					  }else{
						  ?>
						 <a href="view_attach_doc.php?leave_id=<?php echo "$lr_id"; ?>" target="_blank" ><?php echo"$attatch_file"; ?></a>   
						  <?php
					  }
					  ?>
					 
					  
					  </label>
                     </div> 
					 
					  
					<?php 
					 
					$select_lv1 = $connect->prepare(" select concat( staff_first_name ,' ', staff_last_name ) as approve_name,approve_reason,
					(case when approve_status = 1 then 'ອານຸຍາດ' when approve_status = 2 then 'ປະຕິເສດ' else 'ລໍຖ້າ' end) as approval ,approve_status,approve_date,approve_level
					from tbl_approval a
					left join tbl_staff b on a.approve_by = b.staff_id where lr_id =:rqid and approve_level = 1 ");  
					$select_lv1->execute(array(':rqid'=>$_GET['request_id']));
					$row_lv1=$select_lv1->fetch(PDO::FETCH_ASSOC);
					
				 
					$approve_name_lv1 = $row_lv1['approve_name'];
					$approve_reason_lv1 = $row_lv1['approve_reason'];
					$approve_status_lv1 = $row_lv1['approve_status']; 
					$approval_lv1 = $row_lv1['approval'];
					$approve_date_lv1 = $row_lv1['approve_date'];
					$approve_level_lv1 = $row_lv1['approve_level']; 
					
					if($approve_status_lv1 == 1){
						$apmc = "#01690a";
					}else if($approve_status_lv1 == 2){
						$apmc = "red";
					}else {
						$apmc = "blue";
					}
					
					if(!empty($approve_name_lv1)){
						?>
						
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;" > ຜູ່ຈັດການ </label>
					<div> <?php echo "$approve_name_lv1";?> </div>
					<div> <?php echo "$approve_reason_lv1";?> </div>
					<div style="color:<?php echo "$apmc";?>" > <?php echo "$approval_lv1";?> </div>
					<div> <?php echo "$approve_date_lv1";?>  </div> 
					</div>
					
					<?php
					}else{
						?>
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;" > ຜູ່ຈັດການ </label>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______  </div> 
					</div>
					
					<?php
					}
					
					?>
					 
					
					<?php 
					 
					$select_lv2 = $connect->prepare(" select concat( staff_first_name ,' ', staff_last_name ) as approve_name,approve_reason,
					(case when approve_status = 1 then 'ອານຸຍາດ' when approve_status = 2 then 'ປະຕິເສດ' else 'ລໍຖ້າ' end) as approval, approve_status,approve_date,approve_level
					from tbl_approval a
					left join tbl_staff b on a.approve_by = b.staff_id where lr_id =:rqid and approve_level = 2 ");  
					$select_lv2->execute(array(':rqid'=>$_GET['request_id']));
					$row_lv2=$select_lv2->fetch(PDO::FETCH_ASSOC);
					
				 
					$approve_name_lv2 = $row_lv2['approve_name'];
					$approve_reason_lv2 = $row_lv2['approve_reason'];
					$approve_status_lv2 = $row_lv2['approve_status']; 
					$approval_lv2 = $row_lv2['approval'];
					$approve_date_lv2 = $row_lv2['approve_date'];
					$approve_level_lv2 = $row_lv2['approve_level']; 
					
					
					if($approve_status_lv2 == 1){
						$apmc2 = "#01690a";
					}else if($approve_status_lv2 == 2){
						$apmc2 = "red";
					}else {
						$apmc2 = "blue";
					}
					
					
					if(!empty($approve_name_lv2)){
						?>
						
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;" > ອຳນວຍການ/ຮອງປະທານ </label>
					<div > <?php echo "$approve_name_lv2";?> </div>
					<div > <?php echo "$approve_reason_lv2";?> </div>
					<div style="color:<?php echo "$apmc2";?>" > <?php echo "$approval_lv2";?> </div>
					<div > <?php echo "$approve_date_lv2";?>  </div> 
					</div>
					
					<?php
					}else{
						?>
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;" > ອຳນວຍການ/ຮອງປະທານ </label>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______  </div> 
					</div>
					
					<?php
					}
					
					?>
					
					
					<?php 
					 
					$select_lv3 = $connect->prepare(" select concat( staff_first_name ,' ', staff_last_name ) as approve_name,approve_reason,
					(case when approve_status = 1 then 'ອານຸຍາດ' when approve_status = 2 then 'ປະຕິເສດ' else 'ລໍຖ້າ' end) as approval , approve_status,approve_date,approve_level
					from tbl_approval a
					left join tbl_staff b on a.approve_by = b.staff_id where lr_id =:rqid and approve_level = 3 ");  
					$select_lv3->execute(array(':rqid'=>$_GET['request_id']));
					$row_lv3=$select_lv3->fetch(PDO::FETCH_ASSOC);
					
				 
					$approve_name_lv3 = $row_lv3['approve_name'];
					$approve_reason_lv3 = $row_lv3['approve_reason'];
					$approve_status_lv3 = $row_lv3['approve_status']; 
					$approval_lv3 = $row_lv3['approval'];
					$approve_date_lv3 = $row_lv3['approve_date'];
					$approve_level_lv3 = $row_lv3['approve_level']; 
					
					if($approve_status_lv3 == 1){
						$apmc3 = "#01690a";
					}else if($approve_status_lv3 == 2){
						$apmc3 = "red";
					}else {
						$apmc3 = "blue";
					}
					
					if(($approve_status_lv3 != 0)){
						?>
						
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;"> ຝ່າຍບຸກຄະລາກອນ </label> 
					<div > <?php echo "ພະແນກບຸກຄະລາກອນ";?> </div>
					<div > <?php echo "$approve_reason_lv3";?>  </div>
					<div style="color:<?php echo "$apmc3";?>" >  <?php echo "$approval_lv3";?> </div>
					<div > <?php echo "$approve_date_lv3";?>  </div> 
					</div>
					
					<?php
					}else if($approve_status_lv3 == 0){
						?>
					<div class="form-group   col-md-4 text-center">                      
					<label style="font-weight:bold; text-decoration: underline;"> ຝ່າຍບຸກຄະລາກອນ </label> 
					<div > <?php echo "ພະແນກບຸກຄະລາກອນ";?> </div>
					<div > <?php echo "$approve_reason_lv3";?>  </div>
					<div style="color:<?php echo "$apmc3";?>" >  <?php echo "$approval_lv3";?> </div>
					<div > <?php echo "$approve_date_lv3";?>  </div> 
					</div> 
						
						<?php
					}
					else{
						?>
					<div class="form-group   col-md-4 text-center">                      
					<label  style="font-weight:bold; text-decoration: underline;"> ຝ່າຍບຸກຄະລາກອນ </label>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______ </div>
					<div > ______  </div> 
					</div>
					
					<?php
					}
					
					?>
					
					 				
											
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
