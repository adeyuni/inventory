<div class="form-group">
  <label for="sn_laptop" class="col-sm-2 control-label">S/N Laptop</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_laptop" name="sn_laptop" placeholder="S/N Laptop" value="<?php if(isset($sn_laptop)){echo $sn_laptop;}?>"  >
  </div>
</div>
<div class="form-group">
  <label for="sn_hd" class="col-sm-2 control-label">S/N Hardisk</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_hd" name="sn_hd" placeholder="S/N Hardisk" value="<?php if(isset($sn_hd)){echo $sn_hd;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_baterai" class="col-sm-2 control-label">S/N Baterai</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_baterai" name="sn_baterai" placeholder="S/N Baterai" value="<?php if(isset($sn_baterai)){echo $sn_baterai;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_charger" class="col-sm-2 control-label">S/N Charger</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_charger" name="sn_charger" placeholder="S/N Charger" value="<?php if(isset($sn_charger)){echo $sn_charger;}?>" >
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-4">
      <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
  </div>
</div>