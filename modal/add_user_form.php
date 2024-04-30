<div class="form-group">
 <label> ເລກ CP </label>
 <input name="cp_code" id="cp_code" class="form-control" readonly >
</div>

<div class="form-group">
 <label> ຊື່ ນາມສະກຸນ </label>
 <input name="f_name" id="f_name" class="form-control" readonly >
</div>

<div class="form-group">
 <label> ພະແນກ </label>
 <input name="dp_name" id="dp_name" class="form-control" readonly >
</div>
 

<div class="form-group">
 <label> E-Mail </label>
 <input name="e_mail" id="e_mail" class="form-control"  >
</div>
 

<script>
 $(document).ready(function () {

  var codestaff = localStorage.getItem('stcode');
  var staffname = localStorage.getItem('stfullname');
  var staffdepart = localStorage.getItem('stdp');
 
 
  $('#cp_code').val(codestaff);
  $('#f_name').val(staffname);
  $('#dp_name').val(staffdepart);
 
 
 });
</script>