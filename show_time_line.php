<?php
 include "checksession.php";

  
 include "function/database_connection.php";
 
 $stid =$_GET['request_id'] ;
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
 
 <script type="text/javascript" src="js/jquery.min.js"></script>      <!-- jQuery -->
 
<style>
.tdl {
  margin: auto;
  width: 60%;
  border: 3px solid #73AD21;
  padding: 10px;
}
.tdr {
  margin: auto;
  width: 20%;
  border: 3px solid #73AD21;
  padding: 10px;
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
						<form class="m-t-40" novalidate action="" method="post" enctype="multipart/form-data">
						<div class="card-block">
					 
		 
					 
					 
						<h2 class="card-title text-center">ຂໍ້ມູນ ການເຄື່ອນໄຫວ </h2>
						 
						
						  
                            
								
									<?php
								 
									
									$stmt_select = $connect->prepare(" select staff_id, concat((case when staff_gender = 2 then 'ນາງ ' else 'ທ້າວ ' end ),staff_first_name,' ' ,staff_last_name ) as full_name , 
										depart_name, position_name, staff_code  
										 from tbl_staff a
										 left join tbl_depart b on a.staff_depart = b.depart_id
										 left join tbl_position c on a.staff_position = c.ps_id 
										 where staff_id =:stid  "); 
										 
									$stmt_select->execute(array(':stid'=>$_GET['request_id']));
									  
									 
									$row=$stmt_select->fetch(PDO::FETCH_ASSOC);
									
									
									$full_name = $row['full_name'];
									$depart_name = $row['depart_name'];
									$position_name = $row['position_name'];  
									$tag_staff_id = $row['staff_id']; 
									$scode = $row['staff_code']; 
									 
			 
									?>
								
                                    <div class="form-body">
									 <div class="row p-t-20" id="result">
                            
				  
				  <?php
						//debug
						// echo"$approve_level";
						?>
						
                    <div class="form-group col-md-6">
                      <label for="inputEmail"> ຊື່ພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$full_name ";?> </label>
                     </div>
					 
					  <div class="form-group col-md-6">
                      <label for="inputEmail"> ລະຫັດພະນັກງານ :  </label> <label for="inputEmail"> <?php echo "$scode  ";?> </label>
                     </div>
					 
					 <div class="form-group col-md-4">
                      <label for="inputEmail"> ຕຳແໜ່ງ :  </label> <label for="inputEmail"> <?php echo "$position_name  ";?> </label>
                     </div>
					 <div class="form-group col-md-4">
                      <label for="inputEmail"> ພະແນກ :  </label> <label for="inputEmail"> <?php echo "$depart_name  ";?> </label>
                     </div> 
					 
				   
					<div class="form-group col-md-10">
					<label for="inputEmail">    </label> <label for="inputEmail"> 
			 

					</label>
					</div>
					 
					  </label>
                                                     
                    </div>
						
					
					
											
											
											
                                            </div>
                                        </div>
									 
									   </div>   
								
                                </form>
								
                            </div>
							
							
							
                            </div>
							
							
							<div class="container-fluid">
              <div class="row" id="row">
			      <div class="col-12">
				  
				  
							<div class="card">
							<div class="card-block">
							 
								 
								<div class="table-responsive">
							<table id='demo-foo-addrow2' class='table ' >
                                    
							 
									 
                                    <tbody>
									 <?PHP
							
										$stmt = $connect->prepare("  
										(select distinct staff_id,date_atv from tbl_time_line where  staff_id ='$stid' ) 
										union all 
										(select distinct staff_id,date_follow from tbl_symptoms_follow where  staff_id ='$stid' ) order by date_atv desc
										  ");
										
										$stmt->execute();
										if($stmt->rowCount() > 0)
										{
										while($row=$stmt->fetch(PDO::FETCH_ASSOC))
										{
										 
										$sdate_atv = $row['date_atv']; 
									 
										?>

										<tr>   
									 
										<td class = 'tdr' ><?php echo "$sdate_atv";?></td>
										<td  class ='tdl' >

										<?php
										
										$stmt2 = $connect->prepare("
										select staff_id,act_name,location_name,village_name,dt_name,date_atv,start_atv,stop_atv, 
										(case when detail_atv = '' then 'ບໍ່ມີ' else detail_atv end) as detail_atv,
										(case when detail_partnert = '' then 'ບໍ່ມີ' else detail_partnert end) as detail_partnert, 1 as type_time_line,add_by
										from tbl_time_line a
										left join tbl_activity_type b on a.atv_id = b.at_id  
										left join tbl_district c on a.district_id = c.dt_id
										where  staff_id ='$stid' and date_atv = '$sdate_atv'
										union all
										SELECT staff_id,(case when stf_type = 2 then 'ຕິດຕາມອາການໂຕເອງ' else 'ຕິດຕາມອາການຄົນໄກ້ໂຕ' end) as stf_type ,st_name,partner_name,partner_relation,date_follow,'','', 
										(case when dt_owner = '' then 'ບໍ່ມີ' else dt_owner end) as dt_owner,
										(case when dt_join = '' then 'ບໍ່ມີ' else dt_join end) as dt_join,
										stf_type as type_time_line,add_by
										FROM tbl_symptoms_follow a 
										left join tbl_symptoms_type b on a.st_id = b.st_id
										where  staff_id ='$stid' and date_follow = '$sdate_atv'
 
										  ");
										
										$stmt2->execute();
										if($stmt2->rowCount() > 0)
										{
										while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
										{
										$act_name = $row2['act_name']; 
										$location_name = $row2['location_name'];  
										$village_name = $row2['village_name']; 
										$dt_name = $row2['dt_name']; 
										$date_atv = $row2['date_atv']; 
										$start_atv = $row2['start_atv'];
										$stop_atv = $row2['stop_atv'];
										$detail_atv = $row2['detail_atv'];
										$detail_partnert = $row2['detail_partnert'];
										$type_time_line = $row2['type_time_line'];
										  
										if($type_time_line == 1){
										  echo "$start_atv ຫາ $stop_atv $act_name ທີ່ $location_name ບ້ານ $village_name ເມືອງ $dt_name <br>";   
										  echo "ເຄື່ອນໄຫວ: $detail_atv <br> ມີຜູ້ຮ່ວມ $detail_partnert <br> ";
											
										}
										if($type_time_line == 2){
										  echo " $act_name  ອາການ $location_name $village_name  $dt_name <br>";   
										  echo "ລາຍລະອຽດ: $detail_atv <br> ການຖືກສຳພັດ $detail_partnert <br> ";
											
										}
										if($type_time_line == 3){
										  echo " $act_name  ອາການ $location_name $village_name  $dt_name <br>";   
										  echo "ລາຍລະອຽດ: $detail_atv <br> ສຳພັດໂດຍ $detail_partnert <br> ";
											
										}
										
										 
										 ?> 
										
										<br>
										<?php
										
										}
										}
										
										?>
										</td>   


										</td>

										</tr>

										<?php
									 
											}
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
