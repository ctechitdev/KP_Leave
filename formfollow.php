<?php
 include "checksession.php";
 include "function/database_connection.php";

 
   $check_error ="";
 

	if(isset($_POST['btninsert'])) { 

 
 
			$act_dairy = $_POST['act_dairy']; 
			$rdmyhealth = $_POST['rdmyhealth'];  
			$myhealth = $_POST['myhealth'];  
			$rdfamhealth = $_POST['rdfamhealth'];  
			$famhealth = $_POST['famhealth']; 
			$rdfamrisk = $_POST['rdfamrisk']; 
			$famrisk = $_POST['famrisk']; 
			$ddlocation = $_POST['ddlocation']; 
			$mylocation = $_POST['mylocation'];
	 
			$date_register = date("Y-m-d");
			
			 
			
			
			
			if( (empty($act_dairy)) ||  (empty($ddlocation))   ){
					$check_error  = "yes";
				}
		
		if( $check_error !="yes" ){
			 
			$stmt = $connect->prepare('INSERT INTO tbl_form_follow  (myatc,myhealth,mhdetail,famhealth,fhdetail,famrisk,frdetail,myactlocation,mtlocate_detail,regis,createby)
			VALUES(:actdr, :rdmh, :hdt, :rdfh, :fhdt,:rdfr, :frdt, :plocate, :lodt, :drd, :usid  )');
			$stmt->bindParam(':actdr',$act_dairy);
			$stmt->bindParam(':rdmh',$rdmyhealth); 
			$stmt->bindParam(':hdt',$myhealth);
			$stmt->bindParam(':rdfh',$rdfamhealth); 
			$stmt->bindParam(':fhdt',$famhealth); 
			$stmt->bindParam(':rdfr',$rdfamrisk); 
			$stmt->bindParam(':frdt',$famrisk); 
			$stmt->bindParam(':plocate',$ddlocation); 
			$stmt->bindParam(':lodt',$mylocation); 
			$stmt->bindParam(':drd',$date_register);  
			$stmt->bindParam(':usid',$user_ids);  
 
			$stmt->execute();
			
			$show_modal = 1;
			 
			
			
		} else{
			$show_modal = 2;
		}
			
			
		 
		
		 

	}


?>

<!DOCTYPE html>
<html lang="en">

 
 
 
<head>
 

   
 

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
											<h1 class="card-title text-center"> ແບບສອບຖາມການເຄື່ອນໄຫວຂອງພະນັກງານ ປະຈໍາວັນ </h2>
											</div>
                                         
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
											<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ :  </label> <label for="inputEmail"> <?php echo "$select_staff_depart  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"> <?php echo "$staff_unit  ";?> </label>
											</div>
											 
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ການເຄື່ອນໄຫວຂອງພະນັກງານ ໃນມື້ນີ້  </label> 
											<select class="form-control font" name="act_dairy" id ="act_dairy"  >
											<option value=""> ເລືອກ ການເຄື່ອນໄຫວ </option>
											<option value="ມາປະຈໍາການ"> ມາປະຈໍາການ </option>
											<option value="ເຮັດວຽກຢູ່ເຮືອນ (WFH)"> ເຮັດວຽກຢູ່ເຮືອນ (WFH) </option>
											<option value="ລາພັກ"> ລາພັກ </option>
											<option value="ຢູ່ໃນໄລຍະກັກໂຕ"> ຢູ່ໃນໄລຍະກັກໂຕ </option>
											 
											</select>
											</div>
											
											<div class="form-group col-md-6">
											</div>
											 
											
											
											
											
											<div class="col-md-6">
											<div class="form-group">
											<label class="control-label"> ສຸກຂະພາບຂອງທ່ານ ໃນມື້ນີ້ ເປັນແນວໃດ <span class="text-danger">*</span></label><br>
											 
											 
											<input type="radio" name="rdmyhealth" id="rdmyhealth"   value="ສະບາຍດີ" >  ສະບາຍດີ
											<input type="radio" name="rdmyhealth"  id="rdmyhealth"  value="ບໍ່ສະບາຍ" >  ບໍ່ສະບາຍ
											
											</div>
											</div> 
											
											<div class="form-group col-md-6" >
											<div class="form-group">
											<label class="control-label"> ລະບຸອາການ (ຖ້າມີ) </label>
											<div class="controls">
											<input type="text" name="myhealth" class="form-control font" value=""   > 
											</div> 
											</div>  
											</div>
											
											
											
											<div class="col-md-6">
											<div class="form-group">
											<label class="control-label"> ຄອບຄົວຂອງທ່ານ ທີ່ອາໄສໃນບ້ານດຽວກັນ ສຸກຂະພາບ ໃນມື້ນີ້ ເປັນແນວໃດ <span class="text-danger">*</span></label><br> 
											<input type="radio" name="rdfamhealth" id="rdfamhealth"   value="ສະບາຍດີ" >  ສະບາຍດີ  
											<input type="radio" name="rdfamhealth"  id="rdfamhealth"  value="ບໍ່ສະບາຍ" >  ບໍ່ສະບາຍ 
											</div>
											</div>
											
											<div class="form-group col-md-6" >
											<div class="form-group">
											<label class="control-label"> ລະບຸ ໃຜມີອາການບໍ່ສະບາຍ ແລະ ມີອາການແນວໃດ (ຖ້າມີ)  </label>
											<div class="controls">
											<input type="text" name="famhealth" class="form-control font" value=""   > 
											</div> 
											</div>  
											</div>
											
											
											<div class="col-md-6">
											<div class="form-group">
											<label class="control-label"> ຄອນຄົວຂອງທ່ານ ທີ່ອາໄສໃນບ້ານດຽວກັນ ມີໃຜເປັນກຸ່ມສ່ຽງ ຫຼື ໄດ້ສໍາພັດກັບກຸ່ມສ່ຽງໃດ ຫຼືບໍ່ <span class="text-danger">*</span></label><br> 
											<input type="radio" name="rdfamrisk" id="rdfamrisk"   value="ບໍ່ມີ" >  ບໍ່ມີ  
											<input type="radio" name="rdfamrisk"  id="rdfamrisk"  value="ມີ" > ມີ
											</div>
											</div>
											
											<div class="form-group col-md-6" >
											<div class="form-group">
											<label class="control-label"> ລະບຸ ແມ່ນໃຜ ແລະ ມີລາຍລະອຽດແນວໃດ  </label>
											<div class="controls">
											<textarea type="text" name="famrisk" class="form-control font" value=""   > </textarea>
											</div> 
											</div>  
											</div>
											
											
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ການເຄື່ອນໄຫວຂອງພະນັກງານ ໃນມື້ນີ້  </label> 
											<select class="form-control font" name="ddlocation" id ="ddlocation"  >
											<option value=""> ເລືອກ ການເຄື່ອນໄຫວ </option>
											<option value="ຢູ່ບ້ານບໍ່ໄດ້ອອກໄປໃສ"> ຢູ່ບ້ານບໍ່ໄດ້ອອກໄປໃສ </option>
											<option value="ມາການ ແລ້ວກັບບ້ານ ບໍ່ໄດ້ແວະໃສ"> ມາການ ແລ້ວກັບບ້ານ ບໍ່ໄດ້ແວະໃສ </option>
											<option value="ໄປທະນາຄານ"> ໄປທະນາຄານ </option>
											<option value="ໄປຕະຫຼາດ"> ໄປຕະຫຼາດ </option>
											<option value="ໄປຮ້ານອາຫານ"> ໄປຮ້ານອາຫານ </option>
											<option value="ໄປໂຮງໝໍ"> ໄປໂຮງໝໍ </option>
											<option value="ອື່ນໆ"> ອື່ນໆ </option> 
											 
											</select>
											</div>
											
											<div class="form-group col-md-6" >
											<div class="form-group">
											<label class="control-label"> ສະຖານທີ່  </label>
											<div class="controls">
											<input type="text" name="mylocation" class="form-control font" value=""   > 
											</div> 
											</div>  
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
											 
									   </div>   
								
                               
								
                            </div>
                            
                            <div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
				  
				  
							<div class="card">
							<div class="card-block">
							 
								<h4 class="card-title text-center"> ຂໍ້ມູນ Timeline </h4>
								<div class="table-responsive">
									<table id='demo-foo-addrow2' class='table ' >
                                    <td>ເລກທີ</td>
									<td>ປະເພດເຄື່ອນໄຫວ</td> 
									<td> ສຸຂະພາບ</td> 
									<td> ສຸຂະພາບ ຄອບຄົວ </td> 
									<td> ຄວາມສຽງ ຂອງຄອບຄົວ </td> 
									<td> ສະຖານທີເຄື່ອນໄຫວ </td> 
									<td> ວັນທີ່ລົງທະບຽນ </td>  
									
							 
									 
                                    <tbody>
									 <?PHP
							
										$stmt = $connect->prepare(" select * from tbl_form_follow where createby ='$user_ids' ");
										
										$stmt->execute();
										if($stmt->rowCount() > 0)
										{
										while($row=$stmt->fetch(PDO::FETCH_ASSOC))
										{
											
										 	
										$ffid = $row['ffid']; 
										$myatc = $row['myatc']; 
										$myhealth = $row['myhealth'];  
										$mhdetail = $row['mhdetail']; 
										$famhealth = $row['famhealth']; 
										$fhdetail = $row['fhdetail']; 
										$famrisk = $row['famrisk'];
										$frdetail = $row['frdetail'];
										$myactlocation = $row['myactlocation'];
										$mtlocate_detail = $row['mtlocate_detail'];
										$regis = $row['regis'];
									 
										?>

										<tr>   
									 
										<td class = 'tdr' ><?php echo "$ffid";?></td>
										<td class = 'tdr' ><?php echo "$myatc";?></td>
										<td class = 'tdr' ><?php echo "$myhealth $mhdetail";?></td> 
										<td class = 'tdr' ><?php echo "$famhealth $fhdetail";?></td> 
										<td class = 'tdr' ><?php echo "$famrisk $frdetail";?></td> 
										<td class = 'tdr' ><?php echo "$myactlocation $mtlocate_detail";?></td> 
										<td class = 'tdr' ><?php echo "$regis";?></td>


										 

										</tr>

										<?php
									 
											}
											}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
								</div>
								
 
								
								
								
								</div>
							</div>
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
				 <h3 class="modal-title" style="color: green" > ການລົງທະບຽນ ສຳເລັດ  </h3>
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
 
 





	<?php include "javascript.php";?>
</body>

</html>
