<?php
include "function/database_connection.php";
session_start();
$user_ids = $_SESSION["user_ids"]; 

   
 

	  if(isset($_POST['btnchange']))
{
	
		$newpass = $_POST['confirmPassword'];
 
		
		$stmt1 = $connect->prepare("update tbl_user  set user_status = 1 ,user_password ='$newpass' where user_ids = $user_ids");  
		$stmt1->execute(); 
		 
 if($stmt1->execute())
{ 
header("location:Logout.php");	
} 
			  			
			
	
}


?>

<!DOCTYPE html>
<html lang="en">
 
<head>
 <style>
.changepassdiv{
margin-left: 32%;
}
</style>
 

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

						$stmt_select = $connect->prepare(" select * from tbl_user   where user_ids    = '$user_ids' "); 
						$stmt_select->execute();


						$row=$stmt_select->fetch(PDO::FETCH_ASSOC);
						$User_names = $row['User_names'];	 

						?>
						
						<h2 class="card-title text-center"> ປ່ຽນລະຫັດຜ່ານ </h2>
						<h5 class="card-title text-center"> <?php echo "$User_names"; ?> </h5>
						
							<form  name="frmChange" class="m-t-40" novalidate action="" method="post"  enctype="multipart/form-data" onSubmit="return validatePassword()">
								  
									 
								
                                    <div class="form-body">
									<div class="row p-t-20" id="result">
                                             
											 
										 
  
									<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
											
									
									
									<div class="col-md-5">
									</div>
									
								 
									
									
									<div class="col-md-2">
									<div class="form-group">
									<label class="control-label">ລະຫັດຜ່ານໃຫມ່</label>
									<div class="controls">
									
									 
									<input type="password" name="newPassword" class="txtField form-control font" placeholder=" ລະຫັດຜ່ານໃຫມ່ " />
									<span style="color:red" id="newPassword" class="required"></span>
									
									</div>
									</div>
									
									</div>
									
									<div class="col-md-5">
									</div>
									<div class="col-md-5">
									</div>
									
									<div class="col-md-2">
									<div class="form-group">
									<label class="control-label">ຢືນຢັນລະຫັດຜ່ານໃຫມ່</label>
									<div class="controls">
									
									 
									<input type="password" name="confirmPassword" class="txtField form-control font" placeholder=" ຢືນຢັນລະຫັດຜ່ານໃຫມ່ " /> 
									<br><span style="color:red" id="confirmPassword" class="required"></span>
									
									</div>
									</div>
									
									</div> 	    
                                    </div>
											
											<div class=" text-center">
											<button type="submit"  name="btnchange"  class="btn btn-success font"> <i class="fa fa-check"></i> ປ່ຽນລະຫັດຜ່ານ </button>
											</div> 
                                            </div>
                                        </div>
									   </div>   
									
                                </form>
						
						 
						 
                                            
                                        </div>
											<div class="text-center" align = "center">
											
											
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
	
	
	<script>
function validatePassword() {
var   newPassword,confirmPassword,output = true;

 
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;
 
  if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "ຕື່ມຂໍ້ມູນ";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "ຕື່ມຂໍ້ມູນ";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "ລະຫັດບໍ່ຕົງກັນ";
output = false;
} 	
return output;
}
</script>



	<?php include "javascript.php";?>
</body>

</html>
