<div class="form-group">
  <label for="sn_imac" class="col-sm-2 control-label">Serial Number IMAC</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_imac" name="sn_imac" placeholder="Serial Number IMAC" value="<?php if(isset($sn_imac)){echo $sn_imac;}?>"  >
  </div>
</div>
<div class="form-group">
  <label for="sn_keyboard_imac" class="col-sm-2 control-label">Serial Number Keyboard</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_keyboard_imac" name="sn_keyboard_imac" placeholder="Serial Number Keyboard" value="<?php if(isset($sn_keyboard_imac)){echo $sn_keyboard_imac;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="sn_mouse_imac" class="col-sm-2 control-label">Serial Number Mouse</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="sn_mouse_imac" name="sn_mouse_imac" placeholder="Serial Number Mouse" value="<?php if(isset($sn_mouse_imac)){echo $sn_mouse_imac;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="nama_imac" class="col-sm-2 control-label">Nama IMAC</label>
  <div class="col-sm-4">
    <input type="text" class="form-control" id="nama_imac" name="nama_imac" placeholder="Nama Laptop" value="<?php if(isset($nama_imac)){echo $nama_imac;}?>" >
  </div>
</div>
<div class="form-group">
  <label for="ups_imac" class="col-sm-2 control-label">UPS</label>
  <div class="col-sm-4">
    <select id="ups_imac" name="ups_imac" class="select2" style="width:300px">
      <option>Pilih</option>
      <?php
        foreach ($listUPS->result() as $row) {
          echo "<option value='$row->id'>".$row->sn."</option>";
        }
      ?>
    </select>
  </div>
</div>