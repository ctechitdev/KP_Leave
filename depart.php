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
	
	 
		
	 $Depart_name = $_POST['Depart_name'];
		 
		 
		$stmt = $connect->prepare('INSERT INTO tbl_depart (depart_name )
			VALUES( :dpname )'); 
			$stmt->bindParam(':dpname',$Depart_name); 
		 
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
					 
					 
						<h2 class="card-title text-center">ລົງທະບຽນ ພະແນກ/ໜ່ວຍງານ </h2>
						 
						
						  
                                <form class="m-t-40  text-center " novalidate action="" method="post" enctype="multipart/form-data">
								
								 
								
                                    <div class="form-body ">
									 <div class="row p-t-20" id="result">
                                             
                                         <div class="col-md-5"> 
											</div>
											  
											
											<div class="col-md-2 ">
											<div class="form-group">
											<label class="control-label"> ຊື່ ພະແນກ/ໜ່ວຍງານ  </label>
											<div class="controls">
											<input type="text" name="Depart_name" class="form-control font" value=""  > 
											</div> 
											</div> 
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
							 
								<h4 class="card-title text-center"> ຂໍ້ມູນ ພະແນກ/ໜ່ວຍງານ </h4>
								<span id="form_response"></span> 
								<div class="panel panel-default">

									<div class="panel-body">


										<table id="depart_data" class="table table-bordered table-striped">
										<thead class="btn-info">
										<tr>

										<td> ຊື່ ພະແນກ/ໜ່ວຍງານ </td>  
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
							
							
							
							
                </div>
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
    </div>
	<script type="text/javascript" language="javascript" >
$(document).ready(function(){
	
 
	
 
 var dataTable = $('#depart_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_depart_all.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[1,2],
    "orderable":false,
   },
  ],

 });

 
 

 $(document).on('click', '.update', function(){
  var ei = $(this).attr('ei');
  $.ajax({
   url:"function/fetch/fetch_depart_edit_modal.php",
   method:"POST",
   data:{ei:ei},
   dataType:'json',
   success:function(data)
   { 
    localStorage.setItem('dpname', data[0].depart_name); 
 

    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/edit_depart_form.php', options)
     .title('ແກ້ໄຂ ຂໍ້ມູຸນ ພະແນກ/ໜ່ວຍງານ')
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
		
        
        form_data.append('namedp', $('#depart_name').val()); 
        form_data.append('depart_id', data[0].depart_id);
					  //('Name_send', values get from => data:{ei:ei}, );
		
        $.ajax({
         method:"POST",
         url:'function/edit/update_depart.php',
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
     url:"function/delete/delete_depart.php",
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
