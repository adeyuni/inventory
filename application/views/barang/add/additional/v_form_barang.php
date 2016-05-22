<div class="form-group">
	<label for="sn" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="sn" name="sn" placeholder="Serial Number" value="<?php if(isset($sn)){echo $sn;}?>" required>
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-4">
  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
	</div>
</div>