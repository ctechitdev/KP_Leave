<?php 
include "checksession.php";
 
include "function/database_connection.php";
  
 
 
	  if(isset($_POST['btninsert']))
{ 

	$pos_id = $_POST['pos_id'];
	$role_level = $_POST['role_level']; 
	$date_request = date("Y-m-d");
	
 
		 
		 
			$stmt = $connect->prepare('INSERT INTO tbl_role_level ( ps_id,role_level,date_register )
			VALUES( :pos, :rol, :drq )');
 
 
			$stmt->bindParam(':pos',$pos_id);  
			$stmt->bindParam(':rol',$role_level); 
			$stmt->bindParam(':drq',$date_request);   
			 
			 
		  
 if($stmt->execute())
{
	 ?>
           	<script type="text/javascript">
			$(window).on('load',function(){
				$('#success').modal('show');
			});
		</script>
		<?PHP
		 
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
		
		
		});
	</script>

  </head>
  
<?php include "stylesheet.php";?>

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
					 
					 
						<h2 class="card-title text-center"> ຈັດການລະດັບຄຳຂໍລາພັກ </h2>
						 
						
						  
                                <form class="m-t-40  text-center " novalidate action="" method="post" enctype="multipart/form-data">
								
								  
									<div class="form-body ">
									<div class="row p-t-20" id="result">
								   
								 
									 
								 
								 
									
									<div class="form-group col-md-3">
									<label for="inputEmail"> ພະແນກ/ໜ່ວຍງານ </label> 
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
									<label for="inputEmail"> ລະດັບ  </label>

									<select class="form-control font" name="role_level" id ="role_level">
									<option value=""> ເລືອກ ລະດັບ </option>  
									<option value="1"> Level 1 </option> 
									<option value="2"> Level 2 </option>
									<option value="3"> Level 3 </option>
									<option value="4"> Level 4 </option>
									<option value="5"> Level 5 </option>
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
												<h4 class="card-title text-center"> ຂໍ້ມູນ ຜູ່ໃຊ້ </h4>
												<span id="form_response"></span>
													<table id="level_role" class="table table-bordered table-striped">
														<thead class="btn-info">
															<tr> 
															<td> ຊື່ ພະແນກ/ໜ່ວຍງານ </td>  
															<td> ຊື່ ຝ່າຍ </td>  
															<td> ຊື່ ຕຳແໜ່ງ </td>  
															<td> ລະດັບອານຸຍາດ </td>   
															<td></td>
															<td></td> 
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
	
  
 var dataTable = $('#level_role').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_role_level_all.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[4,5],
    "orderable":false,
   },
  ],

 });


 

 $(document).on('click', '.regis', function(){
  var ri = $(this).attr('ri');
  $.ajax({
   url:"function/fetch/fetch_role_level_id_modal.php",
   method:"POST",
   data:{ri:ri},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('ps_name', data[0].position_name);  
	

	
<!--	localStorage.setItem('edit_unit_name', data[0].unit_name); --!>

<!--	localStorage.setItem('edit_depart_name', data[0].depart_name); --!>
 
 
    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/add_role_level_form.php', options)
     .title('ເພີ່ມ ຂໍ້ມູຸນ ລະດັບ')
     .buttons([
      {
       text:'ຍົກເລີກ',
       click:function(e){
        this.close();
       }
      },
      {
       text:'ເພີ່ມ',
       type:Dialogify.BUTTON_PRIMARY,
       click:function(e)
       {
    
        var form_data = new FormData();
		
        
		form_data.append('lvid', $('#lv_id').val());  
        form_data.append('id_ps', data[0].ps_id);
					  //('Name_send', values get from => data:{ei:ei}, );
  
		
        $.ajax({
         method:"POST",
         url:'function/add/add_role_level.php',
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
 
 $(document).on('click', '.edit', function(){
  var ei = $(this).attr('ei');
  $.ajax({
   url:"function/fetch/fetch_role_level_edit_modal.php",
   method:"POST",
   data:{ei:ei},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('level_post_name', data[0].position_name);
	localStorage.setItem('val_level', data[0].role_level); 
	
<!--	localStorage.setItem('edit_unit_name', data[0].unit_name); --!>

<!--	localStorage.setItem('edit_depart_name', data[0].depart_name); --!>
 
 
    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/edit_role_level_form.php', options)
     .title('ແກ້ໄຂ ລະດັບ')
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
		
        form_data.append('plevel', $('#p_lv').val());   
        form_data.append('rlv_id', data[0].rlv_id);
					  //('Name_send', values get from => data:{ei:ei}, );
		
        $.ajax({
         method:"POST",
         url:'function/edit/update_roles_level.php',
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

 $(document).on('click', '.delete', function(){
  var di = $(this).attr('di');
  Dialogify.confirm("<h3 class='text-danger'><b> ແນ່ໃຈແລ້ວບໍຈະລືບລາຍການນີ້ ?</b></h3>", {
   ok:function(){
    $.ajax({
     url:"function/delete/delete_level.php",
     method:"POST",
     data:{di:di},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ລະດັບ ຖືກລຶບແລ້ວ</b></h3>');
      dataTable.ajax.reload();
     }
    })
   },
   cancel:function(){
    this.close();
   }
  });
 });
  
 
});
</script>
	
	
<?php include "javascript.php";?>
</body>

</html>
