<?php
include "checksession.php";
include "function/database_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php include "stylesheet.php";?>
<script type="text/javascript">

 $(document).ready(function(){  
      $('#search').click(function(){  
         //     $('#ajax-form').submit(function(e){
		    var F_NAME = $("#F_NAME").val(); 
          
                $.ajax({  
                     url:"search_staff.php",  
                     type:"post", 
					 data: {
                            F_NAME:F_NAME //
                        },
                     success:function(data)  
                     {  
                          $('#result').html(data);  
                     }  
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
              <div class="row">
			   <div class="col-12">
                        <div class="card">
								<div class="error-body text-center">
                                <h1 class="text-success"><i class="mdi mdi-account-search"></i> </h1>
                                <form novalidate class="" action="#" method="post" >
                                    <div class="form-group has-success m-b-40">
									 <div class="col-md-12">
									  <label class="control-label"> ພີມຊື່ພະນັກງານ </label>
											<div class="controls">
											<input type="text" id="F_NAME" name="F_NAME" class="form-control  font form-control-lg text-center" placeholder="- - - - - - - - - - "  required >
                                       <span class="bar"></span></div>
                                    </div>
                                    </div>
                                   <button type="button" ID="search" class="btn btn-lg btn-success btn-rounded waves-effect waves-light m-b-40 font"> <i class="ti-search"></i> ຄົ້ນຫາ</button>
                                </form>
                            </div>
							<div class="card-block" id="result">
						
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
