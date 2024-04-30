<div class="form-group">
 <label> ເລກ CP </label>
 <input name="name_ps" id="name_ps" class="form-control" readonly >
</div>

 
 
 <select class="form-control font" name="lv_id" id ="lv_id">
<option value=""> ເລືອກ ລະດັບ </option>  
<option value="1"> Level 1 </option> 
<option value="2"> Level 2 </option>
<option value="3"> Level 3 </option>
<option value="4"> Level 4 </option>
<option value="5"> Level 5 </option>
</select>
 

<script>
 $(document).ready(function () {

  var positions = localStorage.getItem('ps_name'); 
 
 
  $('#name_ps').val(positions); 
 
 
 });
</script>