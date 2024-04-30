<?php
 include "checksession.php";
 include "function/database_connection.php";

 
   $check_error ="";
 

	if(isset($_POST['btninsert'])) { 
	
		$staffr_ct = $_POST['staffr_ct'];
	
		$staff_ct = $_POST['staff_ct'];
		$staff_ct2 = $_POST['staff_ct2'];
  
		if( $staff_ct != 0){
		$stmt = $connect->prepare('INSERT INTO tbl_set_approval ( rq_by,ap_by,level_ap )
		VALUES(:stfid,:stt, 1 )');
		$stmt->bindParam(':stfid',$staffr_ct);
		$stmt->bindParam(':stt',$staff_ct); 
		$stmt->execute();
		
		$check = 1;
		}	 
		
		if( $staff_ct2 != 0){
		$stmt2 = $connect->prepare('INSERT INTO tbl_set_approval ( rq_by,ap_by,level_ap )
		VALUES(:stfid,:stt, 2 )');
		$stmt2->bindParam(':stfid',$staffr_ct);
		$stmt2->bindParam(':stt',$staff_ct2); 
		$stmt2->execute();
		
		$check = 2;
		}
		

		
	if($check == 1 || $check == 2 ){
		$show_modal = 1;
	}
		
			
		 
			 
			
	 
			
		 
		
		// end data join person tag



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
			$.post('function/dynamic_dropdown/get_unit_name.php',{
				dp_id:dp_id
			},
			function(output){
				$('#unit_id').html(output).show();
			});
		});
		
		$('#unit_id').change(function(){
			var unit_id=$('#unit_id').val();
			$.post('function/dynamic_dropdown/get_position_name.php',{
				unit_id:unit_id
			},
			function(output){
				$('#pos_id').html(output).show();
			});
		});
		
		
		$('#pos_id').change(function(){
			var pos_id=$('#pos_id').val();
			$.post('function/dynamic_dropdown/get_staff_name.php',{
				pos_id:pos_id
			},
			function(output){
				$('#staff_ct').html(output).show();
			});
		});
		
		
		$('#dp_id2').change(function(){
			var dp_id=$('#dp_id2').val();
			$.post('function/dynamic_dropdown/get_unit_name.php',{
				dp_id:dp_id
			},
			function(output){
				$('#unit_id2').html(output).show();
			});
		});
		
		$('#unit_id2').change(function(){
			var unit_id=$('#unit_id2').val();
			$.post('function/dynamic_dropdown/get_position_name.php',{
				unit_id:unit_id
			},
			function(output){
				$('#pos_id2').html(output).show();
			});
		});
		
		
		$('#pos_id2').change(function(){
			var pos_id=$('#pos_id2').val();
			$.post('function/dynamic_dropdown/get_staff_name.php',{
				pos_id:pos_id
			},
			function(output){
				$('#staff_ct2').html(output).show();
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
						<div class="card-block"> 
				  
							<form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data" autocomplete="off">
								  
									<?php
									 //  echo " $status_user";

									$query = $connect->prepare(" select * from profile_leave_view WHERE user_ids = :user_ids   ");  
									$query->execute(  
									array(  
									'user_ids'     =>     $user_ids  
									)  
									); 
									$row = $query->fetch();
									$status_user = $row['user_ids'];
									$staff_gender = $row['staff_gender'];
									$staff_first_name = $row['staff_first_name'];
									$staff_last_name = $row['staff_last_name'];
									$staff_code = $row['staff_code'];
									$staff_position = $row['staff_position'];
									$select_staff_depart = $row['staff_depart'];
									$staff_unit = $row['staff_unit'];  

									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                                             
											 
											
											 <div class="form-group col-md-12">
											<h1 class="card-title text-center"> ຕັ້ງຄ່າຜູ້ອານຸຍາດ </h1>
											</div>
											
											 
											
										 
								 
											
											
										 
											
										  
											
											
											<div class="col-md-6">
											<div class="form-group">
											<label class="control-label"> ຂັ້ນຕອນອານຸຍາດ <span class="text-danger">*</span></label><br>
											 
											 
											<input type="radio" name="rdLeaveType" id="rdLeaveType"   value="1" > ຜູ້ຈັດການ  
											<input type="radio" name="rdLeaveType"  id="rdLeaveType"  value="2" > ຜູ້ບໍລິຫານ
											<input type="radio" name="rdLeaveType"  id="rdLeaveType"  value="3" > ທັງສອງ
											
											</div>
											</div>
											
											<div class="col-md-12" id="result2">
											<div class="form-group">
											 
											 
											</div>
											</div>
											
											<div class=" text-center">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ສົ່ງຂໍ້ມູນ </button>
											<button type="reset" class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ຍົກເລີກ </button>
											</div>
											
                                            </div>
                                        </div>
									   </div>   
									
                                </form>
						
						 
						 
                                            
                                        </div>
											<div class="text-center" align = "center">
											
											
											</div>
									   </div>   
								
                               
								
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
	<?php
	if($show_modal != ""){
		
	
	
	?>
<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
	});
</script>
<?php

}

?>

	<div id="myModal" class="modal fade ">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
			<?php
			if ($show_modal == 1){
				?>
				 <h3 class="modal-title" style="color: green" > ເພິ່ມຂໍ້ມູນສຳເລັດ  </h3>
				<?php
			}else {
				?>
				 <h3 class="modal-title" style="color: red" > ຂໍ້ມູນບໍ່ຄົບຖ້ວນ   </h3>
				<?php
			}
			
$show_modal = "";
$message_request ="";
$_SESSION['message_request'] = "";

			?>
               
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
             
        </div>
    </div>
	
 <script>  
 $(document).ready(function(){  
      $('input[type="radio"]').click(function(){  
           var rdLeaveType = $(this).val();  
           $.ajax({  
                url:"function/radio_select/get_autherize.php",  
                method:"POST",  
                data:{rdLeaveType:rdLeaveType},  
                success:function(data){  
                     $('#result2').html(data);  
                }  
           });  
      });  
 });  
 </script>  
 





	<?php include "javascript.php";?>
</body>

</html>
