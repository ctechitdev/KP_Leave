<?php
include "checksession.php"; 
include "function/database_connection.php";
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
						 
							 

							<?php

							$stmt_select = $connect->prepare(" select * from tbl_leave_request where lr_id =:rqid ");  
							$stmt_select->execute(array(':rqid'=>$_GET['leave_id']));


							$row=$stmt_select->fetch(PDO::FETCH_ASSOC); 	 
							$attatch_file = $row['attatch_file'];
				 

							?>

							 
								
								<div class="form-group col-md-12">
						 
								<img src="attach_pic/<?php echo $attatch_file?>" alt="homepage" class="dark-logo " width="100%"/> 
						 
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
