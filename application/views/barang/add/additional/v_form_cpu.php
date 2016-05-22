<div class="form-group">
	<label for="service_tag" class="col-sm-2 control-label">Service Tag</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="service_tag" name="service_tag" placeholder="Service Tag" value="<?php if(isset($service_tag)){echo $service_tag;}?>" required>
	</div>
</div>
<div class="form-group">
	<label for="sn" class="col-sm-2 control-label">Serial Number</label>
	<div class="col-sm-4">
	  <input type="text" class="form-control" id="sn_cpu" name="sn_cpu" placeholder="Serial Number" value="<?php if(isset($sn_cpu)){echo $sn_cpu;}?>">
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-4">
  		<input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
	</div>
</div>