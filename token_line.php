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
include"connect.php"; 
 
 
 
 	  if(isset($_POST['btn_token']))
{
 
	$token_click = "yes"; 
	$line_notify = "edit";  
}

 	  if(isset($_POST['btn_token_test']))
{
 
	$line_notify = "test"; 
	$token_click = "yes";
	
}


if(!empty($token_click) ){
		
		$token_code = $_POST['token_code'];
		if(!empty($token_code)){
			
		//statement 
		if($line_notify == "edit"){
			
		$stmt1 = $connect->prepare("update tbl_user  set line_token ='$token_code' where user_ids = $user_ids");  
		$stmt1->execute();
		$stmt1->execute();
			 
		 $text_message = " ແກ້ໄຂຂໍ້ມູນເລກ Token ແລ້ວ ທ່ານ ສາມາດນຳໃຊ້ລະບົບແຈ້ງເຕື່ອນຜ່ານ Line ໄດ້ແລ້ວ ";
		 
		}else {
			$text_message = " ທົດສອບລະບົບແຈ້ງເຕື່ອນຜ່ານ Line ";
		}
		
		
		$url = 'https://notify-api.line.me/api/notify';
		$token      = "$token_code";
		$headers    = [
				'Content-Type: application/x-www-form-urlencoded',
				'Authorization: Bearer '.$token
			];
			

		$fields     = "message=  $text_message ";

		$ch = curl_init();
		curl_setopt( $ch, CURLOPT_URL, $url);
		curl_setopt( $ch, CURLOPT_POST, 1);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
		$result = curl_exec( $ch );
		curl_close( $ch );

		var_dump($result);
		$result = json_decode($result,TRUE);
		
		$message_token =" ຂໍ້ຄວາມຖືກສົ່ງທາງ Line ກະລຸນາລໍຖ້າ ";
		header("Refresh:1;");
		}else{
			 $token_error = "ກະລູນາໃສ່ລະຫັດ Token !!! ";
		}
		
		
	} 

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
						<div class="card-block "> 
						<h2 class="card-title text-center"> Line Token   </h2> 
						
						  		
						<?php 
						$stmt_select = $connect->prepare(" select  (case when line_token is null then '' else line_token end) as line_token from tbl_user where user_ids    = '$user_ids' "); 
						$stmt_select->execute(); 
						$row=$stmt_select->fetch(PDO::FETCH_ASSOC);
						$code_token = $row['line_token'];	  
						?>
						 
						<form class="m-t-40   " novalidate action="" method="post" enctype="multipart/form-data">
						
						<div class="form-body">
						 
				

							<div style="width:100%;  " class="text-center">
								<div style="color:red" class="1"><?php if(isset($token_error)) { echo $token_error; } ?></div>

								<table border="0"   cellspacing="0" width="100%" align="center" class="tblSaveForm">
									   
									<tr> 
									<td><label> Line Token </label></td>
									<td> 
									<div class="form-group   col-md-12">
									<input type="text" name="token_code" class="txtField form-control font" placeholder=" Line Token " value="<?php echo"$code_token";?>" /> 
									<br><span style="color:red" ></span> 
									</div> 
									</td>
									</tr>
								
								
								

								<tr>
								<td colspan="2">
								<div style="color:blue" class="1"><?php if(isset($message_token)) { echo $message_token; } ?></div>
								
								

								<div class="form-group    col-md-12" align = "center">
								<button type="submit"  name="btn_token"  class="btn btn-success font"> <i class="fa fa-check"></i> ແກ້ໄຂ </button>
								<button type="submit"  name="btn_token_test"  class="btn btn-info font"> <i class="fa fa-check"></i> ທົດລອງ </button>

								</div>

								</td>
								</tr>
								</table>
							</div> 
							
							 
						
						</div>
						</form>
		 
						
						<h4 class="card-title text-center"> Line Token ເປັນເລກລະຫັດທີ່ນຳໃຊ້ເພື່ອເຮັດໃຫ້ລະບົບສາມາດສົ່ງຂໍ້ຄວາມແຈ້ງເຕືອນໄປຫາຜູ່ໃຊ້. 
						<a href="view_how2_token.php" target="_blank" ><i class="fa fa-eye"></i> ສະແດງ  </a>  ວິທີການເປິດນຳໃຊ້
						</h4> 
						
                        </div> 		 
						</div>   
								
                               
								
                </div>
				
				
				
				
				</div>
            </div>
 
							
							
							
        </div>
 
				 
            </div>
           <?php include "footer.php";?>
            
        </div>
    </div>
	
	
 



	<?php include "javascript.php";?>
</body>

</html>
