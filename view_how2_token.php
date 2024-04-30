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
							
							
						 
								<h4 class="card-title text-center"> ເຂົ້າໄປທີເວັບໄຊທ໌   <br><a href="https://notify-bot.line.me/en/" target="_blank" >
								<i class="fa fa-arrow-right"> </i>  Line notify <i class="fa fa-arrow-left"> </i> </a>  </h4> 
							 
								<form class="m-t-40    " novalidate action="" method="post" enctype="multipart/form-data"> 	  
									<div class="form-body ">
									<div class="row p-t-20" id="result"> 
									
										<div class="col-md-2">
										<div class="form-group">
										<label class="control-label"><h4> ຫຼັງຈາກນັ້ນກົດໄປທີ່ Login </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-10"> 
										<img src="guid/line/gentoken/gtoken1.jpg" alt="homepage" class="dark-logo " width="100%" height="100%"/>  
										</div>
										
										<div class="col-md-5">
										<div class="form-group">
										<label class="control-label"><h4> ໃສ່ຊື່ຜູ້ໃຊ້ ແລະ ລະຫັດຜ່ານ ແລ້ວກົດ Login ເພື່ອເຂົ້າລະບົບ Line  </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken2.jpg" alt="homepage" class="dark-logo " width="50%" height="100%"/>  
										</div> 
										
										<div class="col-md-5">
										<div class="form-group">
										<label class="control-label"><h4> ເມື່ອເຂົ້າສູ້ລະບົບແລ້ວຜູ້ໃຊ້ຈະເຫັນຊື່ຜູ້ໃຊ້ ກົດໄປທີ່ຊື່ ແລ້ວກົດໄປທີ່ My Page    </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken3.jpg" alt="homepage" class="dark-logo " width="100%" height="100%"/>  
										</div>
										
										<div class="col-md-5">
										<div class="form-group">
										<label class="control-label"><h4> ເລື່ອນຫນ້າເວັບລົງລຸ່ມຈະເຫັນ ປຸ່ມໃຫ້ສ້າງ Token <br>ກົດໄປທີ່ Generate Token ຫຼື ออก Token (ຖ້າຫາໃຊ້ພາສາໄທ)</h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken4.jpg" alt="homepage" class="dark-logo " width="100%" height="100%"/>  
										</div>
										
										<div class="col-md-5">
										<div class="form-group">
										<label class="control-label">
										<h4>
										ເມື່ອກົດເຂົ້າມາ ລະບົບຈະໄຫ້ເພີ່ມຂໍ້ມູນແຈ້ງເຕືອນ <br> 
										1. ຕື່ມຄຳວ່າ ICT-Leave-system <br> 
										2. ເລືອກຮູບໂປຣໄຟຣຜູ່ໃຊ້ <br> 
										3. ກົດ Generate Token ຫຼື ออก Token (ຖ້າຫາໃຊ້ພາສາໄທ)
										</h4>
										</label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken5.jpg" alt="homepage" class="dark-logo " width="50%" height="100%"/>  
										</div>
										
										
										<div class="col-md-5">
										<div class="form-group">
										<label class="control-label"><h4> ຫຼັງຈ້າງສ້າງລະຫັດ Token ແລ້ວໃຫ້ກົດ Copy  </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken6.jpg" alt="homepage" class="dark-logo " width="50%" height="100%"/>  
										</div>
										
										<div class="col-md-5">
										<div class="form-group"> ເມື່ອກົດ Copy ລະຫັດ Token ຈະຖືກ Copy <br> ຫລັງຈາກນັ້ນກົດ Close ເພື່ອປິດໜ້າສ້າງເລກ Token </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken7.jpg" alt="homepage" class="dark-logo " width="50%" height="100%"/>  
										</div>
										
										<div class="col-md-5">
										<div class="form-group"> ຖ້າຫາກການສ້າງ Token ສຳເລັດລະບົບ ຈະສະແດງ ຂໍ້ມູນທີ່ລະບົບ Line ເຊື່ອມຕໍ່</h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-7"> 
										<img src="guid/line/gentoken/gtoken8.jpg" alt="homepage" class="dark-logo " width="50%" height="100%"/>  
										</div>
										
										<div class="col-md-4">
										<div class="form-group"> ຫຼັງຈາກນັ້ນ ໄປໜ້າຈັດການຂໍ້ມູນຜູ່ໃຊ້ລະບົບ <br> ກົດຄິກຂວາໃນຊ່ອງ Line Token ເລືອກ paste ຫຼື ກົດ ປຸ່ມ Ctrl+V  ເພື່ອວາງເລກ Token ຫຼັກຈາກນັ້ນກົດ ປຸ່ມແກ້ໄຂ</h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-8"> 
										<img src="guid/line/gentoken/gtoken9.jpg" alt="homepage" class="dark-logo " width="100%" height="100%"/>  
										</div>
										
										
										<div class="col-md-4">
										<div class="form-group"> ເມື່ອແກ້ໄຂຂໍ້ມູນ Line Token ແລ້ວ <br> ລະບົບຈະສົ່ງຂໍ້ຄວາມເພື່ອຢືນຢັນວ່າສາມາດນຳໃຊ້ການແຈ້ງເຕື່ອນຜ່ານ Line ໄດ້ແລ້ວ  </h4></label> 
										</div> 
										</div> 	
										<div class="form-group col-md-8"> 
										<img src="guid/line/gentoken/gtoken10.jpeg" alt="homepage" class="dark-logo " width="100%" height="100%"/>  
										</div>


									</div> 			
									</div> 
								</form>
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
	<?php include "javascript.php";?>
</body>

</html>
