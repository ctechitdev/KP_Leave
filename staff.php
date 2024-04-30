<?php 
include "checksession.php"; 
 
include "function/database_connection.php";
 
 
	  if(isset($_POST['btninsert']))
{ 
	$staff_code = $_POST['staff_code']; 
	$First_name = $_POST['First_name'];
	$Last_name = $_POST['Last_name'];
	$Gender = $_POST['Gender'];
	$pos_id = $_POST['pos_id'];
	$dp_id = $_POST['dp_id'];
	$unit_id = $_POST['unit_id'];
	$E_Mail = $_POST['E_Mail'];
	$date_request = date("Y-m-d");
	

	$password ='123';
	$user_status = 1;
		
		 
		 
			$stmt = $connect->prepare('INSERT INTO tbl_staff 
			( staff_code,staff_first_name,staff_last_name,staff_gender,staff_position,staff_depart,staff_unit,regis_date  )
			VALUES(:stcode, :fname,:lname, :gen, :pos, :dpid, :uid,   :drq )');
 

			$stmt->bindParam(':stcode',$staff_code);
			$stmt->bindParam(':fname',$First_name);
			$stmt->bindParam(':lname',$Last_name);
			$stmt->bindParam(':gen',$Gender); 
			$stmt->bindParam(':pos',$pos_id); 
			$stmt->bindParam(':dpid',$dp_id); 
			$stmt->bindParam(':uid',$unit_id);  
			$stmt->bindParam(':drq',$date_request);   
			$stmt->execute();
			
			
		  	 
				
				 
				
			}
	
	  
	  ?>

<!DOCTYPE html>
<html lang="en"> 
 <head>
   
<?php include "stylesheet.php";?>
	 
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
		
		
		});
	</script>

  </head>


<script src="js/jquery.Tables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script> 
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> 
<script src="js/dialogify.min.js"></script>

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
                        <div class="card "> 
						<div class="card-block ">
					 
					 
						<h2 class="card-title text-center">ລົງທະບຽນ ພະນັກງານ </h2>
						 
						
						  
                                <form class="m-t-40  text-center " novalidate action="" method="post" enctype="multipart/form-data">
								
								  
									<div class="form-body ">
									<div class="row p-t-20" id="result">
									
									<div class="col-md-4">
									<div class="form-group">
									<label class="control-label"> ຊື່  </label>
									<div class="controls">
									<input type="text" name="First_name" class="form-control font" value=""  > 
									</div> 
									</div> 
									</div>
									
									<div class="col-md-4">
									<div class="form-group">
									<label class="control-label"> ນາມສະກຸນ  </label>
									<div class="controls">
									<input type="text" name="Last_name" class="form-control font" value=""  > 
									</div> 
									</div> 
									</div>
									
									<div class="col-md-4">
									<div class="form-group">
									<label class="control-label"> ເລກພະນັກງານ  </label>
									<div class="controls">
									<input type="text" name="staff_code" placeholder="ເລກພະນັກງານ" class="form-control font" required data-validation-containsnumber-regex="(\d)+" data-validation-containsnumber-message="ເລກພະນັກງານ ຕ້ອງເປັນຕົວເລກເທົ່ານັ້ນ">
									 
									</div> 
									</div> 
									</div>
									 
									<div class="col-md-2">
									<div class="form-group">
									<label class="control-label">ເພດ <span class="text-danger">*</span></label><br>
									<div class="btn-group" data-toggle="buttons" role="group">
									<label class="btn btn-outline btn-secondary active" aria-pressed="true">
									<input type="radio" name="Gender" id="Gender" autocomplete="off" value="1" checked="">
									<i class="ti-check text-active text-success" aria-hidden="true"></i> ເພດຊາຍ 
									</label>
									<label class="btn btn-outline btn-secondary" aria-pressed="true">
									<input type="radio" name="Gender"  id="Gender" autocomplete="false" value="2" >
									<i class="ti-check text-active  text-success" aria-hidden="true"></i>ເພດຍິງ
									</label>
									</div>
									</div>
									</div>
									
									<div class="col-md-2">
									 
									</div>
									
									 
									
									<div class="col-md-8">
									 
									</div>
									
									<div class="form-group col-md-4">
									<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ  </label> 
									<select class="form-control font" name="dp_id" id ="dp_id">
									<option value=""> ເລືອກ ພະແນກ/ໜ່ວຍງານ </option> 
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
									
									<div class="form-group col-md-4">
									<label for="inputEmail"> ຝ່າຍ  </label>

									<select class="form-control font" name="unit_id" id ="unit_id">
									<option value=""> ເລືອກ ຝ່າຍ </option> 
									</select>
									</div>
									
									<div class="form-group col-md-4">
									<label for="inputEmail"> ຕຳແໜ່ງ  </label>

									<select class="form-control font" name="pos_id" id ="pos_id">
									<option value=""> ເລືອກ ຕຳແໜ່ງ </option> 
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
							
								<div class="container-fluid">
									<div class="row" id="row">
										<div class="col-12"> 
											<div class="card">
												<div class="card-block"> 
												<h4 class="card-title text-center"> ຂໍ້ມູນພະນັກງານ </h4>
												<span id="form_response"></span>
													<table id="staff_data" class="table table-bordered table-striped">
														<thead class="btn-info text-center">
															<tr > 
															<td > ລະຫັດພ/ງ </td>  
															<td class="td-staff-name" > ຊື່ ນາມສະກຸນ </td>
															<td class="td-posotion" > ຕຳແໜ່ງ </td> 
															<td class="td-depart"> ພະແນກ/ໜ່ວຍງານ </td>
															<td> ຝ່າຍ</td> 
															<td></td>
															<td> </td>
															</tr>
														</thead>
													</table> 
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
	
