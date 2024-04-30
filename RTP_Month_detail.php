<?php
include "checksession.php";
include "function/database_connection.php";

 
$Month = $_GET['MV'];
$Years = $_GET['YF'];
$LType = $_GET['LTP'];


?>
<!DOCTYPE html>
<html lang="en">
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
              <div class="row">
			   <div class="col-12">
                        <div class="card">
							 
							<div class="card-block" id="result">
							
							<form class="m-t-40" novalidate action="" method="post" >
							
							
							
							<h1 class="card-title text-center">ລາຍການຂໍລາພັກ</h1>
							
							<div class="row p-t-20 text-center" id="result">
							
							 <div class="form-group col-md-4">
								 
							</div>
							
							 
				 
                                             
									 
                            </div>
							 
						 
							
							 
							
							<div class="table-responsive ">
							 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr class="">
							<th style="width:3%"  > ລຳດັບ </th>
							<th style="width:5%"  > ເລກທີ </th>
							<th style="width:20%"  > ຊື່-ນາມສະກຸນ ຜູ້ຂໍ </th>
							<th style="width:10%"  > ພະແນກ </th> 
							<th style="width:10%" > ຈຳນວນວັນລາ </th>
							<th style="width:8%"  > ປະເພດ </th>  
							<th style="width:15%" > ວັນທີ </th>  
							<th style="width:15%"  > ເວລາຫາເວລາ </th>  
							<th style="width:25%"  > ເຫດຜົນ </th>  
							</tr>
							</thead>
									<div class='m-t-40'>
										<?php
										
							
								 
							//	 echo "$staff_id";		
										?>
                                    <div class='d-flex'> 
									<div class='ml-auto'>
										<div class='form-group'>
										
											<input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
										</div>
									</div>
                                    </div>
									
                                    </div>	  
                                    <tbody>
									  <?PHP
 
							$i=1;
							if($LType =='All'){
								$type_syntax = "";
							}else{
								$type_syntax = "and leave_type='$LType'";
							}
							
							$stmt = $connect->prepare(" select * from pre_detail_count 
							where  month_from= '$Month' and Year_from= '$Years' $type_syntax
							");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						
 				
						
							$lr_id = $row['lr_id']; 
							$full_name = $row['full_name']; 
							$depart_name = $row['depart_name']; 
							$leave_name = $row['leave_name'];
							$date_leave = $row['date_leave'];
							$hours_leave = $row['hours_leave'];
							$minus_leave = $row['minus_leave'];
							$date_from = $row['date_from'];
							$date_to = $row['date_to'];
							$time_from = $row['time_from'];
							$time_to = $row['time_to'];
							$reason = $row['reason'];
							?>

								
							<tr>
							<td><?php echo "$i";?></td>
							<td><?php echo "$lr_id";?></td>
							<td><?php echo "$full_name";?></td>
							<td><?php echo "$depart_name";?></td>
							<?php
							
							if($date_leave == 0){
								if($hours_leave == 0){
									?>
									<td><?php echo "  $minus_leave ນາທີ ";?></td>
									<?php
								}else{
									 
								?>
								<td><?php echo " $hours_leave ຊົິ່ວໂມງ $minus_leave ນາທີ ";?></td>
								<?php
								}
								
							}else{
								if($hours_leave != 0){
									?>
									<td><?php echo " $date_leave ມື້  $hours_leave ຊົິ່ວໂມງ $minus_leave ນາທີ ";?></td> 
									<?php
								}else{
									
								
								?>
								<td><?php echo " $date_leave ມື້";?></td> 
								<?php
								}
							}
							?>
							<td><?php echo "$leave_name";?></td> 
							<?php
							if($date_from == $date_to){
								?>
								<td><?php echo "$date_from";?></td>
								<?php
							}else{
								?>
								<td><?php echo "$date_from - $date_to";?></td>
								<?php
							}
							
							?>
							
							
							<td><?php echo "$time_from - $time_to";?></td> 
							<td><?php echo "$reason";?></td>
			  
							</tr>

							<?php
						 
								$i++;}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                                </div>
							</form>
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
