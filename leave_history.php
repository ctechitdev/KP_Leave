<?php 
include "checksession.php";
include "function/database_connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php  
include "stylesheet.php";  
?>
<script src="search.js"></script>
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
					 
					 
						<h2 class="card-title text-center">ປະຫວັດ ຂໍລາພັກ </h2>
						 <div class="table-responsive">
						 <table id='demo-foo-addrow2' class='table table-bordered table-sm table-hover toggle-circle' data-page-size='100'>
                                    
									 <thead class="btn-info">
							<tr>
							<th scope="col"  >ເລກທີ</th>
							<th scope="col"  > ຊື່-ນາມສະກຸນ ຜູ້ຂໍ </th>
							<th scope="col"  > ເຫດຜົນລາ </th> 
							<th scope="col"  > ຈາກວັນທີ </th>  
							<th scope="col"  > ຫາວັນທີ </th> 
							<th scope="col"  > ຂໍຜ່ານທາງ </th>
							<th scope="col"  >   </th>
							</tr>
							</thead>
										<div class='m-t-40'>
										<?php
										 
									//  echo "$user_ids";		
									
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
							
							$stmt = $connect->prepare("
							select lr_id,a.user_ids as user_ids,reason,date_from,date_to,
							concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
							'ຜ່ານລະບົບ' as rq_type
							from tbl_leave_request a
							left join tbl_user b on a.user_ids = b.user_ids
							left join tbl_staff c on b.staff_id = c.staff_id
							where a.user_ids = '$user_ids' 
							union all
							select lrd_id,a.staff_id as staff_id,reason,date_from,date_to,
							concat((case when staff_gender = 1 then 'ທ້າວ' else 'ນາງ' end), ' ',staff_first_name,' ',staff_last_name) as requester_full_name,
							'ຜ່ານເອກະສານ' as rq_type
							from tbl_leave_request_document a 
							left join tbl_staff b on a.staff_id = b.staff_id
							where a.staff_id ='$staff_id' 
							order by lr_id desc
							  ");
							
							$stmt->execute();
							if($stmt->rowCount() > 0)
							{
							while($row=$stmt->fetch(PDO::FETCH_ASSOC))
							{ 
						$lr_id = $row['lr_id']; 
						$requester_full_name = $row['requester_full_name'];  
						$reason = $row['reason']; 
						$date_from = $row['date_from']; 
						$date_to = $row['date_to'];
						$rq_type = $row['rq_type'];
						 
							?>

							<tr>  
							<td><?php echo "$lr_id";?></td>
							<td style="text-align: left;" ><?php echo "$requester_full_name";?></td> 
							<td><?php echo "$reason";?></td> 
							<td><?php echo "$date_from";?></td>  
							<td><?php echo "$date_to";?></td>  
							<td><?php echo "$rq_type";?></td>


							 <td><a href="view_full_doc.php?request_id=<?php echo "$lr_id"; ?>"  class="btn btn-outline-info btn-rounded"  class="btn btn-outline-info btn-rounded"><i class="fa fa-eye"></i> ສະແດງ </a></td>
							

							</tr>

							<?php
						 
								}
								}

							?>
                                    </tbody>
									 <tfoot>
                                        <tr>
                                            <td colspan="7">
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
