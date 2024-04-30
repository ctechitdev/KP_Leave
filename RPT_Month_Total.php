<?php
include "checksession.php";
include "function/database_connection.php";

 
 
	  if(isset($_POST['BTNsearch']))
{   
	$syear = $_POST['years'];  
	  
}else{
	$syear = date("Y");
}

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
							
							
							
							<h1 class="card-title text-center"> ສັງລວມ ຂໍລາພັກ ແບບປີ </h1>
							
							<div class="row p-t-20 text-center" id="result">
							
							<div class="form-group col-md-4"> 
							 
							</div>
							
						 
							<div class="form-group col-md-4">
							<label for="inputEmail"> ເລືອກປີ  </label> 
							<select class="form-control font" name="years" id ="years" required>
							<option value=""> ເລືອກ ປີ </option> 
							<?php
							$stmt = $connect->prepare("  select DISTINCT date_format(date_from,'%Y') as date_from from tbl_leave_request  ");
							$stmt->execute();
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{
							?> <option value="<?php echo $row['date_from']; ?>"> <?php echo $row['date_from']; ?></option> 
							<?php   
							}
							}
							?>
							</select>
							</div>
							
							 
							
							<div class="form-group col-md-4"> 
							 
							</div>
                                             
									 
                            </div>
							
		
							 
							<div class="col-md-12">
								<div class="form-group text-center">
									<button type="submit" name="BTNsearch" class="btn btn-success btn-lg btn-rounded waves-effect waves-light m-b-40 font"> <i class="ti-search"></i> ຄົ້ນຫາ</button>

								</div>
							</div>
							
							 
							
							<div class="table-responsive ">
							 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr class="">
							<th style="width:5%"  > ເດືອນ </th> 
							<th style="width:8%"  > ລາປ່ວຍ </th> 
							<th style="width:8%" > ລາປະຈຳປີ </th> 
							<th style="width:8%"  > ລາເກີດລູກ </th>  
							<th style="width:8%"  > ລາກິດ </th> 
							<th style="width:8%"  > ລາແຕ່ງງານ </th> 
							<th style="width:8%"  > ລາບວດ </th> 
							<th style="width:8%"  > ລາສຶກສາຕໍ່ </th> 
							<th style="width:8%"  > ລາບໍ່ໄດ້ຮັບຄ່າຈ້າງ </th> 
							<th style="width:8%"  > ອື່ນໆ </th> 
							<th style="width:8%"  > ລວມ </th> 
							</tr>
							</thead>
									<div class='m-t-40'>
										<?php
										
							
								 
						 	// echo "$date_from";	
							// echo "$date_to";
							 
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
						 	// echo "$apst";
						 
							$i = 1;
							$stmt = $connect->prepare("select  month_from,Year_from, sum(sick_leave)as sick_leave ,sum(anual_leave)as anual_leave,sum(pagneg_leave)as pagneg_leave,
								sum(mission_leave)as mission_leave,sum(married_leave)as married_leave,sum(mong_leave)as mong_leave,sum(learn_leave)as learn_leave,
								sum(nopayment_leave)as nopayment_leave,sum(other_leave)as other_leave
								 from pre_count_leave
                                 where Year_from = '$syear'
                                 group by month_from,Year_from
							");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
							
							$month_from = $row['month_from'];
							$Year_from = $row['Year_from']; 
							$sick_leave = $row['sick_leave'];
							$anual_leave = $row['anual_leave'];
							$pagneg_leave = $row['pagneg_leave'];
							$mission_leave = $row['mission_leave'];
							$married_leave = $row['married_leave'];
							$mong_leave = $row['mong_leave'];
							$learn_leave = $row['learn_leave'];
							$nopayment_leave = $row['nopayment_leave'];
							$other_leave = $row['other_leave'];
							$total_leave =  $row['sick_leave']+$row['anual_leave']+$row['pagneg_leave']+$row['mission_leave']+$row['married_leave']+$row['mong_leave']+$row['learn_leave']+$row['nopayment_leave']+$row['other_leave'];

						 
							?>

							<tr>
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>   && LTP=All " target="_blank"><?php echo " $month_from";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?> && LTP=1 " target="_blank"><?php echo " $sick_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=2" target="_blank"><?php echo " $anual_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=3" target="_blank"><?php echo " $pagneg_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?> && LTP=4 " target="_blank"><?php echo " $mission_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=5 " target="_blank"><?php echo " $married_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?> && LTP=6 " target="_blank"><?php echo " $mong_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=7 " target="_blank"><?php echo " $learn_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?> && LTP=8 " target="_blank"><?php echo " $nopayment_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=9" target="_blank"><?php echo " $other_leave";?></a>
							</td>
							
							<td style=" text-align: center;">
							<a href="RTP_Month_detail.php?  MV=<?PHP ECHO"$month_from"?> && YF=<?PHP ECHO"$Year_from"?>  && LTP=All " target="_blank"><?php echo " $total_leave";?></a>
							</td>
 

							</tr>

							<?php
						 $i++;
								}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="12">
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
	
<script src="js/bootstrap-datepicker.min.js"></script>
<script src='js/jquery.dateFormat.js'></script>
<script src="js/date_picker.js"></script>
	
	<?php include "javascript.php";?>
</body>

</html>
