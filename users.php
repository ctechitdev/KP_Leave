<?php 
include "checksession.php";
include "function/database_connection.php";
   
	  ?>

<!DOCTYPE html>
<html lang="en"> 
 <head>
    
<?php include "stylesheet.php";?>
<script src="js/jquery.Tables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script> 
<link rel="stylesheet" href="css/dataTables.bootstrap.min.css" /> 
<script src="js/dialogify.min.js"></script>
  </head>

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
                        
							
							<div class="container-fluid">
									<div class="row" id="row">
										<div class="col-12"> 
											<div class="card">
												<div class="card-block"> 
												<h2 class="card-title text-center">ລົງທະບຽນ ຜູ້ໃຊ້ </h2>
												<span id="form_response"></span>
													<table id="users_data" class="table table-bordered table-striped">
														<thead class="btn-info">
															<tr> 
															
															<td> ຊື່ ນາມສະກຸນ </td>  
															<td> E-Mail </td>
															<td> ພະແນກ</td> 
															<td> ຕຳແໜ່ງ </td>  
															<td></td>
															<td> </td>
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
	
  
 var dataTable = $('#users_data').DataTable({
  "processing":true,
  "serverSide":true,
  "order":[],
  "ajax":{
   url:"function/fetch/fetch_users_all.php",
   type:"POST"
  },
  "columnDefs":[
   {
    "targets":[4,5,6],
    "orderable":false,
   },
  ],

 });



 
 

 $(document).on('click', '.regis', function(){
  var ri = $(this).attr('ri');
  $.ajax({
   url:"function/fetch/fetch_user_staff_id_modal.php",
   method:"POST",
   data:{ri:ri},
   dataType:'json',
   success:function(data)
   {  
	localStorage.setItem('stcode', data[0].staff_code); 
	localStorage.setItem('stfullname', data[0].full_name); 
	localStorage.setItem('stdp', data[0].depart_name);  
	

	
<!--	localStorage.setItem('edit_unit_name', data[0].unit_name); --!>

<!--	localStorage.setItem('edit_depart_name', data[0].depart_name); --!>
 
 
    var options = {
     ajaxPrefix:''
    };
    new Dialogify('modal/add_user_form.php', options)
     .title('ເພີ່ມ ຂໍ້ມູຸນ ຜູ້ໃຊ້')
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
		
        form_data.append('email', $('#e_mail').val());  
        form_data.append('s_id', data[0].staff_id);
					  //('Name_send', values get from => data:{ei:ei}, );
  
		
        $.ajax({
         method:"POST",
         url:'function/add/add_user.php',
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

 $(document).on('click', '.reset', function(){
  var ei = $(this).attr('ei');
  Dialogify.confirm("<h3 class='text-danger'><b> ແນ່ໃຈແລ້ວບໍຈະລືບລາຍການນີ້ ?</b></h3>", {
   ok:function(){
    $.ajax({
     url:"function/edit/reset_password.php",
     method:"POST",
     data:{ei:ei},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ຝ່າຍ ຖືກລຶບແລ້ວ</b></h3>');
      dataTable.ajax.reload();
     }
    })
   },
   cancel:function(){
    this.close();
   }
  });
 });
 
  $(document).on('click', '.disable', function(){
  var di = $(this).attr('di');
  Dialogify.confirm("<h3 class='text-danger'><b> ແນ່ໃຈແລ້ວບໍຈະລືບລາຍການນີ້ ?</b></h3>", {
   ok:function(){
    $.ajax({
     url:"function/edit/disable_user.php",
     method:"POST",
     data:{di:di},
     success:function(data)
     {
      Dialogify.alert('<h3 class="text-success text-center"><b>ຂໍ້ມູນ ຝ່າຍ ຖືກລຶບແລ້ວ</b></h3>');
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