<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	
  
 var dataTable = $('#staff_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_staff_all.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[5,6],
    "orderable":false,
   },
  ],

 });

 
 

 $(document).on('click', '.update', function(){
  var ei = $(this).attr('ei');
  $.ajax({
   url:"function/fetch/fetch_staff_edit_modal.php",
   method:"POST",
   data:{ei:ei},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('edit_cp', data[0].staff_code);
	localStorage.setItem('edit_gender', data[0].staff_gender);
	localStorage.setItem('edit_first_name', data[0].staff_first_name);
	localStorage.setItem('edit_last_name', data[0].staff_last_name);
	localStorage.setItem('edit_depart', data[0].staff_depart);
	localStorage.setItem('edit_unit', data[0].staff_unit);
	localStorage.setItem('edit_position', data[0].staff_position);

	
 
    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/edit_staff_form.php', options)
     .title('ແກ້ໄຂ ຂໍ້ມູຸນ ພະນັກງານ')
     .buttons([
      {
       text:'ຍົກເລີກ',
       click:function(e){
        this.close();
       }
      },
      {
       text:'ແກ້ໄຂ',
       type:Dialogify.BUTTON_PRIMARY,
       click:function(e)
       {
    
        var form_data = new FormData();
		
        form_data.append('cpcode', $('#cp_code').val()); 
        form_data.append('gen', $('#gender').val()); 
		form_data.append('fname', $('#first_name').val()); 
		form_data.append('lname', $('#last_name').val()); 
        form_data.append('dpid', $('#edit_dp_id').val()); 
		form_data.append('unid', $('#edit_unit_id').val());
		form_data.append('psid', $('#edit_post_id').val());
        form_data.append('s_id', data[0].staff_id);
					  //('Name_send', values get from => data:{ei:ei}, );
  
		
        $.ajax({
         method:"POST",
         url:'function/edit/update_staff_info.php',
         data:form_data,
         dataType:'json',
         contentType:false,
         cache:false,
         processData:false,
         success:function(data)
         {
          if(data.error != '')
          {
           $('#form_response').html('<div class="alert alert-danger">'+data.error+'</div>');
          }
          else
          {
           $('#form_response').html('<div class="alert alert-success">'+data.success+'</div>');
           dataTable.ajax.reload();
          }
         }
        });
       }
      }
     ]).showModal();
   }
  })
 });

//  $(document).on('click', '.delete', function(){
//   var di = $(this).attr('di');
//   Dialogify.confirm("<h3 class='text-danger'><b> ແນ່ໃຈແລ້ວບໍຈະລືບລາຍການນີ້ ?</b></h3>", {
//    ok:function(){
//     $.ajax({
//      url:"function/delete/delete_staff_info.php",
//      method:"POST",
//      data:{di:di},
//      success:function(data)
//      {
//       Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ພະນັກງານ ຖືກລຶບແລ້ວ</b></h3>');
//       dataTable.ajax.reload();
//      }
//     })
//    },
//    cancel:function(){
//     this.close();
//    }
//   });
//  });
 
 
});
</script>	
	
<?php include "javascript.php";?>
</body>

</html>
