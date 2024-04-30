<?php 
include "checksession.php";
include "function/database_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php 
 
 
	  if(isset($_POST['btninsert']))
{
	
	 
		
		$dp_id = $_POST['dp_id']; 
		$Unit_name = $_POST['Unit_name'];    
		$stmt = $connect->prepare('INSERT INTO tbl_depart_unit (depart_id,unit_name )
		VALUES(:dpid, :uname )');
		$stmt->bindParam(':dpid',$dp_id);
		$stmt->bindParam(':uname',$Unit_name); 
		
		
		 
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
	  <?php
	  include "stylesheet.php"; 
	  ?>

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
					 
					 
						<h2 class="card-title text-center">ລົງທະບຽນ ຝ່າຍ </h2> 
                                <form class="m-t-40  text-center " novalidate action="" method="post" enctype="multipart/form-data"> 
								
                                    <div class="form-body ">
									 <div class="row p-t-20" id="result">
                                             
                                         <div class="col-md-3"> 
											</div>
											  
											<div class="form-group col-md-3">
											<label for="inputEmail"> ຊື່ ພະແນກ/ໜ່ວຍງານ </label>

											<select   name="dp_id"  required="" class="form-control font" aria-invalid="false">
											<option value=""> ເລືອກ ພະແນກ/ໜ່ວຍງານ </option> 
											<?php
											$stmt = $connect->prepare("SELECT depart_id,depart_name FROM tbl_depart");
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
											
											<div class="col-md-3">
											<div class="form-group">
											<label class="control-label"> ຊື່ຝ່າຍ  </label>
											<div class="controls">
											<input type="text" name="Unit_name" class="form-control font" value=""  > 
											</div> 
											</div> 
											</div>
											
										 
											    
                                            </div>
											
											<div class="">
											<button type="submit"  name="btninsert"  class="btn btn-success font"> <i class="fa fa-check"></i> ບັນທຶກ</button>
											<button type="reset" class="btn btn-danger font"><i class="mdi mdi-close-outline"></i> ຍົກເລີກ</button>
											</div>
											
                                            </div>
								</form>
                                        </div>
									   </div>   
									
                               
								
                            </div>
                            </div>
                        </div>
						
						
						<div class="container-fluid">
									<div class="row" id="row">
										<div class="col-12"> 
											<div class="card">
												<div class="card-block"> 
												<h4 class="card-title text-center"> ຂໍ້ມູນ ຝ່າຍ </h4>
												<span id="form_response"></span>
													<table id="unit_data" class="table table-bordered table-striped">
														<thead class="btn-info">
															<tr> 
															<td> ຊື່ ພະແນກ/ໜ່ວຍງານ </td>  
															<td> ຊື່ຝ່າຍ </td> 
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
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	
	<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	
 
	
 
 var dataTable = $('#unit_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_unit_all.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[2,3],
    "orderable":false,
   },
  ],

 });

 
 

 $(document).on('click', '.update', function(){
  var ei = $(this).attr('ei');
  $.ajax({
   url:"function/fetch/fetch_unit_edit_modal.php",
   method:"POST",
   data:{ei:ei},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('unname', data[0].unit_name);
	localStorage.setItem('dpid', data[0].depart_id);
 

    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/edit_unit_form.php', options)
     .title('ແກ້ໄຂ ຂໍ້ມູຸນ ຝ່າຍ')
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
		
        
        form_data.append('dpid', $('#dp_id').val()); 
		form_data.append('nameunit', $('#unit_name').val()); 
        form_data.append('unit_id', data[0].unit_id);
					  //('Name_send', values get from => data:{ei:ei}, );
		
        $.ajax({
         method:"POST",
         url:'function/edit/update_unit.php',
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
     url:"function/delete/delete_unit.php",
     method:"POST",
     data:{di:di},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ຖືກລຶບແລ້ວ</b></h3>');
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
