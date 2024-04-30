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
              
							
								 <div class="container-fluid">
									<div class="row" id="row">
										<div class="col-12"> 
											<div class="card">
												<div class="card-block"> 
												<h2 class="card-title text-center"> ຈັດການເມວພະແນກ </h2>
												<span id="form_response"></span>
													<table id="email_depart" class="table table-bordered table-striped">
														<thead class="btn-info">
															<tr> 
															<td> ຊື່ ພະແນກ/ໜ່ວຍງານ </td>  
															<td> E-Mail ພະແນກ/ໜ່ວຍງານ </td>     
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
	
 
	
 
 var dataTable = $('#email_depart').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_email_depart_all.php",
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
   url:"function/fetch/fetch_email_depart_edit_modal.php",
   method:"POST",
   data:{ei:ei},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('dp_name', data[0].depart_name);
	localStorage.setItem('dp_email', data[0].depart_email); 
	
<!--	localStorage.setItem('edit_unit_name', data[0].unit_name); --!>

<!--	localStorage.setItem('edit_depart_name', data[0].depart_name); --!>
 
 
    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/edit_email_depart_form.php', options)
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
		
        form_data.append('dpem', $('#depart_email').val());   
        form_data.append('depart_id', data[0].depart_id);
					  //('Name_send', values get from => data:{ei:ei}, );
		
        $.ajax({
         method:"POST",
         url:'function/edit/update_email_depart.php',
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
     url:"function/edit/clear_email_depart.php",
     method:"POST",
     data:{di:di},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ເມວ ຖືກລຶບແລ້ວ</b></h3>');
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
