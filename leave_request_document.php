<?php
include "checksession.php";
include "function/database_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "stylesheet.php";?>
<?php

include"connect.php";
 
 
	  if(isset($_POST['btninsert']))
{
	
		$leaver_id =$_GET['STID']; 
		$leave_type = $_POST['leave_type']; 
		$approver_mg = $_POST['approver_id']; 
		$approver_dr = $_POST['boss_id'];
		$approver_hr = $_POST['ap_hr'];
		
		$leave_day = $_POST['leave_day'];    
		$leave_hour = $_POST['leave_hour']; 
		$leave_minus = $_POST['leave_minus'];
		$date_from = $_POST['date_from']; 
		$hour_from = $_POST['hour_from']; 
		$date_to = $_POST['date_to']; 
		$hour_to = $_POST['hour_to']; 
		$reason_leave = $_POST['reason_leave'];  
		$date_request = date("Y-m-d");
		
		
		
		$ATTACH_DOC = $_POST['ATTACH_DOC'];  
		
		
		//product picture
 
		// end 
		 
	 
	
	 
		
			// valid image extensions
		 
			// rename uploading image
	 

		 
			
			 
		 
		$stmt = $connect->prepare('INSERT INTO tbl_leave_request_document (staff_id,approver_manager,approver_director,approver_hr,leave_type,date_leave,hours_leave,date_from,time_from,date_to,time_to,reason,attatch_file,date_request  )
		VALUES(:uid, :apmg, :apdr,:aphr, :ltype, :lday, :lhour,:lminus, :dfrom, :hfrom, :dto, :hto, :rleave,:atc, :drl )');
		$stmt->bindParam(':uid',$leaver_id);
		$stmt->bindParam(':apmg',$approver_mg);
		$stmt->bindParam(':apdr',$approver_dr); 
		$stmt->bindParam(':aphr',$approver_hr);  
		$stmt->bindParam(':ltype',$leave_type);
		$stmt->bindParam(':lday',$leave_day); 
		$stmt->bindParam(':lhour',$leave_hour); 
		$stmt->bindParam(':lminus',$leave_minus); 
		$stmt->bindParam(':dfrom',$date_from); 
		$stmt->bindParam(':hfrom',$hour_from); 
		$stmt->bindParam(':dto',$date_to); 
		$stmt->bindParam(':hto',$hour_to); 
		$stmt->bindParam(':rleave',$reason_leave); 
		$stmt->bindParam(':atc',$ATTACH_DOC); 
		$stmt->bindParam(':drl',$date_request);
		 
 if($stmt->execute())
{
	 
	
	 ?>
           	<script type="text/javascript">
			$(window).on('load',function(){
				$('#success').modal('show');
			});
		</script>
		<?PHP
		header("Refresh:1;");
        }else{
			?>
           	<script type="text/javascript">
			$(window).on('load',function(){
				$('#Errer').modal('show');
			});
		</script>
		<?PHP
				}
			 
 
				
			}
	
	  
	  ?>
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
		
		$('#dp_id_boss').change(function(){
			var dp_id_boss=$('#dp_id_boss').val();
			$.post('get_unit_name_boss.php',{
				dp_id_boss:dp_id_boss
			},
			function(output){
				$('#unit_id_boss').html(output).show();
			});
		});
		
		$('#unit_id_boss').change(function(){
			var unit_id_boss=$('#unit_id_boss').val();
			$.post('get_position_boss.php',{
				unit_id_boss:unit_id_boss
			},
			function(output){
				$('#pos_id_boss').html(output).show();
			});
		});
		
		$('#pos_id_boss').change(function(){
			var pos_id_boss=$('#pos_id_boss').val();
			$.post('get_boss_name.php',{
				pos_id_boss:pos_id_boss
			},
			function(output){
				$('#boss_id').html(output).show();
			});
		});
		
		
		});
	</script>



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
					 <?php
					 
					// echo "$leaver_id";
					 
					 ?>
					 
						<h2 class="card-title text-center">ລົງທະບຽນ ຂໍລາພັກ </h2>
						 
						
						  
                                <form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data">
								
									<?php

									$query = $connect->prepare(" select * from profile_leave_view WHERE staff_id = :user_ids   ");  
									$query->execute(  
									array(  
									'user_ids'     =>     $_GET['STID'] 
									)  
									); 
									$row = $query->fetch();
									$stl_id = $row['staff_id'];
									$staff_gender = $row['staff_gender'];
									$staff_first_name = $row['staff_first_name'];
									$staff_last_name = $row['staff_last_name'];
									$staff_code = $row['staff_code'];
									$staff_position = $row['staff_position'];
									$staff_depart = $row['staff_depart'];
									$staff_unit = $row['staff_unit']; 
									$boss_first_name = $row['boss_first_name'];
									$boss_last_name = $row['boss_last_name'];
									$boss_gender = $row['boss_gender'];

									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                                             <input type="hidden" name="staff_user_id"  placeholder="ເວລາ" class="form-control font" value="<?php echo "$stl_id"; ?>" >
                                         
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
											<label for="inputEmail"> ພະແນກ :  </label> <label for="inputEmail"> <?php echo "$staff_depart  ";?> </label>
											</div>
											<div class="form-group col-md-4">
											<label for="inputEmail"> ຝ່າຍ :  </label> <label for="inputEmail"> <?php echo "$staff_unit  ";?> </label>
											</div>
											
											

											 
											
											<div class="form-group col-md-6">
											<label for="inputEmail"> ປະເພດລາພັກ </label>

											<select   name="leave_type"  required="" class="form-control font" aria-invalid="false">
											<option value=""> ເລືອກປະເພດລາພັກ </option> 
											<?php
											$stmt = $connect->prepare("SELECT lt_id,leave_name FROM tbl_leave_type");
											$stmt->execute();
											if($stmt->rowCount() > 0)
											{
											while($row=$stmt->fetch(PDO::FETCH_ASSOC))
											{
											?> <option value="<?php echo $row['lt_id']; ?>"> <?php echo $row['leave_name']; ?></option> 
											<?php   
											}
											}
											?>
											</select>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label">ຈຳນວນວັນລາ</label>
											<div class="controls">
											<input type="text"name = "leave_day" placeholder="ຈຳນວນວັນລາ" class="form-control font" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="ລະຫັດເຄື່ອງ ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ"> </div> </div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label">ຈຳນວນຊົວໂມງລາ</label>
											<div class="controls">
											<input type="text" name="leave_hour" placeholder="ຈຳນວນຊົວໂມງລາ" class="form-control font" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="ລະຫັດເຄື່ອງ ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ"> </div> </div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label">ຈຳນວນນາທີລາ</label>
											<div class="controls">
											<input type="text" name="leave_minus" placeholder="ຈຳນວນຊົວໂມງລາ" class="form-control font" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="ລະຫັດເຄື່ອງ ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ"> </div> </div>
											</div>
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label">ຈາກວັນທີ</label>
											<div class="controls">
											<input type="date" name="date_from"   placeholder="ຈາກວັນທີ" class="form-control font" > </div> </div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label">ເວລາ</label>
											<div class="controls">
											<input type="time" name="hour_from"  placeholder="ເວລາ" class="form-control font" > </div> </div>
											</div>
											
											
											<div class="col-md-4">
											<div class="form-group">
											<label class="control-label">ຫາວັນທີ</label>
											<div class="controls">
											<input type="date" name="date_to" id="date_to" placeholder="ຫາວັນທີ" class="form-control font" > </div> </div>
											</div>
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label">ເວລາ</label>
											<div class="controls">
											<input type="time" name="hour_to" placeholder="ເວລາ" class="form-control font" > </div> </div>
											</div>
					
					  
											
											<div class="col-md-2">
											<div class="form-group">
											<label class="control-label"> ເອກະສານຕິດຂັດ <span class="text-danger"></span></label><br>
											<div class="btn-group" data-toggle="buttons" role="group">
											
											<label class="btn btn-outline btn-secondary " aria-pressed="true">
											<input type="radio" name="ATTACH_DOC"  id="ATTACH_DOC" autocomplete="false" value="N"   >
											<i class="ti-check text-active  text-success" aria-hidden="true"></i> ບໍ່ມີເອກະສານ
											</label>
											
											
											<label class="btn btn-outline btn-secondary" aria-pressed="true">
											<input type="radio" name="ATTACH_DOC" id="ATTACH_DOC" autocomplete="off" value="Y">
											<i class="ti-check text-active text-success" aria-hidden="true"></i> ມີເອກະສານ 
											</label>
											
											 
											</div>
											</div>
											</div>
											
											<div class="col-md-12">
											<div class="form-group">
											<label class="control-label"> ເຫດຜົນ  </label>
											<div class="controls">
											<input type="text" name="reason_leave" class="form-control font" value=""  > 
											</div> 
											</div> 
											</div>
											
											<div class="col-md-12 text-center">
											<div class="form-group">
											<label class="control-label"> ຜູ້ຈັດການ  </label>
											 
											</div> 
											</div>
											
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ພະແນກ  </label> 
											<select class="form-control font" name="dp_id" id ="dp_id">
											<option value=""> ເລືອກພະແນກ </option> 
											<?php
											$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
											$stmt->execute();
											if($stmt->rowCount() > 0)
											{
											while($row=$stmt->fetch(PDO::FETCH_ASSOC))
											{
											?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option> 
											<?php   
											}
											}
											?>
											</select>
											</div>

											<div class="form-group col-md-3">
											<label for="inputEmail"> ຝ່າຍ  </label>

											<select class="form-control font" name="unit_id" id ="unit_id">
											<option value=""> ເລືອກ ຝ່າຍ </option> 
											</select>
											</div>

											<div class="form-group col-md-3">
											<label for="inputEmail"> ຕຳແໜ່ງ  </label>

											<select class="form-control font" name="pos_id" id ="pos_id">
											<option value=""> ເລືອກ ຕຳແໜ່ງ </option> 
											</select>
											</div>
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ຊື່ຜູ່ອານຸຍາດ   </label> 
											<select class="form-control font" name="approver_id" id ="approver_id">
											<option value=""> ເລືອກ ຊື່ຜູ່ອານຸຍາດ </option> 
											</select>
											</div>
											
											
											<div class="col-md-12 text-center">
											<div class="form-group">
											<label class="control-label"> ອຳນວຍການ/ຮອງປະທານ  </label>
											 
											</div> 
											</div>
											
											<div class="form-group col-md-3">
											<label for="inputEmail"> ພະແນກ (ຫົວໜ້າ) </label>

											<select class="form-control font" name="dp_id_boss" id ="dp_id_boss">
											<option value=""> ເລືອກພະແນກ </option> 
											<?php
											$stmt = $connect->prepare(" SELECT depart_id,depart_name FROM tbl_depart ");
											$stmt->execute();
											if($stmt->rowCount() > 0)
											{
											while($row=$stmt->fetch(PDO::FETCH_ASSOC))
											{
											?> <option value="<?php echo $row['depart_id']; ?>"> <?php echo $row['depart_name']; ?></option> 
											<?php   
											}
											}
											?>
											</select>
											</div>

											<div class="form-group col-md-3">
											<label for="inputEmail"> ຝ່າຍ (ຫົວໜ້າ) </label>

											<select class="form-control font" name="unit_id_boss" id ="unit_id_boss">
											<option value=""> ເລືອກ ຝ່າຍ </option> 
											</select>
											</div>

											<div class="form-group col-md-3">
											<label for="inputEmail"> ຕຳແໜ່ງ (ຫົວໜ້າ) </label> 
											<select class="form-control font" name="pos_id_boss" id ="pos_id_boss">
											<option value=""> ເລືອກ ຕຳແໜ່ງ </option> 
											</select>
											</div>


											<div class="form-group col-md-3">
											<label for="inputEmail"> ຫົວໜ້າ (ຫົວໜ້າ) </label> 
											<select class="form-control font" name="boss_id" id ="boss_id">
											<option value=""> ເລືອກ ຫົວໜ້າ </option> 
											</select>
											</div>
											
											
											<div class="col-md-4 text-center">
											 
											</div>
											
											<div class="form-group col-md-3 text-center">
											<label for="inputEmail"> ຝ່າຍຊັບພະຍາກອນມະນຸດ </label>

											<select class="form-control font" name="ap_hr" id ="ap_hr">
											<option value=""> ເລືອກພະແນກ </option> 
											<?php
											$stmt = $connect->prepare(" SELECT staff_id,CONCAT( staff_first_name, ' ', staff_last_name) AS FULL_NAME 
												FROM tbl_staff a
												left join tbl_role_level b on a.staff_position = b.ps_id
												where role_level != 1 and staff_depart = 5 ");
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
											</div>
										   
                                            </div>
											
											<div class="">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ບັນທຶກ</button>
											<button type="reset" class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ຍົກເລີກ</button>
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
							 
								<h4 class="card-title text-center">ລາຍການຂໍລາພັກ</h4>
							<table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr>
							<th scope="col"  >ເລກທີ</th>
							<th scope="col"  > ຜູ່ອານຸຍາດ </th>
							<th scope="col"  > ເຫດຜົນລາ </th> 
							<th scope="col"  > ຈາກວັນທີ </th>  
							<th scope="col"  > ຫາວັນທີ </th> 
							<th scope="col"  > ຂໍຜ່ານທາງ </th>
							</tr>
							</thead>
										<div class='m-t-40'>
										<?php
										 
									// echo "$COUNT_DEVICE";		
									
										?>
                                        <div class='d-flex'>
                                            <div class='mr-auto'>  
											<div class='form-group'>
                                             
                                            </div>
                                        </div>
                                            <div class='ml-auto'>
                                                <div class='form-group'>
												
                                                    <input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
                                                </div>
                                                </div>
                                    </div>
                                    </div>
                                    <tbody>
									 <?PHP
							
							$stmt = $connect->prepare(" 
							select lr_id,a.user_ids as user_ids,reason,date_from,date_to,
							concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
							'ຜ່ານລະບົບ' as rq_type
							from tbl_leave_request a
							left join tbl_user b on a.user_ids = b.user_ids
							left join tbl_staff c on b.staff_id = c.staff_id
							where b.staff_id = :user_ids
							union all
							select lrd_id,a.staff_id as staff_id,reason,date_from,date_to,
							concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
							'ຜ່ານເອກະສານ' as rq_type
							from tbl_leave_request_document a 
							left join tbl_staff b on a.staff_id = b.staff_id
							where a.staff_id = :user_ids 
							");
							
							$stmt->execute(  
									array(  
									'user_ids'     =>     $_GET['STID'] 
									)  
									);  
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						$lr_id = $row['lr_id']; 
						$full_name = $row['requester_full_name']; 
						$reason = $row['reason']; 
						$date_from = $row['date_from']; 
						$date_to = $row['date_to'];
						$rq_type = $row['rq_type'];
						
						 
							?>

							<tr>  
							<td><?php echo "$lr_id";?></td>
							<td><?php echo "$full_name";?></td>
							<td><?php echo "$reason";?></td> 
							<td><?php echo "$date_from";?></td>  
							<td><?php echo "$date_to";?></td>
							<td><?php echo "$rq_type";?></td>


							</td>

							</tr>

							<?php
						 
								}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="7">
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
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	<?php include "javascript.php";?>
</body>

</html>
