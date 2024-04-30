 
<div class="form-group">
 <label> ຊື່ ພະແນກ/ໜ່ວຍງານ </label>
 <input name="depart_name" id="depart_name" class="form-control" readonly></input>
</div>
 
<div class="form-group">
 <label> E-Mail ພະແນກ/ໜ່ວຍງານ </label>
 <input name="depart_email" id="depart_email" class="form-control"></input>
</div>

<script>
 $(document).ready(function () {

  var departname = localStorage.getItem('dp_name');  
  var departemail = localStorage.getItem('dp_email');  
 
  $('#depart_name').val(departname); 
  $('#depart_email').val(departemail); 

  

 });
</script>