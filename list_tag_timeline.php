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
              <div class="row">
			   <div class="col-12">
                        <div class="card">
							 
							<div class="card-block" id="result">
							
							<h2 class="card-title text-center"> ລາຍການເຄື່ອນໄຫວບຸກຄົນ </h2>
							<div class="table-responsive ">
							 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr class="">
							<th scope="col"  > ລຳດັບ </th>
							<th scope="col"  > ຊື່-ນາມສະກຸນ </th>
							<th scope="col"  > ພະແນກ </th> 
							<th scope="col"  > ຕຳແໜ່ງ </th>   
							<th scope="col"  > ກວດສອບ </th> 
							</tr>
							</thead>
										<div class='m-t-40'>
										<?php
										
							
								 
							//	 echo "$staff_id";		
										?>
                                        <div class='d-flex'>
                                            <div class='mr-auto'>  
											<div class='form-group'>
                                             
                                            </div>
                                        </div>
                                            <div class='ml-auto'>
                                                <div class='form-group'>
												
                                                    <input id='demo-input-search2' type='text' placeholder='ຊອກຫານຂໍ້ມູນ' class='form-control font' autocomplete='off'>
                                                </div>
                                                </div>
                                    </div>
                                    </div>
                                    <tbody>
									 <?PHP
						 	// echo "$staff_id";
						    if($staff_depart != 12) {
						         $syntax = " where staff_depart = '$staff_depart' and staff_id != '$staff_id' ";
						    } 
						   
							
							$stmt = $connect->prepare(" select staff_id, concat((case when staff_gender = 2 then 'ນາງ ' else 'ທ້າວ ' end ),staff_first_name,' ' ,staff_last_name ) as full_name , 
							depart_name, position_name
							 from tbl_staff a
							 left join tbl_depart b on a.staff_depart = b.depart_id
							 left join tbl_position c on a.staff_position = c.ps_id
							 $syntax ");
							
							$stmt->execute();
							
							if($stmt->rowCount() > 0)
							{
								$s=1;
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						
							$full_name = $row['full_name'];
							$depart_name = $row['depart_name'];
							$position_name = $row['position_name'];  
							$tag_staff_id = $row['staff_id'];  
							
						 
							?>

							<tr>  
							<td><?php echo "$s";?></td>
							<td><?php echo "$full_name";?></td>
							<td style=" text-align: left;"><?php echo " $depart_name";?></td> 
							<td style=" text-align: left;"><?php echo " $position_name";?></td> 
							<td><a href="show_time_line.php?request_id=<?php echo "$tag_staff_id"; ?>"  class="btn btn-outline-info btn-rounded"  class="btn btn-outline-info btn-rounded"><i class="fa fa-list-alt"></i> ກວດສອບ </a></td>
							 	
							


							</td>

							</tr>

							<?php
						 
								$s++ ;}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="8">
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
				 <!-- /row -->
            </div>
           <?php include "footer.php";?>
            <!-- End footer -->
        </div>
		
    </div>
	<?php include "javascript.php";?>
</body>

</html>