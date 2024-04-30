<html>
 
<div class="form-group">
 <label> ຊື່ຕຳແໜ່ງ </label>
  <input type="text" name="post_name" id="post_name" class="form-control" readonly />
</div>

 
 <div class="form-group">
 <label> ລະດັບອານຸຍາດ </label>
 <select name="p_lv" id="p_lv" class="form-control">
 <option value=""> ເລືອກລະດັບ </option>
 <option value="1"> Level 1 </option>
 <option value="2"> Level 2 </option>
 <option value="3"> Level 3 </option>
 <option value="4"> Level 4 </option>
 <option value="5"> Level 5 </option>
 </select>
</div>

<script>
 $(document).ready(function () {

 
	var postname = localStorage.getItem('level_post_name');  
	var lv = localStorage.getItem('val_level');  
 
 
	$('#post_name').val(postname);	
	$('#p_lv').val(lv); 

  

 });
</script>

</html>