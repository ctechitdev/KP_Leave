<?php 
include "checksession.php";
include "function/database_connection.php";
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
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor m-b-0 m-t-0"> ໜ້າຫຼັກ </h3>
                    </div>
                </div> 
				<div class="row">
		 
				<?php
				$year_now = date("Y");
				
				$lockdate ="$year_now-11-26"; 
				 
				$current_date= date("Y-m-d");
				 
				
				
				if($current_date >= $lockdate){
					
					
					$quota = $year_now +1;
					$quota_use = $year_now;
					
					
				}else if($current_date < $lockdate){
					
					
					$quota = $year_now ;
					$quota_use = $year_now-1;
					
				}
				
				 
				
		 
			//	echo"user_ids: $user_ids current_date: $current_date   lockdate: $lockdate   quota: $quota quota_use: = $quota_use ";
				
				$stmt = $connect->prepare(" select  a.lt_id as lt_id ,leave_name, max_minus  
				from tbl_total_leave a
				left join tbl_leave_type b on a.lt_id = b.lt_id
				where year_effect = '$quota'
				");
				$stmt->execute();
				if($stmt->rowCount() > 0)
				{
				while($row=$stmt->fetch(PDO::FETCH_ASSOC))
				{
					
				$lt_id = $row['lt_id'];
				$leave_name = $row['leave_name']; 
				$max_day = $row['max_minus'];  
				if($lt_id == 1){
							$color = "info";
						}else if($lt_id == 2){
							$color = "primary";
						}else if($lt_id == 3){
							$color = "success";
						}else if($lt_id == 4){
							$color = "dark";
						}else if($lt_id == 5){
							$color = "megna";
						}else if($lt_id == 6){
							$color = "warning";
						}
				 
				$stmt2 = $connect->prepare(" select user_ids,leave_type,sum(cal_leave) as cal_leave from calculator_leave_used
				where leave_type = '$lt_id' and user_ids ='$user_ids' and date_request >= '$quota_use-11-26'
				group by user_ids,leave_type
				");
				$stmt2->execute();
				if($stmt2->rowCount() > 0)
				{
				while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
				{
			 	
				 
				$cal_leave = $row2['cal_leave']; 
				 
				$cal_date = (($max_day-$cal_leave)/480); 
				
				$single_date =  intval($cal_date);
						
				$full_hour = 	((($cal_date-$single_date)*480)/60);
				
				$single_hour =  intval($full_hour);
				
			 
				
			 
						
						?>
                         
						
						<div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card card-inverse card-<?php echo"$color";?>">
                            <div class="box text-center">
                                <h2 class="font-light text-white"><?php echo "$single_date";?> ມື້ <?php echo "$single_hour ";?> ຊົ່ວໂມງ </h2>
                                <h6 class="text-white"><?php echo "$leave_name";?></h6>
                            </div>
                        </div>
						</div>
				
				<?php
				 }
				}else{

					$date_max = $max_day/480;
					?>
					<div class="col-md-6 col-lg-4 col-xlg-2">
                        <div class="card card-inverse card-<?php echo"$color";?>">
                            <div class="box text-center">
                                <h1 class="font-light text-white"><?php echo "$date_max";?> ມື້</h1>
                                <h6 class="text-white"><?php echo "$leave_name";?></h6>
                            </div>
                        </div>
						</div>
					<?php
				}
				}
				}
				
				?> 
                </div>
				 <!-- /row -->
            </div>
            <footer class="footer text-center">
               <?php include "footer.php";?>
            </footer>
            <!-- End footer -->
        </div>
    </div>
	<?php include "javascript.php";?>
</body>

</html>
