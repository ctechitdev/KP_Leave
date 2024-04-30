<?php  
session_start();
 include "function/database_connection.php";
 
      if(isset($_POST["btnlogin"]))  
      {
	$Name_user =  ($_POST['username']);
	$Pass_user = ($_POST['password']);

		  
           if(empty($_POST["username"]) || empty($_POST["password"]))  
           {  
                $message = '<label> ຕື່ມຂໍ້ມູນ </label>';  
           }  
           else  
           {   

			 

	   
                $query = $connect->prepare("select   user_ids,user_status,concat((case when staff_gender = 1 then 'ທ້າວ ' else 'ນາງ ' end),staff_first_name,' ',staff_last_name) as full_name,staff_depart ,staff_code,a.staff_id as staff_id,role_level
				FROM tbl_user a
				left join tbl_staff b on a.staff_id = b.staff_id
                left join tbl_role_level c on b.staff_position = c.ps_id    
				WHERE User_names = :username AND user_password = :password ");  
                $query->execute(  
                     array(  
                          'username'     =>     $_POST["username"],  
                          'password'     =>     $_POST["password"]  
                     )  
                );  
                $count = $query->rowCount();  
                if($count > 0)  
                {  
			  $row = $query->fetch();
			  
			  
			  
			  $full_name = $row['full_name'];
			  $role_level = $row['role_level'];
			  $status_user = $row['user_status'];
			  $user_ids = $row['user_ids'];
			  $staff_code = $row['staff_code'];
			  $staff_id = $row['staff_id'];
			  
			  
			  
			  $staff_depart = $row['staff_depart']; 
 
			  
			  
			  if($status_user == 0){
				  
				  $_SESSION["user_ids"] = $user_ids;
				  $_SESSION["status_user"] = $status_user;
				  $_SESSION["full_name"] = $full_name;
				  header("location:change_password.php");
				  
				 
						     
			  }
			  else if ($status_user == 1){
				
				$_SESSION["full_name"] = $full_name;
				$_SESSION["user_ids"] = $user_ids;
				$_SESSION["status_user"] = $status_user;
				$_SESSION["staff_depart"] = $staff_depart; 
				$_SESSION["staff_code"] = $staff_code;
				$_SESSION["staff_id"] = $staff_id;
				$_SESSION["role_level"] = $role_level; 
				header("location:index.php");
 
			  }
			  
			  else if ($status_user == 2){
				  $message = "<label> ຜູ້ໃຊ້ຖືກປິດລະບົບ  </label>";
			  }
			  
			           
                }  
                else  
                {  
                     $message = '<label> ລະຫັດຜ່ານ ຫຼື ຊື່ຜູ້ໃຊ້ບໍ່ຖືກຕ້ອງ  </label>';  
                }  
           }  
      }else{
		  $Name_user ="";
		  $Pass_user ="";
		  
		  
	  }  
   
 ?>

<!DOCTYPE html>
<html lang="en">
 <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title> ໂປຣແກມຈັດການຂໍລາພັກ </title>
    <link href="css/style.min.css" rel="stylesheet">
	<link href="css/font.css" rel="stylesheet">
 
</head>
 
<body>
    <div class="main-wrapper">

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative font"
            style="background:url(images/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box row">
                <div class="col-lg-6 col-md-6 modal-bg-img" style="background-image: url(images/Kp-Logo.png);">
                </div>
                <div class="col-lg-6 col-md-6 bg-white">
                    <div class="p-3">
                        
                        <h2 class="mt-3 text-center">ເຂົ້າລະບົບ</h2>
                        <div class="form-group">
							<div class="col-md-12">
								<?php
								if (isset($message)) {
								?>
									<div class="text-center">
										<strong><?php echo "<h4 style='color:#ff0000;'>" . $message . "</h4>"; ?></strong>
									</div>
								<?php
								}

								?>

							</div>
						</div>
                        <form class="mt-4" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark " for="uname"> ອີເມວຜູ້ໃຊ້ ຫຼື ເບີໂທ </label>
                                        <input class="form-control" name="username" id="username" type="text"  placeholder="ອີເມວຜູ້ໃຊ້ ຫຼື ເບີໂທ">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="text-dark" for="pwd"> ລະຫັດຜ່ານ </label>
                                        <input class="form-control" name="password" id="password"  type="password"  placeholder="ລະຫັດຜ່ານ">
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    
									<button type="submit" name="btnlogin"   class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light font">ເຂົ້າສູ່ລະບົບ</button>

                                </div>
                              
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
 
    </div>
 
    <script src="js/jquery.min.js "></script> 
    <script src="js/popper.min.js "></script>
    <script src="js/bootstrap.min.js "></script>
 
    <script>
        $(".preloader ").fadeOut();
    </script>
</body>

</html>