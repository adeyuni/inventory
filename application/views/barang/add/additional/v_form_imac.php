<div class="form-group">
  <label for="sn_imac" class="col-sm-2 control-label">S/N IMAC</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_imac" name="sn_imac" placeholder="S/N IMAC" value="<?php if(isset($sn_imac)){echo $sn_imac;}?>"  >
  </div>
</div>
<div class="form-group">
  <label for="sn_keyboard_imac" class="col-sm-2 control-label">S/N Keyboard</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_keyboard_imac" name="sn_keyboard_imac" placeholder="S/N Keyboard" value="<?php if(isset($sn_keyboard_imac)){echo $sn_keyboard_imac;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_mouse_imac" class="col-sm-2 control-label">S/N Mouse</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_mouse_imac" name="sn_mouse_imac" placeholder="S/N Mouse" value="<?php if(isset($sn_mouse_imac)){echo $sn_mouse_imac;}?>" >
  </div>
</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-4">
      <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Submit">
  </div>
</div>