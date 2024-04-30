 
<div class="form-group">
 <label> ຊື່ ພະແນກ/ໜ່ວຍງານ </label>
 <textarea name="depart_name" id="depart_name" class="form-control"></textarea>
</div>
 
 

<script>
 $(document).ready(function () {

  var departname = localStorage.getItem('dpname');  
 
  $('#depart_name').val(departname); 

  

 });
</script>